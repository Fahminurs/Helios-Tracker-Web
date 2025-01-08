<?php  

namespace App\Http\Controllers;  

use App\Models\Alat;
use App\Models\Device;
use App\Models\MonitoringEnergi;
use App\Models\MonitorSolar;
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;  

class DashboardController extends Controller  
{  
    public function index()  
    {  
        Log::info('Memulai method index Dashboard untuk pengguna: ' . Auth::id());
        
        try {
            // Ambil semua perangkat milik user yang login
            $devices = Alat::where('id_user', Auth::id())
                         ->orderBy('id_alat', 'ASC')
                         ->get();

            // Jika tidak ada perangkat, tampilkan view notalat
            if ($devices->isEmpty()) {
                Log::info('User tidak memiliki perangkat', [
                    'id_user' => Auth::id()
                ]);
                return view('Dashboard', [
                    'content' => 'notalat'
                ]);
            }

            // Cek apakah ada perangkat terakhir yang dipilih di session
            $lastSelectedDevice = session('last_selected_device');
            if ($lastSelectedDevice) {
                $device = Alat::where('id_user', Auth::id())
                             ->where('kode_perangkat', $lastSelectedDevice)
                             ->first();
                
                // Jika perangkat masih ada, gunakan itu
                if ($device) {
                    Log::info('Menggunakan perangkat terakhir yang dipilih', [
                        'kode_perangkat' => $lastSelectedDevice
                    ]);
                    return redirect()->route('main.device', ['kode_perangkat' => $lastSelectedDevice]);
                }
            }

            // Jika tidak ada perangkat terakhir atau sudah tidak valid, gunakan perangkat dengan id_alat terkecil
            $firstDevice = $devices->sortBy('id_alat')->first();
            Log::info('Menggunakan perangkat dengan id_alat terkecil', [
                'kode_perangkat' => $firstDevice->kode_perangkat
            ]);
            return redirect()->route('main.device', ['kode_perangkat' => $firstDevice->kode_perangkat]);

        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan pada method index Dashboard', [
                'id_pengguna' => Auth::id(),
                'pesan_error' => $e->getMessage()
            ]);

