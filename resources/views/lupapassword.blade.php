<!DOCTYPE html>  
<html lang="id">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">  
    @vite(['resources/css/app.css', 'resources/js/app.js'])  
    <style>  
        body {  
            background: url('{{ Vite::asset('resources/assets/image/background/bg-awal.png') }}') no-repeat center center fixed;  
            background-size: cover; /* Pastikan gambar menutupi seluruh latar belakang */  
        }  
        .glass-card {  
            border-radius: 50px;  
            border: 4px solid rgba(0, 0, 0, 0.1); /* Menggunakan RGBA untuk opacity 10% */  
            background: rgba(32, 36, 37, 0.1);  
            backdrop-filter: blur(6.8px);  
        }  
        .selamat {  
            font-size: 24px;  
        }  

        @media (max-width: 768px) {  
            body {  
                background: url('{{ Vite::asset('resources/assets/image/background/bg-awal-mobile.png') }}') no-repeat center center fixed; /* Ganti dengan gambar latar belakang untuk mobile */  
                background-size: cover; /* Pastikan gambar menutupi seluruh latar belakang */  
            }  
            .selamat {  
                font-size: 18px;  
            }  
            .glass-card {  
                margin: 40px 10px; /* Tambahan jarak untuk perangkat mobile */  
            }
        }  
    </style>  
    <title>Card Example</title>  
</head>  
<body class="flex items-center justify-center min-h-screen">  
    <div class="glass-card p-8 w-full max-w-md flex flex-col items-center bg-bg-awal mx-4 sm:mx-6 md:mx-8 lg:mx-0">  
        <div class="mb-4">  
            <img src="{{ Vite::asset('resources/assets/image/logo/logo.png') }}" alt="Icon" class="w-24 h-24">  
        </div>  
        <h2 class="text-center mb-5" style="position: relative; top: -10px; font-size: 14px; color: black; font-weight: 600; font-family: 'Poppins', sans-serif;">Track the Sun, Power Your Future!</h2>  
        <h3 class="text-center font-bold selamat" style="color: black; font-weight: 800; font-family: 'Poppins', sans-serif;">Lupa Password?</h3>  
        <p class="text-center mb-10" style="font-size: 12px; color: black; font-weight: 600; font-family: 'Poppins', sans-serif;">Tenang Helios Tracker dapat mengirimkan  link 
            untuk megubah password anda</p>  
        <form class="w-full">  

        <div style="padding: 0 5px">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" style="font-size: 16px; color: black; font-weight: 800; font-family: 'Poppins', sans-serif;">Email</label>  
        </div>
            <div class="relative mb-6">  
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">  
                    <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">  
                        <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>  
                        <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>  
                    </svg>  
                </div>  
                <input type="email" id="email" class="bg-black bg-opacity-50 border border-gray-600 text-white text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full pl-10 p-2.5 dark:bg-black dark:bg-opacity-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 placeholder:text-white" placeholder="name@flowbite.com" required>  
            </div>  
            <div class="flex justify-center mb-4">  
                <button type="submit" class="w-64 text-white from-gray-800 via-gray-900 to-black  focus:ring-4 focus:ring-gray-500 dark:focus:ring-gray-800 shadow-lg shadow-gray-500/50 dark:shadow-lg dark:shadow-gray-800/80 font-medium rounded-full text-sm px-5 py-2.5 text-center" style="background-color: #E8767C ;font-size: 20px; color: rgb(255, 255, 255); font-weight: 600; font-family: 'Poppins', sans-serif; ">  
                    Get Recovery  
                </button>  
            </div>  
        
       
        </form> 

        <script>  
            function togglePassword() {  
                const passwordInput = document.getElementById('password');  
                const eyeIcon = document.getElementById('eye-icon');  
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

            function toggleConfirmPassword() {  
                const confirmPasswordInput = document.getElementById('confirm-password');  
                const confirmEyeIcon = document.getElementById('confirm-eye-icon');  
                if (confirmPasswordInput.type === 'password') {  
                    confirmPasswordInput.type = 'text';  
                    confirmEyeIcon.classList.remove('fa-eye');  
                    confirmEyeIcon.classList.add('fa-eye-slash');  
                } else {  
                    confirmPasswordInput.type = 'password';  
                    confirmEyeIcon.classList.remove('fa-eye-slash');  
                    confirmEyeIcon.classList.add('fa-eye');  
                }  
            }  
        </script>  
    </div>  
</body>  
</html>