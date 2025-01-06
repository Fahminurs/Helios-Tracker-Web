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
            position: relative; /* Position relative for countdown positioning */  
        }  
        .selamat {  
            font-size: 24px;  
        }  
        .countdown {  
    color: #C81B1E; /* Text color */  
    font-family: 'Poppins', sans-serif; /* Font family */  
    font-weight: 600; /* Font weight */  
    font-size: 30px; /* Font size */  
    position: absolute; /* Positioning */  
    top: -34px; /* Adjust as needed */  
    right: -12px; /* Adjust as needed */  
    padding: 10px; /* Padding for better appearance */  
    border-radius: 50%; /* Make it circular */  
    background:   
        url('{{ Vite::asset('/resources/assets/image/sun.png') }}') no-repeat center; /* Background image */  
    background-size: cover; /* Cover the entire area */  
    width: 120px; /* Set a width for the countdown box */  
    height: 120px; /* Set a height for the countdown box */  
    display: flex; /* Flexbox for centering text */  
    align-items: center; /* Center vertically */  
    justify-content: center; /* Center horizontally */  
    box-shadow:   
    0 0 10px rgba(255, 223, 0, 0.8), /* Inner glow */  
        0 0 20px rgba(255, 223, 0, 0.6), /* Medium glow */  
        0 0 30px rgba(255, 223, 0, 0.4), /* Outer glow */  
        0 0 40px rgba(255, 223, 0, 0.2), /* Faint glow */  
        0 0 50px rgba(255, 223, 0, 0.1); /* Faint glow */   
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
        <div class="countdown" id="countdown">120</div> <!-- Countdown Timer -->  
        <div class="mb-4">  
            <img src="{{ Vite::asset('resources/assets/image/logo/logo.png') }}" alt="Icon" class="w-24 h-24">  
        </div>  
        <h2 class="text-center mb-5" style="position: relative; top: -10px; font-size: 14px; color: black; font-weight: 600; font-family: 'Poppins', sans-serif;">Track the Sun, Power Your Future!</h2>  
        <h3 class="text-center font-bold selamat" style="color: black; font-weight: 800; font-family: 'Poppins', sans-serif;">Verifikasi Kode OTP</h3>  
        <p class="text-center mb-10" style="font-size: 12px; color: black; font-weight: 600; font-family: 'Poppins', sans-serif;">Masukkan kode OTP yang telah dikirimkan ke email Anda untuk melanjutkan proses pengaturan ulang password.</p>  
        <form class="w-full">  

        <div style="padding: 0 5px">  
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" style="font-size: 16px; color: black; font-weight: 800; font-family: 'Poppins', sans-serif;">Kode OTP</label>  
        </div>  
            <div class="relative mb-6">  
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">  
                    <i class="fas fa-lock text-white"></i>  
                </div>  
                <input type="text"  class="bg-black bg-opacity-50 border border-gray-600 text-white text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full pl-10 p-2.5 dark:bg-black dark:bg-opacity-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 placeholder:text-white" placeholder="Masukkan Kode OTP" required>  
            </div>  
            <div class="flex justify-center mb-4">  
                <button id="verifyButton" type="submit" class="w-64 text-white from-gray-800 via-gray-900 to-black focus:ring-4 focus:ring-gray-500 dark:focus:ring-gray-800 shadow-lg shadow-gray-500/50 dark:shadow-lg dark:shadow-gray-800/80 font-medium rounded-full text-sm px-5 py-2.5 text-center" style="background-color: #E8767C; font-size: 20px; color: rgb(255, 255, 255); font-weight: 600; font-family: 'Poppins', sans-serif;">  
                    Verifikasi OTP  
                </button>  
            </div>   
        </form>   

        <script>  
            document.getElementById('verifyButton').addEventListener('click', function() {  
                // Change button to loading spinner  
                this.innerHTML = '<span class="loading loading-spinner loading-md"></span>';  
                this.disabled = true; // Optionally disable the button to prevent multiple clicks  
            });  
        </script>  
        <script>  
            // Countdown Timer Script  
            let timeLeft = 120; // 120 seconds  
            const countdownElement = document.getElementById('countdown');  

            function updateCountdown() {  
                countdownElement.textContent = timeLeft;  
                if (timeLeft > 0) {  
                    timeLeft--;  
                } else {  
                    clearInterval(countdownInterval);  
                    countdownElement.textContent = "Waktu Habis"; // Message when time is up  
                }  
            }  

            const countdownInterval = setInterval(updateCountdown, 1000);  
        </script>  
    </div>  
</body>  
</html>