            return view('Dashboard', [
                'content' => 'notalat'
            ]);
        }
    }

    public function getDeviceInfo(Request $request)
    {
        Log::info('Memulai method getDeviceInfo untuk pengguna: ' . Auth::id());

        try {
            // Ambil kode perangkat dari URL
            $currentPath = $request->path();
            $kode_perangkat = null;
            
            // Extract kode perangkat dari URL main/{kode_perangkat}
            if (preg_match('/main\/(\d+)/', $currentPath, $matches)) {
                $kode_perangkat = $matches[1];
            }

            // Cari perangkat berdasarkan kode dan user
            $device = Alat::where('id_user', Auth::id())
                         ->where('kode_perangkat', $kode_perangkat)
                         ->first();

            if (!$device) {
                Log::warning('Tidak ada perangkat ditemukan untuk pengguna', [
                    'id_pengguna' => Auth::id(),
                    'kode_perangkat' => $kode_perangkat
                ]);

                return response()->json([
                    'status' => 'error',
                    'pesan' => 'Tidak ada perangkat ditemukan'
                ]);
            }

            // Ambil semua perangkat untuk menghitung urutan
            $devices = Alat::where('id_user', Auth::id())
                         ->orderBy('id_alat', 'ASC')
                         ->get();

            // Hitung urutan perangkat ini
            $deviceNumber = $devices->search(function($item) use ($device) {
                return $item->id_alat === $device->id_alat;
            }) + 1;

            // Parse lokasi_perangkat jika berbentuk string
            if (is_string($device->lokasi_perangkat)) {
                $device->lokasi_perangkat = json_decode($device->lokasi_perangkat, true);
            }

            $response = [
                'status' => 'sukses',
                'data' => [
                    'nama_perangkat' => 'Device ' . $deviceNumber,
                    'kode_perangkat' => $device->kode_perangkat,
                    'status_servo' => $device->status_servo,
                    'status_esp32' => $device->status_esp32,
                    'cuaca' => [
                        'suhu' => $device->suhu,
                        'kondisi' => $device->cuaca,
                    ],
                    'lokasi' => $device->lokasi_perangkat ?? [
                        'Latitude' => '0',
                        'Longitude' => '0'
                    ],
                    'monitoring' => [
                        'horizontal' => 20,
                        'vertical' => 20,
                        'ampere' => 20,
                        'volt' => 20,
                        'baterai' => 50
                    ]
                ]
            ];

            Log::info('Informasi perangkat berhasil diambil', [
                'id_pengguna' => Auth::id(),
                'kode_perangkat' => $kode_perangkat,
                'total_perangkat' => $devices->count(),
                'nomor_urut_perangkat' => $deviceNumber,
                'response' => $response
            ]);

            return response()->json($response);

        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan pada method getDeviceInfo', [
                'id_pengguna' => Auth::id(),
                'pesan_error' => $e->getMessage()
            ]);

            return response()->json([
                'status' => 'error',
                'pesan' => 'Terjadi kesalahan saat mengambil informasi perangkat: ' . $e->getMessage()
            ], 500);
        }
    }
    public function deviceList()  
    {  
        // Ambil semua perangkat milik user yang login  
        $devices = Alat::where('id_user', Auth::id())  
                      ->orderBy('id_alat', 'ASC')  
                      ->get();  
    
        return view('Dashboard', [  
            'content' => 'device_list',  
            'devices' => $devices  
        ]);  
    }   

    public function showDeviceMain($kode_perangkat)
    {
        Log::info('Memulai method showDeviceMain untuk perangkat: ' . $kode_perangkat);
        
        try {
            // Cek apakah user memiliki perangkat
            $devices = Alat::where('id_user', Auth::id())->get();
            
            if ($devices->isEmpty()) {
                Log::info('User tidak memiliki perangkat', [
                    'id_user' => Auth::id()
                ]);
                return view('Dashboard', [
                    'content' => 'notalat'
                ]);
            }

            // Cari perangkat berdasarkan kode
            $device = Alat::where('id_user', Auth::id())
                         ->where('kode_perangkat', $kode_perangkat)
                         ->first();

            // Jika perangkat tidak ditemukan atau bukan milik user
            if (!$device) {
                Log::warning('Perangkat tidak ditemukan atau bukan milik user', [
                    'kode_perangkat' => $kode_perangkat,
                    'id_user' => Auth::id()
                ]);

                // Cek apakah ada perangkat terakhir yang dipilih di session
                $lastSelectedDevice = session('last_selected_device');
                if ($lastSelectedDevice) {
                    $lastDevice = Alat::where('id_user', Auth::id())
                                    ->where('kode_perangkat', $lastSelectedDevice)
                                    ->first();
                    if ($lastDevice) {
                        Log::info('Mengarahkan ke perangkat terakhir yang dipilih', [
                            'kode_perangkat' => $lastSelectedDevice
                        ]);
                        return redirect()->route('main.device', ['kode_perangkat' => $lastSelectedDevice]);
                    }
                }

                // Jika tidak ada di session, gunakan perangkat dengan id_alat terkecil
                $firstDevice = $devices->sortBy('id_alat')->first();
                Log::info('Mengarahkan ke perangkat dengan id_alat terkecil', [
                    'kode_perangkat' => $firstDevice->kode_perangkat
                ]);
                return redirect()->route('main.device', ['kode_perangkat' => $firstDevice->kode_perangkat]);
            }

            // Simpan kode perangkat terakhir yang dipilih ke session
            session(['last_selected_device' => $kode_perangkat]);

            // Hitung urutan perangkat
            $deviceNumber = $devices->search(function($item) use ($device) {
                return $item->id_alat === $device->id_alat;
            }) + 1;

            $device->nama_device = 'Device ' . $deviceNumber;

            // Parse lokasi_perangkat jika berbentuk string
            if (is_string($device->lokasi_perangkat)) {
                $device->lokasi_perangkat = json_decode($device->lokasi_perangkat, true);
            }

            // Ambil data monitoring solar
            $monitoringSolar = MonitorSolar::where('id_alat', $device->id_alat)
                                         ->orderBy('id_monitoring', 'DESC')
                                         ->first();

            // Ambil data monitoring energi
            $monitoringEnergi = MonitoringEnergi::where('id_alat', $device->id_alat)
                                               ->orderBy('id_energi', 'DESC')
                                               ->first();

            Log::info('Data perangkat berhasil diambil', [
                'id_alat' => $device->id_alat,
                'kode_perangkat' => $kode_perangkat
            ]);

            return view('Dashboard', [
                'content' => 'main',
                'device' => $device,
                'monitoringSolar' => $monitoringSolar,
                'monitoringEnergi' => $monitoringEnergi
            ]);

        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan pada method showDeviceMain', [
                'kode_perangkat' => $kode_perangkat,
                'pesan_error' => $e->getMessage()
            ]);

            return view('Dashboard', [
                'content' => 'notalat'
            ]);
        }
    }

    public function deleteDevice($id)
    {
        Log::info('Memulai proses penghapusan device', [
            'id_alat' => $id,
            'id_user' => Auth::id()
        ]);

        try {
            $device = Alat::where('id_alat', $id)
                         ->where('id_user', Auth::id())
                         ->first();

            if (!$device) {
                Log::warning('Device tidak ditemukan atau bukan milik user ini', [
                    'id_alat' => $id,
                    'id_user' => Auth::id()
                ]);
                return redirect()->route('device-list')
                    ->with('error', 'Device tidak ditemukan');
            }

            // Log device information before deletion
            Log::info('Informasi device yang akan dihapus', [
                'id_alat' => $device->id_alat,
                'kode_perangkat' => $device->kode_perangkat,
                'id_user' => $device->id_user
            ]);

            // Delete related monitoring data first
            try {
                $deletedMonitorSolar = MonitorSolar::where('id_alat', $id)->delete();
                Log::info('Data MonitorSolar terhapus', [
                    'id_alat' => $id,
                    'jumlah_data' => $deletedMonitorSolar
                ]);

                $deletedMonitoringEnergi = MonitoringEnergi::where('id_alat', $id)->delete();
                Log::info('Data MonitoringEnergi terhapus', [
                    'id_alat' => $id,
                    'jumlah_data' => $deletedMonitoringEnergi
                ]);
            } catch (\Exception $e) {
                Log::error('Gagal menghapus data monitoring', [
                    'id_alat' => $id,
                    'error' => $e->getMessage()
                ]);
            }

            // Update status di tabel devices menjadi Tidak Aktif
            $deviceRecord = Device::where('kode_perangkat', $device->kode_perangkat)->first();
            if ($deviceRecord) {
                $deviceRecord->status = 'Tidak Aktif';
                $deviceRecord->save();
                
                Log::info('Status device diubah menjadi Tidak Aktif', [
                    'kode_perangkat' => $device->kode_perangkat
                ]);
            }

            // Delete the device
            if ($device->delete()) {
                Log::info('Device berhasil dihapus', [
                    'id_alat' => $id,
                    'kode_perangkat' => $device->kode_perangkat
                ]);

                return redirect()->route('main')
                    ->with('success', 'Device berhasil dihapus');
            }

            Log::error('Gagal menghapus device', [
                'id_alat' => $id,
                'kode_perangkat' => $device->kode_perangkat
            ]);

            return redirect()->route('device-list')
                ->with('error', 'Gagal menghapus device');

        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat menghapus device', [
                'id_alat' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('device-list')
                ->with('error', 'Terjadi kesalahan saat menghapus device');
        }
    }

    public function registerDevice(Request $request)  
    {  
        Log::info('Memulai proses registrasi device baru', [  
            'id_user' => Auth::id(),  
            'kode_perangkat' => $request->kode_perangkat  
        ]);  
    
        try {  
            // Validasi input  
            $request->validate([  
                'kode_perangkat' => 'required|string'  
            ]);  
    
            // Cek apakah kode perangkat terdaftar di tabel devices  
            $device = Device::where('kode_perangkat', $request->kode_perangkat)  
                          ->where('status', 'Tidak Aktif')  
                          ->first();  
    
            if (!$device) {  
                Log::warning('Kode perangkat tidak terdaftar atau sudah aktif', [  
                    'kode_perangkat' => $request->kode_perangkat  
                ]);  
    
                return redirect()->back()  
                    ->with([  
                        'type' => 'danger',  
                        'message' => 'Registrasi Gagal',  
                        'details' => ['Kode perangkat tidak tersedia atau sudah aktif']  
                    ]);  
            }  
    
            // Cek apakah perangkat sudah terdaftar untuk user lain  
            $existingAlat = Alat::where('kode_perangkat', $request->kode_perangkat)->first();  
            if ($existingAlat) {  
                Log::warning('Perangkat sudah terdaftar untuk user lain', [  
                    'kode_perangkat' => $request->kode_perangkat,  
                    'id_user_existing' => $existingAlat->id_user  
                ]);  
    
                return redirect()->back()  
                    ->with([  
                        'type' => 'danger',  
                        'message' => 'Registrasi Gagal',  
                        'details' => ['Perangkat sudah terdaftar untuk pengguna lain']  
                    ]);  
            }  
    
            // Update status perangkat menjadi Aktif  
            $device->status = 'Aktif';  
            $device->save();  
    
            // Simpan perangkat baru  
            $newAlat = new Alat();  
            $newAlat->id_user = Auth::id();  
            $newAlat->kode_perangkat = $request->kode_perangkat;  
            $newAlat->lokasi_perangkat = null; // Lokasi bisa diupdate nanti  
            $newAlat->save();  
    
            Log::info('Device berhasil didaftarkan', [  
                'id_alat' => $newAlat->id_alat,  
                'kode_perangkat' => $newAlat->kode_perangkat,  
                'id_user' => $newAlat->id_user,  
                'status' => 'Aktif'  
            ]);  
    
            // Buat data monitoring awal  
            MonitorSolar::create([  
                'id_alat' => $newAlat->id_alat,  
                'posisi_x' => 0,  
                'posisi_y' => 0  
            ]);  
    
            MonitoringEnergi::create([  
                'id_alat' => $newAlat->id_alat,  
                'ampere' => 0,  
                'volt' => 0,  
                'battery' => 0  
            ]);  
    
            return redirect()->route('device-list')  
                ->with([  
                    'type' => 'success',  
                    'message' => 'Registrasi Berhasil',  
                    'details' => ['Perangkat berhasil ditambahkan dan diaktifkan']  
                ]);  
    
        } catch (\Exception $e) {  
            Log::error('Terjadi kesalahan saat registrasi device', [  
                'error' => $e->getMessage(),  
                'trace' => $e->getTraceAsString()  
            ]);  
    
            return redirect()->back()  
                ->with([  
                    'type' => 'danger',  
                    'message' => 'Registrasi Gagal',  
                    'details' => ['Terjadi kesalahan saat mendaftarkan perangkat']  
                ]);  
        }  
    }

    public function updateLocation(Request $request)  
    {  
        Log::info('Memulai proses update lokasi device', [  
            'id_user' => Auth::id(),  
            'kode_perangkat' => $request->kode_perangkat,  
            'latitude' => $request->latitude,  
            'longitude' => $request->longitude  
        ]);  
    
        try {  
            // Validasi input  
            $request->validate([  
                'kode_perangkat' => 'required|string|exists:alat,kode_perangkat',  
                'latitude' => 'required|numeric',  
                'longitude' => 'required|numeric'  
            ]);  
    
            // Cari device berdasarkan kode perangkat dan user  
            $device = Alat::where('kode_perangkat', $request->kode_perangkat)  
                         ->where('id_user', Auth::id())  
                         ->first();  
    
            if (!$device) {  
                return redirect()->back()->with('error', 'Device tidak ditemukan');  
            }  
    
            // Siapkan data lokasi untuk dikirim ke API eksternal  
            $apiPayload = [  
                'id_alat' => $device->id_alat,  
                'lokasi_perangkat' => json_encode([  
                    'Latitude' => $request->latitude,   
                    'Longitude' => $request->longitude  
                ])  
            ];  
    
            // Kirim request ke API eksternal  
            $response = Http::withHeaders([  
                'Content-Type' => 'application/json'  
            ])->post('http://localhost/helios-tracker-api/informasi perangkat/update_informasi perangkat.php', $apiPayload);  
    
            // Periksa response dari API  
            if ($response->successful()) {  
                // Update lokasi di database lokal  
                $device->lokasi_perangkat = json_encode([  
                    'Latitude' => $request->latitude,  
                    'Longitude' => $request->longitude  
                ]);  
                $device->save();  
    
                return redirect()->back()->with('success', 'Lokasi berhasil diperbarui');  
            } else {  
                return redirect()->back()->with('error', 'Gagal memperbarui lokasi di server eksternal');  
            }  
    
        } catch (\Exception $e) {  
            Log::error('Kesalahan update lokasi', [  
                'message' => $e->getMessage(),  
                'trace' => $e->getTraceAsString()  
            ]);  
    
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());  
        }  
    }
}