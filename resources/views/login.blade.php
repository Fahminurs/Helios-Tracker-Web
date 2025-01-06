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
        }  
    </style>  
    <title>Login - Helios Tracker</title>  
</head>  
<body class="flex items-center justify-center">  
    @if(session()->has('success_alert'))
        <x-alert 
            :type="session('success_alert.type')" 
            :message="session('success_alert.message')" 
        />
        <script>
            // Redirect berdasarkan role setelah 2 detik
            setTimeout(() => {
                @if(Auth::user()->role === 'admin')
                    window.location.href = "{{ route('dashboard') }}";
                @else
                    window.location.href = "{{ route('main') }}";
                @endif
            }, 2000);
        </script>
    @endif

    @if(session('type') === 'danger')
        <x-alert-detail 
            :type="session('type')" 
            :message="session('message')"
            :details="session('details')"
        />
    @endif

    <div class="glass-card p-8 w-full max-w-lg flex flex-col items-center form-container">  
        <div class="mb-4">  
            <img src="{{ Vite::asset('resources/assets/image/logo/logo.png') }}" alt="Icon" class="w-24 h-24">  
        </div>  
        <h2 class="text-center mb-5" style="position: relative; top: -10px; font-size: 14px; color: black; font-weight: 600; font-family: 'Poppins', sans-serif;">Track the Sun, Power Your Future!</h2>  
        <h3 class="text-center font-bold selamat" style="color: black; font-weight: 800; font-family: 'Poppins', sans-serif;">Selamat Datang Kembali!</h3>  
        <p class="text-center mb-10" style="font-size: 12px; color: black; font-weight: 600; font-family: 'Poppins', sans-serif;">Silahkan Login untuk Melanjutkan</p>  
        
        <form action="{{ route('login.submit') }}" method="POST" class="w-full max-w-sm">
            @csrf
            <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" style="font-size: 14px; color: black; font-weight: 600; font-family: 'Poppins', sans-serif;">Email</label>  
                <div class="relative">  
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">  
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">  
                            <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>  
                            <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>  
                        </svg>  
                    </div>  
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="bg-black bg-opacity-50 border border-gray-600 text-white text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full pl-10 p-2.5 dark:bg-black dark:bg-opacity-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 placeholder:text-white" placeholder="name@example.com" required>  
                </div>  
            </div>

            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-black" style="font-family: 'Poppins', sans-serif;">Password</label>  
                <div class="relative">  
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">  
                        <i class="fas fa-lock text-white"></i>  
                    </div>  
                    <input type="password" id="password" name="password" class="bg-black bg-opacity-50 border border-gray-600 text-white text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full pl-10 p-2.5 dark:bg-black dark:bg-opacity-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 placeholder:text-white" placeholder="********" required>  
                    <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3" onclick="togglePassword('password', 'eye-icon')">  
                        <i id="eye-icon" class="fas fa-eye text-white"></i>  
                    </button>  
                </div>  
            </div>

            <button type="submit" class="w-full text-white font-medium rounded-full px-5 py-2.5 text-center transition-all hover:shadow-lg mb-6" 
                style="background-color: #E8767C; font-size: 20px; font-family: 'Poppins', sans-serif;">  
                Login  
            </button>  

            <div class="text-center w-full">
                <p class="text-sm text-white" style="font-family: 'Poppins', sans-serif;">
                    Belum punya akun? 
                    <a href="{{ route('registrasi') }}" class="text-white hover:underline font-semibold">Daftar disini</a>
                </p>
            </div>
        </form>  
    </div>  

    <script>
    // Hanya untuk toggle password visibility
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
</body>  
</html>