<!-- Fixed Header Section with proper spacing -->
<div class="fixed top-[144px] lg:top-[144px] lg:left-60 lg:right-10 bg-[#FBF8F6] z-30 pt-10   style="padding-bottom: -100px;">
    <div class="container-berikut mx-auto px-4">  
        <div class="mb-8 max-w-[608px] lg:max-w-full mx-auto">  
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Device List</h1>  
            <p class="text-[12px] mt-2 text-gray-600 lg:text-sm md:text-base text-justify">  
                Berikut adalah daftar perangkat yang telah berhasil dipasangkan, mencakup semua perangkat yang terhubung dan siap digunakan. Informasi ini penting untuk memastikan konektivitas yang optimal dan memudahkan pengelolaan perangkat dalam sistem Anda, dan tekan pada kotak perangkat untuk menghapus perangkat  
            </p>  
        </div>  
    </div>
</div>

<!-- Content Section with proper spacing for fixed header -->
<div class="mt-[280px] lg:mt-[240px]">
    <div class="relative w-full lg:w-[calc(100%-200px)] p-0 lg:ml-[90px] pb-[150px]">  
        <div class="flex items-center justify-center w-full">  
            <!-- Device Grid -->  
            <div class="flex flex-col gap-4">  
                @foreach($devices as $index => $device)  
                <div x-data="{   
                        isVisible: true,
                        isSelected: false,
                        init() {
                            // Cek apakah device ini yang sedang dipilih
                            const selectedCode = localStorage.getItem('selectedDeviceCode');
                            this.isSelected = selectedCode === '{{ $device->kode_perangkat }}';
                        },
                        deleteDevice() {  
                            this.isVisible = false;  
                            setTimeout(() => {  
                                this.$el.remove();  
                            }, 500);  
                        },
                        selectDevice() {
                            if (!this.isSelected) {
                                localStorage.setItem('selectedDeviceName', 'Device ' + {{ $index + 1 }});
                                localStorage.setItem('selectedDeviceCode', '{{ $device->kode_perangkat }}');
                                window.location.href = '{{ route('main.device', ['kode_perangkat' => $device->kode_perangkat]) }}';
                            }
                        }
                    }"   
                    x-show="isVisible"  
                    x-transition:leave="transition ease-in duration-500"  
                    x-transition:leave-start="opacity-100 transform scale-100"  
                    x-transition:leave-end="opacity-0 transform scale-95"  
                    :class="{ 
                        'cursor-not-allowed opacity-90': isSelected,
                        'cursor-pointer hover:shadow-lg hover:-translate-y-1 hover:brightness-105': !isSelected
                    }"
                    class="relative bg-[#FB7B4A] rounded-[10px] shadow-md
                            w-[324px] h-[81px] md:w-[324px] md:h-[81px] lg:w-[608px] lg:h-[132px]   
                            mx-auto lg:mx-0  
                            transform transition-all duration-300 ease-in-out"
                    data-device-id="{{ $device->id_alat }}"  
                    @click="selectDevice()">  
                    <!-- Trash Icon -->  
                    <div class="absolute -top-3 -right-3 group z-50"
                         @click.stop="$dispatch('open-delete-modal')">  
                        <div class="bg-white p-2 rounded-full shadow-lg cursor-pointer
                                    transform transition-all duration-300
                                    hover:scale-110 hover:rotate-12 hover:bg-red-50
                                    active:scale-95">
                            <div class="relative">
                                <i class="fas fa-trash-alt text-red-500 text-lg lg:text-xl
                                         transition-colors group-hover:text-red-600"></i>
                                <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full
                                           opacity-0 group-hover:opacity-100
                                           transform scale-0 group-hover:scale-100
                                           transition-all duration-300"></span>
                            </div>
                        </div>
                        <div class="absolute top-full right-0 mt-1
                                    bg-red-100 text-red-700 text-xs rounded-md py-1 px-2
                                    opacity-0 group-hover:opacity-100
                                    transform -translate-y-2 group-hover:translate-y-0
                                    transition-all duration-300
                                    whitespace-nowrap">
                            Hapus Device
                        </div>
                    </div>

                    <div class="flex items-center h-full p-4 lg:p-6">  
                        <div class="flex-shrink-0 mr-4 ml-5 lg:mr-10 lg:ml-20">  
                            <img src="{{ Vite::asset('resources/assets/image/solar-panel.png') }}"   
                                 alt="Solar Panel"   
                                 class="w-[57px] h-[61px] lg:w-[95px] lg:h-[102px] object-contain">  
                        </div>  
                        <div class="flex flex-col justify-center">  
                            <h3 class="font-['Press_Start_2P'] text-[#414141]   
                                     text-[14px] lg:text-[24px]   
                                     mb-1 lg:mb-2 tracking-wide">  
                                Device {{ $index + 1 }}  
                            </h3>  
                            <div class="flex flex-col">
                                <p class="font-poppins text-[#414141]   
                                        text-[12px] lg:text-[16px]">  
                                    Kode Perangkat: {{ $device->kode_perangkat }}  
                                </p>
                                <p x-show="isSelected" 
                                   class="font-poppins text-white
                                          text-[10px] sm:text-[12px] md:text-[14px] lg:text-[16px]
                                          mt-1 lg:mt-2">
                                    Sedang dipilih
                                </p>
                            </div>
                        </div>  
                    </div>  
                </div>  

                <!-- Delete Modal untuk setiap device -->  
                <x-delete-device-modal
                    :deviceNumber="$index + 1"
                    :deviceId="$device->id_alat"
                />
                @endforeach  
            </div>  
        </div>  

        <!-- Floating Button -->  
        <button class="fixed lg:bottom-10 lg:right-10 bottom-[13vh] right-1 bg-[#7847EB] text-white   
                   rounded-full w-14 h-14 md:w-16 md:h-16   
                   flex items-center justify-center   
                   shadow-2xl border-4 border-white   
                   transition-transform transform   
                   hover:scale-105 active:scale-95   
                   z-50"   
                data-modal-target="add-device-modal"   
                data-modal-toggle="add-device-modal"   
                id="modal-trigger">  
            <span class="text-3xl font-light" style="font-weight: 700">+</span>  
        </button>  
    </div>  
</div>
<!-- Alpine.js -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> 