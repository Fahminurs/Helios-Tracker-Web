<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Device;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class loginadminController extends Controller
{
    public function index()  
    {  
        // Hitung jumlah user dengan role 'user'
        $totalUsers = User::where('role', 'user')->count();
        // Hitung total perangkat dari tabel alat
        $totalDevices = Alat::count();

        // Ambil data pendaftaran user per minggu untuk 4 minggu terakhir
        $weeklyData = [];
        $labels = [];
        
        try {
            for ($i = 3; $i >= 0; $i--) {
                $startDate = Carbon::now()->subWeeks($i)->startOfWeek();
                $endDate = Carbon::now()->subWeeks($i)->endOfWeek();
                
                $count = User::where('role', 'user')
                    ->whereBetween('create_at', [
                        $startDate->format('Y-m-d H:i:s'),
                        $endDate->format('Y-m-d H:i:s')
                    ])
                    ->count();
                    
                $weeklyData[] = $count;
                $labels[] = 'Minggu ' . (4 - $i);
            }
        } catch (\Exception $e) {
            Log::error('Error generating chart data: ' . $e->getMessage());
            $weeklyData = [0, 0, 0, 0];
            $labels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
        }
        
        // Ambil 5 perangkat terbaru dari tabel devices
        $recentDevices = Device::orderBy('id', 'DESC')
                            ->take(5)
                            ->get()
                            ->map(function($device) {
                                return [
                                    'code' => $device->kode_perangkat,
                                    'created_at' => now()->diffForHumans(),
                                    'status' => $device->status,
                                    'connection' => $device->status === 'active' ? 'Connected' : 'Disconnected'
                                ];
                            });
        
        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalDevices' => $totalDevices,
            'weeklyData' => $weeklyData,
            'chartLabels' => $labels,
            'recentDevices' => $recentDevices
        ]);
    }

    public function getDeviceInfo()
    {
        $device = Device::orderBy('id', 'ASC')->first();

        if (!$device) {
            return response()->json([
                'status' => 'error',
                'message' => 'No device found'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'device_name' => 'Device ' . $device->id,
                'device_code' => $device->kode_perangkat,
                'status' => $device->status
            ]
        ]);
    }

    public function generateDeviceCode()
    {
        try {
            // Generate kode perangkat random (5 digit angka)
            $deviceCode = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            
            // Buat perangkat baru di tabel devices
            $device = new Device();
            $device->kode_perangkat = $deviceCode;
            $device->status = 'Tidak Aktif';
            // created_at akan diisi otomatis oleh MySQL karena kita set useCurrent()
            $device->save();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Kode perangkat berhasil dibuat',
                'data' => [
                    'device_code' => $deviceCode
                ]
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error generating device code: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat kode perangkat: ' . $e->getMessage()
            ], 500);
        }
    }

}
