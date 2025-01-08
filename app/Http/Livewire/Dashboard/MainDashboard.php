<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Alat;
use App\Models\MonitorSolar;
use App\Models\MonitoringEnergi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class MainDashboard extends Component
{
    public $device;
    public $monitoringSolar;
    public $monitoringEnergi;
    public $deviceNumber;
    public $kode_perangkat;
    
    protected $listeners = ['refreshData' => '$refresh'];

    public function mount()
    {
        // Ambil kode perangkat dari URL
        $currentPath = Request::path();
        if (preg_match('/main\/(\d+)/', $currentPath, $matches)) {
            $this->kode_perangkat = $matches[1];
            // Update session dengan kode perangkat terbaru
            session(['last_selected_device' => $this->kode_perangkat]);
        } else {
            // Jika tidak ada di URL, coba ambil dari session
            $this->kode_perangkat = session('last_selected_device');
        }
        
        $this->loadData();
    }

    public function loadData()
    {
        Log::info('Memulai loadData Livewire Dashboard untuk pengguna: ' . Auth::id());
        
        try {
            // Ambil semua perangkat milik user yang login
            $devices = Alat::where('id_user', Auth::id())
                         ->orderBy('id_alat', 'ASC')
                         ->get();

            // Cari perangkat berdasarkan kode
            if ($this->kode_perangkat) {
                $this->device = Alat::where('id_user', Auth::id())
                                  ->where('kode_perangkat', $this->kode_perangkat)
                                  ->first();
            }

            // Jika tidak ditemukan, gunakan perangkat pertama
            if (!$this->device) {
                $this->device = $devices->first();
                if ($this->device) {
                    $this->kode_perangkat = $this->device->kode_perangkat;
                    session(['last_selected_device' => $this->kode_perangkat]);
                }
            }

            // Hitung urutan perangkat ini dari semua perangkat milik user
            if ($this->device) {
                $this->deviceNumber = $devices->search(function($item) {
                    return $item->id_alat === $this->device->id_alat;
                }) + 1;

                $this->device->nama_device = 'Device ' . $this->deviceNumber;
                
                // Parse lokasi_perangkat jika berbentuk string
                if (is_string($this->device->lokasi_perangkat)) {
                    $this->device->lokasi_perangkat = json_decode($this->device->lokasi_perangkat, true);
                }

                // Ambil data monitoring solar
                $this->monitoringSolar = MonitorSolar::where('id_alat', $this->device->id_alat)
                                             ->orderBy('id_monitoring', 'DESC')
                                             ->first();

                // Ambil data monitoring energi
                $this->monitoringEnergi = MonitoringEnergi::where('id_alat', $this->device->id_alat)
                                                   ->orderBy('id_energi', 'DESC')
                                                   ->first();

                Log::info('Data monitoring berhasil diambil', [
                    'id_alat' => $this->device->id_alat,
                    'kode_perangkat' => $this->kode_perangkat,
                    'monitoring_solar' => $this->monitoringSolar,
                    'monitoring_energi' => $this->monitoringEnergi
                ]);

                // Langsung update localStorage dengan nama device
                $this->dispatchBrowserEvent('updateLocalStorage', [
                    'key' => 'selectedDeviceName',
                    'value' => $this->device->nama_device
                ]);
            }

            Log::info('Perangkat berhasil diambil untuk pengguna', [
                'id_pengguna' => Auth::id(),
                'kode_perangkat' => $this->kode_perangkat,
                'total_perangkat' => $devices->count(),
                'nomor_urut_perangkat' => $this->deviceNumber,
                'perangkat' => $this->device ? [
                    'id_alat' => $this->device->id_alat,
                    'nama_device' => $this->device->nama_device,
                    'kode_perangkat' => $this->device->kode_perangkat,
                    'status_servo' => $this->device->status_servo,
                    'status_esp32' => $this->device->status_esp32,
                    'cuaca' => $this->device->cuaca,
                    'suhu' => $this->device->suhu,
                    'lokasi_perangkat' => $this->device->lokasi_perangkat
                ] : 'Tidak ada perangkat ditemukan'
            ]);

        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan pada loadData Livewire Dashboard', [
                'id_pengguna' => Auth::id(),
                'kode_perangkat' => $this->kode_perangkat,
                'pesan_error' => $e->getMessage()
            ]);

            $this->device = null;
            $this->monitoringSolar = null;
            $this->monitoringEnergi = null;
        }
    }

    public function getListeners()
    {
        return [
            'echo:private-device.' . Auth::id() . ',DeviceUpdated' => 'loadData',
            'refreshData' => '$refresh'
        ];
    }

    public function render()
    {
        return view('livewire.dashboard.main-dashboard');
    }
}
