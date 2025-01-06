<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])  

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-poppins antialiased" style="margin-bottom: 80px;">
    <!-- Navigation Bar -->  
    <x-navigationbarmobile />
    <x-navigationbardesktop /> 

    <!-- Alert Components -->
    @if(session()->has('type') && session()->has('message'))
        @if(session('type') === 'danger' && session()->has('details'))
            <x-alert-detail 
                :type="session('type')" 
                :message="session('message')"
                :details="session('details')"
            />
        @else
            <x-alert 
                :type="session('type')" 
                :message="session('message')" 
            />
        @endif
    @endif

    <div class="container mx-auto px-4 py-8 min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md bg-white shadow-2xl rounded-2xl overflow-hidden transform transition-all duration-300 hover:scale-[1.02]">
            <div class="p-6 sm:p-8 md:p-10">
                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="flex justify-center mb-4">
                        <div class="w-20 h-20 bg-blue-500 rounded-full flex items-center justify-center shadow-lg">
                            <i class="fas fa-lock text-4xl text-white"></i>
                        </div>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Ganti Password</h1>
                    <p class="text-sm text-gray-500 mt-2">Pastikan password baru Anda kuat dan unik</p>
                </div>

                <form action="{{ route('change-password.update') }}" method="POST" class="space-y-6">
                    @csrf
                    <!-- Password Lama -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Password Lama
                        </label>
                        <div class="relative">
                            <i class="fas fa-key absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="password" 
                                   name="current_password"
                                   id="current-password"
                                   class="w-full pl-10 pr-10 py-3 text-sm rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   placeholder="Masukkan password lama"
                                   required>
                            <button type="button" 
                                    onclick="togglePasswordVisibility('current-password', this)"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-500 focus:outline-none">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                        @error('current_password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Divider -->
                    <div class="inline-flex items-center justify-center w-full">
                        <hr class="w-64 h-px my-4 bg-gray-200 border-0">
                        <span class="absolute px-3 font-medium text-gray-900 -translate-x-1/2 bg-white left-1/2">Password Baru</span>
                    </div>

                    <!-- Password Baru -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Password Baru
                        </label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="password" 
                                   name="new_password"
                                   id="new-password"
                                   class="w-full pl-10 pr-10 py-3 text-sm rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   placeholder="Masukkan password baru"
                                   required>
                            <button type="button" 
                                    onclick="togglePasswordVisibility('new-password', this)"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-500 focus:outline-none">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                        <div id="password-strength" class="mt-2 h-1 w-full bg-gray-200 rounded-full">
                            <div id="password-strength-bar" class="h-1 rounded-full transition-all duration-300"></div>
                        </div>
                        @error('new_password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password Baru -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Password Baru
                        </label>
                        <div class="relative">
                            <i class="fas fa-check-circle absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="password" 
                                   name="confirm_password"
                                   id="confirm-password"
                                   class="w-full pl-10 pr-10 py-3 text-sm rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   placeholder="Konfirmasi password baru"
                                   required>
                            <button type="button" 
                                    onclick="togglePasswordVisibility('confirm-password', this)"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-500 focus:outline-none">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                        @error('confirm_password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-4 pt-4">
                        <button type="button" 
                                onclick="window.location.href='{{ route('settings') }}'"
                                class="w-1/2 py-3 rounded-lg border border-blue-500 text-blue-500 hover:bg-blue-50 transition">
                            Batal
                        </button>
                        <button type="submit" 
                                class="w-1/2 py-3 rounded-lg bg-blue-500 text-white hover:bg-blue-600 transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }

        // Password Strength Indicator
        document.getElementById('new-password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('password-strength-bar');
            
            let strength = 0;
            if (password.length > 7) strength++;
            if (password.match(/[a-z]+/)) strength++;
            if (password.match(/[A-Z]+/)) strength++;
            if (password.match(/[0-9]+/)) strength++;
            if (password.match(/[$@#&!]+/)) strength++;

            strengthBar.style.width = `${strength * 20}%`;
            
            if (strength < 2) {
                strengthBar.style.backgroundColor = 'red';
            } else if (strength < 4) {
                strengthBar.style.backgroundColor = 'orange';
            } else {
                strengthBar.style.backgroundColor = 'green';
            }
        });
    </script>
</body>
</html>