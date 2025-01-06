<!DOCTYPE html>  
<html lang="id">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">  
    @vite(['resources/css/app.css', 'resources/js/app.js'])  
    <style>  
        body {  
            background: url('{{ Vite::asset('resources/assets/image/background/bg-awal.png') }}') no-repeat center center fixed;  
            background-size: cover;
            min-height: 100vh;
            padding: 20px 0;
        }  
        .glass-card {  
            border-radius: 50px;  
            border: 4px solid rgba(0, 0, 0, 0.1);
            background: rgba(32, 36, 37, 0.1);  
            backdrop-filter: blur(10px);
            margin: auto;
        }  
        .selamat {  
            font-size: 24px;  
        }  

        @media (max-width: 768px) {  
            body {  
                background: url('{{ Vite::asset('resources/assets/image/background/bg-awal-mobile.png') }}') no-repeat center center fixed;
                background-size: cover;
                padding: 40px 0;
            }  
            .selamat {  
                font-size: 18px;  
            }  
            .glass-card {  
                margin: 0 15px;
                padding: 30px 20px !important;
            }
            .form-container {
                margin-bottom: 60px;
            }
            .form-grid {
                grid-template-columns: 1fr !important;
            }
        }  
    </style>  
    <title>Registrasi - Helios Tracker</title>  
