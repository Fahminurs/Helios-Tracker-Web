<div class="grid grid-cols-1 lg:grid-cols-2 gap-[10px] w-full mt-7">
    <!-- Card 1 -->
    <div class="bg-[#D5D2FE] rounded-[20px] p-6 h-auto w-full shadow-lg">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-base lg:text-lg font-bold text-gray-800">Informasi Perangkat</h3>
            <div class="relative">
                <i class="fas fa-ellipsis-v text-gray-800 cursor-pointer" data-dropdown-toggle="dropdownMenu"></i>
                <!-- Icon Dotted -->
                <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                    <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-modal-target="update-device-modal" data-modal-toggle="update-device-modal">
                        <i class="fas fa-edit mr-2"></i>
                        Update Perangkat
                    </a>
                </div>
            </div>
        </div>
        <div class="space-y-2">
            <!-- Sub Card 1 -->
            <div class="flex items-center text-white p-2 rounded-[10px]" style="background-color: #7847eb;">
                <i class="fas fa-microchip mr-2"></i>
                <span class="text-sm lg:text-base" x-text="deviceInfo.device_name">{{ $device->nama_device ?? 'Device 1' }}</span>
            </div>
            <!-- Sub Card 2 -->
            <div class="flex items-center text-white p-2 rounded-[10px]" style="background-color: #7847eb;">
                <i class="fas fa-key mr-2"></i>
                <span class="text-sm lg:text-base">Kode Perangkat: {{ $device->kode_perangkat ?? 'Tidak ada' }}</span>
            </div>
            <!-- Sub Card 3 -->
            <div class="flex items-center text-white p-2 rounded-[10px]" style="background-color: #7847eb;">
                <i class="fas fa-cogs mr-2"></i>
                <span class="text-sm lg:text-base">Status Servo: {{ $device->status_servo ? 'Hidup' : 'Mati' }}</span>
            </div>
            <!-- Sub Card 4 -->
            <div class="flex items-center text-white p-2 rounded-[10px]" style="background-color: #7847eb;">
                <i class="fas fa-microchip mr-2"></i>
                <span class="text-sm lg:text-base">Status ESP32: {{ $device->status_esp ? 'Hidup' : 'Mati' }}</span>
            </div>
        </div>
        <!-- Weather and Location Section -->
        <div class="grid grid-cols-2 gap-4 mt-4">
            <!-- Weather Card -->
            <div class="flex flex-col justify-evenly text-white py-4 px-2 rounded-[10px]" style="background-color: #7847eb;">
                <h4 class="font-bold mb-2 text-xs lg:text-sm">Cuaca Perangkat</h4>
                <div class="flex items-center justify-evenly">
                    @php
                        $weatherImage = 'default';
                        if ($device && $device->cuaca) {
                            $weatherImage = strtolower(str_replace(' ', '-', $device->cuaca));
                        }
                    @endphp
                    <img src="{{ Vite::asset('resources/assets/image/weather/' . $weatherImage . '.png') }}"
                        alt="Weather Icon" 
                        class="w-[70px] h-[70px] md:w-[70px] md:h-[70px] lg:w-[130px] lg:h-[130px] mb-2" />
                    <span class="font-bold text-[25px] lg:text-[50px]">
                        @php
                            try {
                                echo $device && $device->suhu ? number_format((float)$device->suhu, 1) : '0';
                            } catch (\Exception $e) {
                                echo '0';
                            }
                        @endphp
                        °C
                    </span>
                </div>
                <span class="text-center font-bold" style="font-size: 14px;">
                    {{ $device && $device->cuaca ? $device->cuaca : 'Tidak ada data' }}
                </span>
            </div>
            <!-- Location Card -->
            <div class="text-white p-4 rounded-[10px]" style="background-color: #7847eb;">
                <div class="flex justify-between items-center">
                    <h4 class="font-bold mb-2 text-xs lg:text-sm">Lokasi Perangkat</h4>
                </div>
                <div class="space-y-2 flex flex-col justify-center items-start h-full ml-2" style="margin-top: -20px;">
                    <div>
                        <p class="text-xs lg:text-sm">Latitude</p>
                        <p class="text-xs lg:text-sm border-b border-white ml-1" style="font-weight: 200;">
       
                        </p>
                    </div>
                    <div>
                        <p class="text-xs lg:text-sm">Longitude</p>
                        <p class="text-xs lg:text-sm border-b border-white ml-1" style="font-weight: 200;">
                     
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-[#D5D2FE] rounded-[20px] p-6 h-auto w-full shadow-lg">
        <h3 class="text-lg font-bold text-black mb-4">Monitoring Solar Panel</h3>
        <div class="flex items-center justify-center h-full">
            <div class="grid grid-cols-2 gap-4 w-full" style="margin-top: -10px;">
                <!-- Horizontal Card -->
                <div class="flex flex-col justify-between bg-[#EB474A] text-white p-4 rounded-[10px] h-25 lg:h-64 w-full mb-2">
                    <span class="font-semibold text-start text-[16px] lg:text-[30px]">Horizontal</span>
                    <div class="relative flex items-center justify-center flex-grow">
                        <span class="text-[64px] lg:text-[90px] font-bold">20</span>
                        <span class="text-[40px]" style="margin-top: -50px;">°</span>
                    </div>
                </div>
                <!-- Vertical Card -->
                <div class="flex flex-col justify-between bg-[#EB474A] text-white p-4 rounded-[10px] h-25 lg:h-64 w-full mb-2">
                    <span class="font-semibold text-start text-[16px] lg:text-[30px]">Vertikal</span>
                    <div class="relative flex items-center justify-center flex-grow">
                        <span class="text-[64px] lg:text-[90px] font-bold">20</span>
                        <span class="text-[40px]" style="margin-top: -50px;">°</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="bg-[#D5D2FE] rounded-[20px] p-6 h-auto w-full shadow-lg lg:col-span-2 lg:mx-auto">
        <h3 class="text-lg font-bold text-black mb-4">Monitoring Energi</h3>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <!-- Ampere Card -->
            <div class="flex flex-col items-center justify-center bg-[#F4A261] text-white p-4 rounded-lg shadow-md">
                <span class="font-semibold text-[16px] lg:text-[30px]">Ampere (A)</span>
                <span class="text-[64px] lg:text-[90px] font-bold">20<span class="text-[24px]">A</span></span>
            </div>
            <!-- Volt Card -->
            <div class="flex flex-col items-center justify-center bg-[#F4A261] text-white p-4 rounded-lg shadow-md">
                <span class="font-semibold text-[16px] lg:text-[30px]">Volt (V)</span>
                <span class="text-[64px] lg:text-[90px] font-bold">20<span class="text-[24px]">V</span></span>
            </div>
        </div>
        <div class="bg-[#F4A261] text-white p-6 rounded-lg shadow-md flex flex-col items-center justify-center w-full">
            <span class="font-semibold text-[16px] lg:text-[30px] mb-4">Battery (B)</span>
            <div class="relative w-full max-w-lg h-24 bg-gray-300 rounded-[20px] overflow-hidden border-2 border-[#474747]">
                <div class="absolute bottom-0 w-[510px] h-full bg-purple-500"></div>
                <span class="absolute top-1/2 left-0 transform -translate-y-1/2 text-black text-sm px-1 rounded font-bold">0%</span>
                <span class="absolute top-1/2 right-0 transform -translate-y-1/2 text-black text-sm px-1 rounded font-bold">100%</span>
                <span class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white text-lg font-bold px-2 py-1 rounded">50%</span>
            </div>
        </div>
    </div>
</div>

<script>
    // Jika ada kode perangkat di session, simpan ke localStorage
    @if(session()->has('device_code'))
        localStorage.setItem('kode_perangkat', '{{ session("device_code") }}');
    @endif
</script>
