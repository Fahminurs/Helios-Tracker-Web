<div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-[10px] w-full mt-7" wire:poll.1s>
        <!-- Card 1 -->
        <div class="bg-[#D5D2FE] rounded-[20px] p-6 h-auto w-full shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-base lg:text-lg font-bold text-gray-800">Informasi Perangkat</h3>
                <div class="relative">

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
                <x-dashboard.nama_devices :device="$device" />
                
                <!-- Sub Card 2 -->
                <div class="flex items-center text-white p-2 rounded-[10px]" style="background-color: #7847eb;">
                    <i class="fas fa-key mr-2"></i>
                    <span class="text-sm lg:text-base">Kode Perangkat: {{ $device->kode_perangkat ?? 'Tidak ada' }}</span>
                </div>
                <!-- Sub Card 3 -->
                <div class="flex items-center text-white p-2 rounded-[10px]" style="background-color: #7847eb;">
                    <i class="fas fa-cogs mr-2"></i>
                    <span class="text-sm lg:text-base">Status Servo: {{ $device->status_servo ?? 'Tidak ada' }}</span>
                </div>
                <!-- Sub Card 4 -->
                <div class="flex items-center text-white p-2 rounded-[10px]" style="background-color: #7847eb;">
                    <i class="fas fa-microchip mr-2"></i>
                    <span class="text-sm lg:text-base">Status ESP32: {{ $device->status_esp32 ?? 'Tidak ada' }}</span>
                </div>
            </div>
   
        </div>

        <!-- Monitoring Solar Panel -->
        <div class="bg-[#D5D2FE] rounded-[20px] p-6 h-auto w-full shadow-lg">
            <h3 class="text-lg font-bold text-black mb-4">Monitoring Solar Panel</h3>
            <div class="flex items-center justify-center h-full">
                <div class="grid grid-cols-2 gap-4 w-full" style="margin-top: -10px;">
                    <!-- Horizontal Card -->
                    <div class="flex flex-col justify-between bg-[#EB474A] text-white p-4 rounded-[10px] h-25 lg:h-64 w-full mb-2">
                        <span class="font-semibold text-start text-[16px] lg:text-[30px]">Horizontal</span>
                        <div class="relative flex items-center justify-center flex-grow">
                            <span class="text-[64px] lg:text-[90px] font-bold">{{ $monitoringSolar->posisi_x ?? '0' }}</span>
                            <span class="text-[40px]" style="margin-top: -50px;">°</span>
                        </div>
                    </div>
                    <!-- Vertical Card -->
                    <div class="flex flex-col justify-between bg-[#EB474A] text-white p-4 rounded-[10px] h-25 lg:h-64 w-full mb-2">
                        <span class="font-semibold text-start text-[16px] lg:text-[30px]">Vertikal</span>
                        <div class="relative flex items-center justify-center flex-grow">
                            <span class="text-[64px] lg:text-[90px] font-bold">{{ $monitoringSolar->posisi_y ?? '0' }}</span>
                            <span class="text-[40px]" style="margin-top: -50px;">°</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monitoring Energi -->
        <div class="bg-[#D5D2FE] rounded-[20px] p-6 h-auto w-full shadow-lg lg:col-span-2 lg:mx-auto">
            <h3 class="text-lg font-bold text-black mb-4">Monitoring Energi</h3>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <!-- Ampere Card -->
                <div class="flex flex-col items-center justify-center bg-[#F4A261] text-white p-4 rounded-lg shadow-md">
                    <span class="font-semibold text-[16px] lg:text-[30px]">Ampere (A)</span>
                    <span class="text-[64px] lg:text-[90px] font-bold">{{ $monitoringEnergi->ampere ?? '0' }}<span class="text-[24px]">A</span></span>
                </div>
                <!-- Volt Card -->
                <div class="flex flex-col items-center justify-center bg-[#F4A261] text-white p-4 rounded-lg shadow-md">
                    <span class="font-semibold text-[16px] lg:text-[30px]">Volt (V)</span>
                    <span class="text-[64px] lg:text-[90px] font-bold">{{ $monitoringEnergi->volt ?? '0' }}<span class="text-[24px]">V</span></span>
                </div>
            </div>
            <div class="bg-[#F4A261] text-white p-6 rounded-lg shadow-md flex flex-col items-center justify-center w-full">
                <span class="font-semibold text-[16px] lg:text-[30px] mb-4">Battery (B)</span>
                <div class="relative w-full max-w-lg h-24 bg-gray-300 rounded-[20px] overflow-hidden border-2 border-[#474747]">
                    <div class="absolute bottom-0 h-full bg-purple-500" style="width: {{ $monitoringEnergi->battery ?? '0' }}%"></div>
                    <span class="absolute top-1/2 left-0 transform -translate-y-1/2 text-black text-sm px-1 rounded font-bold">0%</span>
                    <span class="absolute top-1/2 right-0 transform -translate-y-1/2 text-black text-sm px-1 rounded font-bold">100%</span>
                    <span class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white text-lg font-bold px-2 py-1 rounded">{{ $monitoringEnergi->battery ?? '0' }}%</span>
                </div>
            </div>
        </div>
    </div>
</div>
