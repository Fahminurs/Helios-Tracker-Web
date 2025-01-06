<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Settings Page</title>  
    @vite(['resources/css/app.css', 'resources/js/app.js'])  
    <!-- Font Awesome -->  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">  
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>  
        .container {  
            padding-left: 170px;  
            padding-right: 170px;  
        }  
  
        @media (max-width: 512px) {  
            .container {  
                padding-left: 0px;  
                padding-right: 0px;   
                padding-bottom: 100px;  
                padding-top: 10px;  
            }  
            
            /* Pengaturan font untuk perangkat mobile */  
            h1 {  
                font-size: 1.25rem; /* Setara dengan text-xl */  
            }  
            
            .text-lg {  
                font-size: 0.9rem; /* Sedikit lebih kecil dari text-base */  
            }  
            
            .text-xs {  
                font-size: 0.7rem; /* Lebih kecil */  
            }  
        }  
    </style>  
</head>  
<body class="font-poppins">  
    <x-navigationbardesktop/>  
    <x-navigationbarmobile/>  
    
    <!-- Confirmation Modal Component -->
    <x-confirmation-modal 
        title="Konfirmasi Keluar"
        message="Apakah Anda yakin ingin keluar dari sistem?"
        confirmText="Ya, Keluar"
        cancelText="Batal"
        confirmRoute="{{ route('logout') }}"
        method="POST"
        icon="fa-sign-out-alt"
        iconBgColor="bg-red-50"
        iconColor="text-red-500"
    />

    <div class="container">  
        <div class="mx-auto p-4 md:p-6">  
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 md:mb-8">Settings</h1>  
            <!-- Profile Section -->  
            <div class="flex items-center bg-white rounded-xl shadow-md p-4 mb-6">  
                <img src="{{ Vite::asset('resources/assets' . Auth::user()->foto_profil) }}" alt="Profile" class="w-16 h-16 md:w-20 md:h-20 rounded-full object-cover">  
                <div class="ml-4">  
                    <h2 class="text-lg font-semibold text-black" style="font-size: 14px">{{ Auth::user()->nama }}</h2> 
                    <p class="text-gray-500" style="font-size: 12px">{{ Auth::user()->email }}</p>  
                </div>  
            </div>  

            <!-- Phone and Device Card -->  
            <div class="bg-white rounded-xl shadow-md p-4 mb-6">  
                <div class="flex justify-between items-start mt-2">  
                    <div class="flex items-center">  
                        <i class="fas fa-phone mr-3 text-gray-600"></i>  
                        <div class="flex flex-col">  
                            <h3 class="text-lg font-semibold text-black">Nomor Telepon</h3>  
                            <span class="text-gray-500">{{ Auth::user()->no_hp }}</span>   
                        </div>  
                    </div>  
                </div>  
                <div class="flex justify-between items-start mt-2">  
                    <div class="flex items-center">  
                        <i class="fas fa-mobile-alt mr-3 text-gray-600"></i>  
                        <div class="flex flex-col">  
                            <h3 class="text-lg font-semibold text-black">Device</h3>  
                            <span class="text-gray-500">1 Buah</span>    
                        </div>  
                    </div>  
                </div>  
            </div>  

            <!-- Update Account Card -->  
            <a href="{{ route('update-account') }}" class="block">  
                <div class="bg-white rounded-xl shadow-md p-4 mb-6 flex justify-between items-center hover:bg-gray-50 transition-colors duration-200">  
                    <div class="flex items-center">  
                        <i class="fas fa-user-edit mr-3 text-gray-600"></i>  
                        <div>  
                            <h3 class="text-lg font-semibold text-black">Update Akun</h3>  
                            <p class="text-gray-500 text-xs">Buat perubahan pada akun Anda</p>  
                        </div>  
                    </div>  
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />  
                    </svg>  
                </div>  
            </a>  

            <!-- Change Password Card -->  
            <a href="{{ route('change-password') }}" class="block">  
                <div class="bg-white rounded-xl shadow-md p-4 mb-6 flex justify-between items-center hover:bg-gray-50 transition-colors duration-200">  
                    <div class="flex items-center">  
                        <i class="fas fa-lock mr-3 text-gray-600"></i>  
                        <div>  
                            <h3 class="text-lg font-semibold text-black">Ganti Password</h3>  
                            <p class="text-gray-500 text-xs">Amankan akun Anda demi keamanan</p>  
                        </div>  
                    </div>  
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />  
                    </svg>  
                </div>  
            </a>  

            <!-- About App Card -->  
            <a href="{{ route('about-app') }}" class="block">  
                <div class="bg-white rounded-xl shadow-md p-4 mb-6 flex justify-between items-center hover:bg-gray-50 transition-colors duration-200">  
                    <div class="flex items-center">  
                        <i class="fas fa-info-circle mr-3 text-gray-600"></i>  
                        <div>  
                            <h3 class="text-lg font-semibold text-black">Tentang Aplikasi</h3>  
                            <p class="text-gray-500 text-xs">Detail informasi aplikasi ini dibuat</p>  
                        </div>  
                    </div>  
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />  
                    </svg>  
                </div>  
            </a>  

            <!-- Logout Card -->  
            <div class="block cursor-pointer" x-data @click="$dispatch('open-confirm-modal')">  
                <div class="bg-white rounded-xl shadow-md p-4 mb-6 flex justify-between items-center hover:bg-gray-50 transition-colors duration-200">  
                    <div class="flex items-center">  
                        <i class="fas fa-sign-out-alt mr-3 text-red-600"></i>  
                        <div>  
                            <h3 class="text-lg font-semibold text-red-600">Keluar</h3>  
                            <p class="text-gray-500 text-xs">Keluar dari sistem</p>  
                        </div>  
                    </div>  
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />  
                    </svg>  
                </div>  
            </div>  
        </div>  
    </div>  
</body>  
</html>