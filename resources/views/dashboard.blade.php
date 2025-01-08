<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Dashboard</title>  

    @vite(['resources/css/app.css', 'resources/js/app.js'])  
    @livewireStyles
    <style>
          @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');
          @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container {
                padding-left: 16px;
                padding-right: 16px;
            }
            
            h3.font-['Press_Start_2P'] {
                font-size: 14px;
            }
        }

        @media (max-width: 512px) {
            .container {
                padding-left: 12px;
                padding-right: 12px;
            }
            
            h3.font-['Press_Start_2P'] {
                font-size: 12px;
            }

            .grid {
                gap: 16px;
            }
        }

        /* Custom Card Hover Effect */
        .device-card {
            transition: all 0.3s ease;
        }

        .device-card:hover {
            transform: translateY(-2px);
        }
                       /* Memastikan font Press Start 2P dan Poppins terload dengan benar */
             
    
                    /* Hover dan active state animations */
                    @keyframes cardPulse {
                        0% { transform: scale(1); }
                        50% { transform: scale(1.02); }
                        100% { transform: scale(1); }
                    }
    
                    .cursor-pointer:active {
                        animation: cardPulse 0.3s ease-in-out;
                    }
                    .container-berikut {
                        margin-left: -20px;
                    }
    </style>
        

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Add SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>  
<body>  
    <!-- Navigation Bar -->  
    <x-navigationbarmobile />
    <x-navigationbardesktop />   
        {{-- Desktop --}}
        <div class="flex justify-center w-full">
            <x-navbar />   
        </div>

    <!-- Content Section -->
    <div class="flex items-center justify-center min-h-[calc(100vh-200px)] w-full lg:w-[calc(100%-200px)] p-0 mt-32 lg:ml-[170px] pb-[150px] font-poppins">  
        <div class="w-full max-w-[1300px] px-4 sm:px-6 lg:px-8">  
            @if(request()->is('device-list*'))
                @if(session('type'))
                    <script>
                        Swal.fire({
                            title: '{{ session('message') }}',
                            text: '{{ session('details') ? (is_array(session('details')) ? session('details')[0] : session('details')) : '' }}',
                            icon: '{{ session('type') === 'success' ? 'success' : 'error' }}',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            background: '{{ session('type') === 'success' ? '#10B981' : '#EF4444' }}',
                            color: '#ffffff',
                            customClass: {
                                popup: 'colored-toast'
                            },
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                    </script>
                    <style>
                        .colored-toast.swal2-icon-success {
                            background: linear-gradient(to right, #10B981, #059669) !important;
                        }
                        .colored-toast.swal2-icon-error {
                            background: linear-gradient(to right, #EF4444, #DC2626) !important;
                        }
                        .colored-toast {
                            color: #ffffff !important;
                        }
                        .colored-toast .swal2-title {
                            color: #ffffff !important;
                        }
                        .colored-toast .swal2-close {
                            color: #ffffff !important;
                        }
                        .colored-toast .swal2-html-container {
                            color: rgba(255, 255, 255, 0.8) !important;
                        }
                    </style>
                @endif
            @endif

            @if(request()->is('main*'))
                @if(isset($content) && $content === 'notalat')
                    @include('Dashboard.notalat')
                @else
                    @livewire('dashboard.main-dashboard')
                @endif
            @endif

            @if(request()->is('device-list*'))  
                @include('Dashboard.device_list')
            @endif
        </div>  
    </div>  

<!-- Main Modal -->  
<div id="add-device-modal" tabindex="-1" aria-hidden="true"   
    class="fixed top-0 left-0 right-0 z-50 hidden w-full overflow-x-hidden overflow-y-auto md:inset-0   
    h-[calc(100%-1rem)] pb-[100px] sm:pb-0"   
    style="z-index: 9999">  
    <div class="relative w-full max-w-4xl mx-auto my-4">  
        <!-- Modal content -->  
        <div class="relative bg-gradient-to-br from-[#7847EB] to-[#6236c5] rounded-[20px] shadow-xl p-6 overflow-y-auto  
                    max-h-[calc(100vh-180px)] sm:max-h-[calc(100vh-100px)]">  
            <!-- Modal header -->  
            <div class="mb-8 text-center text-white">  
                <div class="w-16 h-16 bg-white rounded-full mx-auto mb-4 flex items-center justify-center">  
                    <i class="fas fa-microchip text-[#7847EB] text-3xl"></i>  
                </div>  
                <h3 class="text-2xl font-bold">  
                    Tambahkan Perangkat Baru  
                </h3>  
                <p class="text-gray-200 text-sm mt-2">Tambah Perangkat Baru dan Nikmati Fitur Menarik!</p>  
            </div>  

            <form action="{{ route('device.register') }}" method="POST">  
                @csrf  
                <!-- Modal body -->  
                <div class="space-y-6">  
                    <!-- Wrapper for responsive layout -->  
                    <div class="flex flex-col sm:flex-row gap-6">  
                        <!-- Step 1 -->  
                        <div class="flex-1 bg-white/10 backdrop-blur-md rounded-xl p-6 text-white border border-white/20">  
                            <div class="flex items-center gap-3 mb-4">  
                                <div class="w-8 h-8 rounded-full bg-white text-[#7847EB] flex items-center justify-center font-bold text-lg">  
                                    1  
                                </div>  
                                <span class="font-semibold">Input Kode Perangkat</span>  
                            </div>  
                            <div class="mt-2">  
                                <div class="flex items-center gap-3 mb-3">  
                                    <i class="fas fa-qrcode text-yellow-300 text-xl"></i>  
                                    <span class="text-sm font-medium">Kode Perangkat</span>  
                                </div>  
                                <input type="text"   
                                       name="kode_perangkat"  
                                       required  
                                       class="w-full bg-white/10 border border-white/20 text-white text-sm rounded-lg p-3   
                                              placeholder-white/50 focus:ring-2 focus:ring-white/50 focus:border-transparent  
                                              backdrop-blur-sm transition-all"   
                                       placeholder="#Masukkan Kode Perangkat">  
                            </div>  
                        </div>  
                    </div>  
                    
                    <!-- Buttons Section -->  
                    <div class="flex justify-center">  
                        <button type="submit"  
                                class="w-full sm:w-1/2 bg-gradient-to-r from-green-400 to-green-500 text-white rounded-lg p-3   
                                       font-semibold hover:opacity-90 transition-all flex items-center justify-center gap-2  
                                       transform hover:scale-105 active:scale-95 shadow-lg"  
                                id="saveBtn">  
                            <i class="fas fa-save text-lg"></i>  
                            <span class="button-text hidden sm:inline">Simpan</span>  
                            <span class="button-text sm:hidden">Save</span>  
                            <span class="loading loading-dots loading-md hidden"></span>  
                        </button>  
                    </div>  
                </div>  
            </form>  

            <!-- Close button -->  
            <button data-modal-hide="add-device-modal"   
                    class="mt-6 text-white/80 hover:text-white transition-colors mx-auto block">  
                <i class="fas fa-times"></i> Tutup  
            </button>  
        </div>  
    </div>  
</div>
    </div>

    {{-- -------------- Update Device Modal --------------  --}}
    <!-- Update Device Modal -->
    <div id="update-device-modal" tabindex="-1" aria-hidden="true" 
        class="fixed top-0 left-0 right-0 z-50 hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 
        h-[calc(100%-1rem)] pb-[100px] sm:pb-0" 
        style="z-index: 9999">
        <div class="relative w-full max-w-md mx-auto my-4">
            <!-- Modal content -->
            <div class="relative bg-gradient-to-br from-[#7847EB] to-[#6236c5] rounded-[20px] shadow-xl p-6 overflow-y-auto
                        max-h-[calc(100vh-180px)] sm:max-h-[calc(100vh-100px)]">
                <!-- Modal header -->
                <div class="mb-8 text-center text-white">
                    <div class="w-16 h-16 bg-white rounded-full mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-map-marker-alt text-[#7847EB] text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold">
                        Update Lokasi Perangkat
                    </h3>
                    <p class="text-gray-200 text-sm mt-2">Perbarui lokasi perangkat Anda dengan mudah!</p>
                </div>

                <!-- Modal body -->
                <div class="space-y-6">
                    <!-- Location Section -->
                    <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 text-white border border-white/20">
                        <div class="flex gap-6">
                            <!-- Input Fields -->
                            <form action="{{ route('update.location') }}" method="POST" class="flex-1 space-y-4">
                                @csrf
                                <input type="hidden" name="kode_perangkat" id="kode_perangkat">
                                <div class="relative">
                                    <label class="block text-sm font-medium mb-2 flex items-center gap-2">
                                        <i class="fas fa-latitude text-yellow-300"></i>
                                        Latitude
                                    </label>
                                    <input type="text" id="update-latitude" name="latitude"
                                           class="w-full bg-white/10 border border-white/20 text-white text-sm rounded-lg p-3 
                                                  placeholder-white/50 focus:ring-2 focus:ring-white/50 focus:border-transparent
                                                  backdrop-blur-sm transition-all cursor-not-allowed" 
                                           placeholder="Latitude akan muncul di sini"
                                           readonly>
                                </div>
                                <div class="relative">
                                    <label class="block text-sm font-medium mb-2 flex items-center gap-2">
                                        <i class="fas fa-longitude text-green-300"></i>
                                        Longitude
                                    </label>
                                    <input type="text" id="update-longitude" name="longitude"
                                           class="w-full bg-white/10 border border-white/20 text-white text-sm rounded-lg p-3 
                                                  placeholder-white/50 focus:ring-2 focus:ring-white/50 focus:border-transparent
                                                  backdrop-blur-sm transition-all cursor-not-allowed" 
                                           placeholder="Longitude akan muncul di sini"
                                           readonly>
                                </div>
                       
                                    <button type="submit"
                                            class="w-1/2 bg-gradient-to-r from-green-400 to-green-500 text-white rounded-lg p-3 
                                                   font-semibold hover:opacity-90 transition-all flex items-center justify-center gap-2
                                                   transform hover:scale-105 active:scale-95 shadow-lg"
                                            id="updateBtn">
                                        <i class="fas fa-save text-lg"></i>
                                        <span class="button-text hidden sm:inline">Update</span>
                                        <span class="button-text sm:hidden">Save</span>
                                        <span class="loading loading-dots loading-md hidden"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Close button -->
                    <button data-modal-hide="update-device-modal" 
                            class="mt-4 text-white/80 hover:text-white transition-colors mx-auto block">
                        <i class="fas fa-times"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
    <script>
        // Jika ada kode perangkat di session, simpan ke localStorage
        @if(isset($script))
            {!! $script !!}
        @endif

        // Event listener untuk update nama device
        window.addEventListener('updateDeviceName', event => {
            localStorage.setItem('selectedDeviceName', event.detail.deviceName);
        });

        // Event listener untuk update localStorage
        window.addEventListener('updateLocalStorage', event => {
            localStorage.setItem(event.detail.key, event.detail.value);
        });

        // Location functions


        function saveLocation() {
            toggleLoading('saveBtn', true);
            
            // Simulasi proses penyimpanan (ganti dengan logika penyimpanan yang sebenarnya)
            setTimeout(() => {
                // Proses penyimpanan selesai
                toggleLoading('saveBtn', false);
                alert('Lokasi berhasil disimpan!');
            }, 2000);
        }

        function getUpdateLocation() {
            // Get device code from URL and set it to hidden input
            const url = window.location.href;
            const segments = url.split('/');
            const deviceCode = segments[segments.length - 1].split('#')[0];
            document.getElementById('kode_perangkat').value = deviceCode;
            
            toggleLoading('updateLocationBtn', true);
            
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    // Success callback
                    function(position) {
                        document.getElementById('update-latitude').value = position.coords.latitude;
                        document.getElementById('update-longitude').value = position.coords.longitude;
                        toggleLoading('updateLocationBtn', false);
                        
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Lokasi berhasil didapatkan.',
                            icon: 'success',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            background: '#10B981',
                            color: '#ffffff',
                            customClass: {
                                popup: 'colored-toast'
                            },
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                    },
                    // Error callback
                    function(error) {
                        let errorMessage;
                        switch(error.code) {
                            case error.PERMISSION_DENIED:
                                errorMessage = "Izin akses lokasi ditolak.";
                                break;
                            case error.POSITION_UNAVAILABLE:
                                errorMessage = "Informasi lokasi tidak tersedia.";
                                break;
                            case error.TIMEOUT:
                                errorMessage = "Waktu permintaan lokasi habis.";
                                break;
                            default:
                                errorMessage = "Terjadi kesalahan yang tidak diketahui.";
                        }
                        
                        Swal.fire({
                            title: 'Error!',
                            text: errorMessage,
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            background: '#EF4444',
                            color: '#ffffff',
                            customClass: {
                                popup: 'colored-toast'
                            },
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                        
                        toggleLoading('updateLocationBtn', false);
                    }
                );
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Geolocation tidak didukung oleh browser ini.',
                    icon: 'error',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#EF4444',
                    color: '#ffffff',
                    customClass: {
                        popup: 'colored-toast'
                    },
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                toggleLoading('updateLocationBtn', false);
            }
        }

        function toggleLoading(buttonId, isLoading) {
            const button = document.getElementById(buttonId);
            const buttonText = button.querySelector('.button-text');
            const loadingSpinner = button.querySelector('.loading');
            const icon = button.querySelector('i');

            if (isLoading) {
                buttonText.classList.add('hidden');
                icon.classList.add('hidden');
                loadingSpinner.classList.remove('hidden');
                button.disabled = true;
            } else {
                buttonText.classList.remove('hidden');
                icon.classList.remove('hidden');
                loadingSpinner.classList.add('hidden');
                button.disabled = false;
            }
        }

        // Initialize Alpine.js components after Livewire loads
        document.addEventListener('livewire:load', function () {
            // Your Alpine.js initialization code here if needed
        });
    </script>
</body>  
</html>