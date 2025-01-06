<div class="container-berikut mx-auto px-4 mt-10">  
    <div class="mb-8">  
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Device List</h1>  
        <p class="text-[12px] mt-2 text-gray-600 lg:text-sm md:text-base text-justify ">  
            Berikut adalah daftar perangkat yang telah berhasil dipasangkan, mencakup semua perangkat yang terhubung dan siap digunakan. Informasi ini penting untuk memastikan konektivitas yang optimal dan memudahkan pengelolaan perangkat dalam sistem Anda, dan tekan pada kotak perangkat untuk menghapus perangkat  
        </p>  
    </div>  
</div>  

<div class="relative w-full lg:w-[calc(100%-200px)] p-0 lg:ml-[90px] pb-[150px]">  
    <div class="flex items-center justify-center w-full">  
        <!-- Device Grid -->  
        <div class="flex flex-col gap-4">  
            @foreach([1, 2, 3] as $deviceNumber)
            <div x-data="{ 
                    showTrash: false,
                    isVisible: true,
                    deleteDevice() {
                        this.isVisible = false;
                        setTimeout(() => {
                            this.$el.remove();
                        }, 500);
                    }
                }" 
                x-show="isVisible"
                x-transition:leave="transition ease-in duration-500"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="relative bg-[#FB7B4A] rounded-[10px] shadow-md cursor-pointer
                        w-[324px] h-[81px] md:w-[324px] md:h-[81px] lg:w-[608px] lg:h-[132px]   
                        mx-auto lg:mx-0  
                        transform transition-all duration-300 ease-in-out  
                        hover:shadow-lg hover:-translate-y-1 hover:brightness-105"
                @click="
                    showTrash = true;
                    setTimeout(() => { showTrash = false }, 3000);
                ">
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
                            Device {{ $deviceNumber }}
                        </h3>
                        <p class="font-poppins text-[#414141]   
                                 text-[12px] lg:text-[16px]">
                            Kode Perangkat: #22334235
                        </p>
                    </div>
                </div>

                <!-- Trash Icon -->
                <div x-show="showTrash"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-90"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-90"
                     class="absolute top-1/2 right-6 -translate-y-1/2 bg-white p-2 rounded-full shadow-lg"
                     @click.stop="$dispatch('open-confirm-modal')">
                    <i class="fas fa-trash-alt text-red-500 text-xl lg:text-2xl hover:text-red-600 transition-colors"></i>
                </div>
            </div>

            <!-- Confirmation Modal untuk setiap device -->
            <x-confirmation-modal 
                title="Hapus Device"
                message="Apakah Anda yakin ingin menghapus Device {{ $deviceNumber }}?"
                confirmText="Ya, Hapus"
                cancelText="Batal"
                method="DELETE"
                icon="fa-trash-alt"
                iconBgColor="bg-red-50"
                iconColor="text-red-500"
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

<!-- Alpine.js -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> 