</head>  
<body class="flex items-center justify-center">  
    @if (session('message'))
        @if (session('details'))
            <x-alert-detail 
                :type="session('type')" 
                :message="session('message')"
                :details="session('details')" />
        @else
            <x-alert 
                :type="session('type')" 
                :message="session('message')" />
        @endif

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const alert = document.getElementById('alert-short');
                if (alert) {
                    alert.style.display = 'flex';
                    @if(session('redirect_to'))
                        setTimeout(() => {
                            window.location.href = '{{ session('redirect_to') }}';
                        }, 2000);
                    @else
                        setTimeout(() => {
                            alert.style.display = 'none';
                        }, 3000);
                    @endif
                }
            });
        </script>
    @endif

    <div class="glass-card p-8 w-full max-w-4xl flex flex-col items-center form-container">  
        <div class="mb-4">  
            <img src="{{ Vite::asset('resources/assets/image/logo/logo.png') }}" alt="Icon" class="w-24 h-24">  
        </div>  
        <h2 class="text-center mb-5" style="position: relative; top: -10px; font-size: 14px; color: black; font-weight: 600; font-family: 'Poppins', sans-serif;">Track the Sun, Power Your Future!</h2>  
        <h3 class="text-center font-bold selamat" style="color: black; font-weight: 800; font-family: 'Poppins', sans-serif;">Selamat Datang!</h3>  
        <p class="text-center mb-10" style="font-size: 12px; color: black; font-weight: 600; font-family: 'Poppins', sans-serif;">Silahkan Registrasi untuk Melanjutkan</p>  
        
        <form action="{{ route('register') }}" method="POST" class="w-full">  
            @csrf
            <div class="grid grid-cols-2 gap-6 form-grid">
                <!-- Kolom Kiri -->
                <div>
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" style="font-size: 14px; color: black; font-weight: 600; font-family: 'Poppins', sans-serif;">Nama</label>  
                    <div class="relative mb-6">  
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">  
                            <i class="fas fa-user text-white"></i>  
                        </div>  
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="bg-black bg-opacity-50 border border-gray-600 text-white text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full pl-10 p-2.5 dark:bg-black dark:bg-opacity-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 placeholder:text-white" placeholder="Masukkan nama Anda" required>  
                    </div>  

                    <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" style="font-size: 14px; color: black; font-weight: 600; font-family: 'Poppins', sans-serif;">Nomor HP</label>  
                    <div class="relative mb-6">  
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">  
                            <i class="fas fa-phone text-white"></i>  
                        </div>  
                        <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" class="bg-black bg-opacity-50 border border-gray-600 text-white text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full pl-10 p-2.5 dark:bg-black dark:bg-opacity-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 placeholder:text-white" placeholder="Masukkan nomor HP Anda" required>  
                    </div>  

                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" style="font-size: 14px; color: black; font-weight: 600; font-family: 'Poppins', sans-serif;">Email</label>  
                    <div class="relative mb-6">  
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">  
                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">  
                                <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>  
                                <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>  
                            </svg>  
                        </div>  
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="bg-black bg-opacity-50 border border-gray-600 text-white text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full pl-10 p-2.5 dark:bg-black dark:bg-opacity-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 placeholder:text-white" placeholder="name@example.com" required>  
                    </div>  
                </div>

                <!-- Kolom Kanan -->
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-black" style="font-family: 'Poppins', sans-serif;">Password</label>  
                    <div class="relative mb-6">  
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">  
                            <i class="fas fa-lock text-white"></i>  
                        </div>  
                        <input type="password" id="password" name="password" value="{{ old('password') }}" class="bg-black bg-opacity-50 border border-gray-600 text-white text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full pl-10 p-2.5 dark:bg-black dark:bg-opacity-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 placeholder:text-white" placeholder="********" required>  
                        <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3" onclick="togglePassword('password', 'eye-icon')">  
                            <i id="eye-icon" class="fas fa-eye text-white"></i>  
                        </button>  
                    </div>  

                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-black" style="font-family: 'Poppins', sans-serif;">Konfirmasi Password</label>  
                    <div class="relative mb-6">  
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">  
                            <i class="fas fa-lock text-white"></i>  
                        </div>  
                        <input type="password" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}" class="bg-black bg-opacity-50 border border-gray-600 text-white text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full pl-10 p-2.5 dark:bg-black dark:bg-opacity-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 placeholder:text-white" placeholder="********" required>  
                        <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3" onclick="togglePassword('password_confirmation', 'confirm-eye-icon')">  
                            <i id="confirm-eye-icon" class="fas fa-eye text-white"></i>  
                        </button>  
                    </div>  

                    <!-- Button moved inside right column for desktop -->
                    <div class="hidden lg:block">
                        <button type="submit" class="w-full text-white font-medium rounded-full px-5 py-2.5 text-center transition-all hover:shadow-lg" 
                            style="background-color: #E8767C; font-size: 20px; font-family: 'Poppins', sans-serif; margin-top: 25px;">  
                            Registrasi  
                        </button>  
                    </div>
                </div>
            </div>

            <!-- Mobile/Tablet Button (outside grid) -->
            <div class="lg:hidden mt-6 px-4">
                <button type="submit" class="w-full text-white font-medium rounded-full px-5 py-2.5 text-center transition-all hover:shadow-lg" 
                    style="background-color: #E8767C; font-size: 20px; font-family: 'Poppins', sans-serif;">  
                    Registrasi  
                </button>  
            </div>

            <!-- Login text moved outside grid and styled for both mobile and desktop -->
            <div class="text-center mt-4 w-full">
                <p class="text-sm text-white" style="font-family: 'Poppins', sans-serif;">
                    Sudah Mempunyai akun? 
                    <a href="{{ route('login') }}" class="text-white hover:underline font-semibold">Masuk disini</a>
                </p>
            </div>
        </form>  

        <script>  
            function togglePassword(inputId, iconId) {  
                const passwordInput = document.getElementById(inputId);  
                const eyeIcon = document.getElementById(iconId);  
                if (passwordInput.type === 'password') {  
                    passwordInput.type = 'text';  
                    eyeIcon.classList.remove('fa-eye');  
                    eyeIcon.classList.add('fa-eye-slash');  
                } else {  
                    passwordInput.type = 'password';  
                    eyeIcon.classList.remove('fa-eye-slash');  
                    eyeIcon.classList.add('fa-eye');  
                }  
            }  
        </script>  
    </div>  
</body>  
</html>