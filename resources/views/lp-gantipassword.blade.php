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
    }  
    </style>  
    <title>Card Example</title>  
</head>  
<body class="flex items-center justify-center min-h-screen">  
    <div class="glass-card p-8 w-full max-w-md flex flex-col items-center bg-bg-awal mx-4 sm:mx-6 md:mx-8 lg:mx-0">  
        <div class="mb-4">  
            <img src="{{ Vite::asset('resources/assets/image/logo/logo.png') }}" alt="Icon" class="w-24 h-24">  
        </div>  
        <h2 class="text-center  mb-5" style="position: relative; top: -10px; font-size: 14px; color: black; font-weight: 600; font-family: 'Poppins', sans-serif;">Track the Sun, Power Your Future!</h2>  
        <h3 class="text-center font-bold selamat" style=" color: black; font-weight: 800; font-family: 'Poppins', sans-serif;">Atur Ulang Password Baru</h3>  
        <p class="text-center mb-10" style="font-size: 12px; color: black; font-weight: 600; font-family: 'Poppins', sans-serif;">Silahkan masukkan password baru Anda dan konfirmasi untuk melanjutkan.</p>  
        <form class="w-full">  
    
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" style="font-size: 14px; color: black; font-weight: 600; font-family: 'Poppins', sans-serif;">Password</label>  
            <div class="relative mb-6">  
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">  
                    <i class="fas fa-lock text-white"></i>  
                </div>  
                <input type="password" id="password" class="bg-black bg-opacity-50 border border-gray-600 text-white text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full pl-10 p-2.5 dark:bg-black dark:bg-opacity-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 placeholder:text-white" placeholder="********" required>  
                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3" onclick="togglePassword()">  
                    <i id="eye-icon" class="fas fa-eye text-white"></i>  
                </button>  
            </div>  
        
            <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" style="font-size: 14px; color: black; font-weight: 600; font-family: 'Poppins', sans-serif;">Konfirmasi Password</label>  
            <div class="relative mb-6">  
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">  
                    <i class="fas fa-lock text-white"></i>  
                </div>  
                <input type="password" id="confirm-password" class="bg-black bg-opacity-50 border border-gray-600 text-white text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full pl-10 p-2.5 dark:bg-black dark:bg-opacity-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 placeholder:text-white" placeholder="********" required>  
                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3" onclick="toggleConfirmPassword()">  
                    <i id="confirm-eye-icon" class="fas fa-eye text-white"></i>  
                </button>  
            </div>    
            <div class="flex justify-center mb-4">  
                <button type="submit" class="w-64 text-white from-gray-800 via-gray-900 to-black  focus:ring-4 focus:ring-gray-500 dark:focus:ring-gray-800 shadow-lg shadow-gray-500/50 dark:shadow-lg dark:shadow-gray-800/80 font-medium rounded-full text-sm px-5 py-2.5 text-center" style="background-color: #E8767C ;font-size: 20px; color: rgb(255, 255, 255); font-weight: 600; font-family: 'Poppins', sans-serif; ">  
                    Login  
                </button>  
            </div>  
      
        </form>  
    </div>  

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
</body>  
</html>