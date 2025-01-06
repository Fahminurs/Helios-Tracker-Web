<?php  

namespace App\Http\Controllers;  

use App\Models\Alat;
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller  
{  
    public function index()  
    {  
        $device = Alat::where('id_user', Auth::id())
                     ->orderBy('id_alat', 'ASC')
                     ->first();

        return view('Dashboard', [
            'content' => 'main',
            'device' => $device
        ]);
    }

    public function getDeviceInfo()
    {
        $device = Alat::where('id_user', Auth::id())
                     ->orderBy('id_alat', 'ASC')
                     ->first();

        if (!$device) {
            return response()->json([
                'status' => 'error',
                'message' => 'No device found'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'device_name' => 'Device ' . $device->id_alat,
                'device_code' => $device->kode_perangkat,
                'servo_status' => $device->status_servo ? 'Hidup' : 'Mati',
                'esp_status' => $device->status_esp ? 'Hidup' : 'Mati',
                'weather' => [
                    'temperature' => $device->suhu ?? '0',
                    'condition' => $device->kondisi_cuaca ?? 'Tidak ada data',
                ],
                'location' => [
                    'latitude' => $device->latitude ?? '0',
                    'longitude' => $device->longitude ?? '0',
                ]
            ]
        ]);
    }
}