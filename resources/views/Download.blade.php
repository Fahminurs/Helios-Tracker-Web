@extends('dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Download Aplikasi</h1>
    
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-xl font-semibold">Helios Tracker Mobile App</h2>
                <p class="text-gray-600">Versi terbaru: 1.0.0</p>
            </div>
            <a href="#" 
               class="bg-[#7847EB] text-white px-6 py-2 rounded-lg hover:bg-[#6236c5] transition-colors">
                Download APK
            </a>
        </div>
        
        <div class="mt-4">
            <h3 class="font-semibold mb-2">Fitur:</h3>
            <ul class="list-disc list-inside text-gray-600">
                <li>Monitoring realtime</li>
                <li>Kontrol perangkat</li>
                <li>Notifikasi status</li>
                <li>Riwayat penggunaan</li>
            </ul>
        </div>
    </div>
</div>
@endsection