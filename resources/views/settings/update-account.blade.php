<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])  

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-poppins antialiased">
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

    <!-- Confirmation Modal -->
    <x-confirmation-modal
        title="Konfirmasi Perubahan"
        message="Apakah Anda yakin ingin menyimpan perubahan ini?"
        confirmText="Ya, Simpan"
        cancelText="Batal"
        :formId="'updateForm'"
        method="POST"
        icon="fa-save"
        iconBgColor="bg-blue-50"
        iconColor="text-blue-500"
    />

    
    <div class="container mx-auto px-4 py-8 min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md sm:max-w-lg bg-white shadow-xl rounded-2xl overflow-hidden">
            <div class="p-6 sm:p-8 md:p-10">
                <!-- Profile Header -->
                <div class="flex flex-col sm:flex-row items-center mb-6 sm:mb-8 space-y-4 sm:space-y-0 sm:space-x-6">
                    <div class="relative">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-blue-500 flex items-center justify-center shadow-lg">
                            <img id="preview-image" 
                                 class="w-18 h-18 sm:w-22 sm:h-22 rounded-full object-cover border-4 border-white"
                                 src="{{ Vite::asset('resources/assets' . Auth::user()->foto_profil) }}" 
                                 alt="Profile preview" />
                        </div>
                        <label class="absolute bottom-0 right-0 bg-blue-500 text-white rounded-full p-1.5 sm:p-2 cursor-pointer hover:bg-blue-600 transition">
                            <i class="fas fa-camera text-xs sm:text-sm"></i>
                            <input type="file" 
                                   id="profile-upload"
                                   name="foto_profil"
                                   accept="image/*"
                                   form="updateForm"
                                   class="hidden"/>
                        </label>
                    </div>
                    <div class="text-center sm:text-left">
                        <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-800">Update Akun</h1>
                        <p class="text-xs sm:text-sm text-gray-500">Perbarui informasi profil Anda</p>
                    </div>
                </div>

                <form id="updateForm" 
                      action="{{ route('update-account.update') }}" 
                      method="POST" 
                      enctype="multipart/form-data"
                      class="space-y-4 sm:space-y-6">  
                    @csrf
                    @method('POST')

                    <!-- Full Name Input -->  
                    <div>  
                        <label class="block text-sm sm:text-sm font-medium text-gray-700 mb-2">  
                            Nama Lengkap  
                        </label>  
                        <div class="relative">  
                            <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>  
                            <input type="text"   
                                   name="nama"
                                   value="{{ old('nama', Auth::user()->nama) }}"
                                   class="w-full pl-10 sm:pl-12 pr-3 sm:pr-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"  
                                   placeholder="Masukkan nama lengkap"  
                                   required>  
                        </div>  
                        @error('nama')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>  
                
                    <!-- Email Input -->  
                    <div>  
                        <label class="block text-sm sm:text-sm font-medium text-gray-700 mb-2">  
                            Email  
                        </label>  
                        <div class="relative">  
                            <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>  
                            <input type="email"   
                                   name="email"
                                   value="{{ old('email', Auth::user()->email) }}"
                                   class="w-full pl-10 sm:pl-12 pr-3 sm:pr-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"  
                                   placeholder="nama@email.com"  
                                   required>  
                        </div>  
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>  
                
                    <!-- Phone Number Input -->  
                    <div>  
                        <label class="block text-sm sm:text-sm font-medium text-gray-700 mb-2">  
                            Nomor Telepon  
                        </label>  
                        <div class="relative">  
                            <i class="fas fa-phone absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>  
                            <input type="tel"   
                                   name="no_hp"
                                   value="{{ old('no_hp', Auth::user()->no_hp) }}"
                                   class="w-full pl-10 sm:pl-12 pr-3 sm:pr-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"  
                                   placeholder="812xxxxxxxx"  
                                   required>  
                        </div>  
                        @error('no_hp')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>  
                
                    <!-- Action Buttons -->  
                    <div class="flex space-x-3 sm:space-x-4 pt-4">  
                        <button type="button"   
                                onclick="window.location.href='{{ route('settings') }}'"  
                                class="w-1/2 py-2 sm:py-3 text-sm sm:text-base rounded-lg border border-blue-500 text-blue-500 hover:bg-blue-50 transition">  
                            Batal  
                        </button>  
                        <button type="submit"   
                                class="w-1/2 py-2 sm:py-3 text-sm sm:text-base rounded-lg bg-blue-500 text-white hover:bg-blue-600 transition">  
                            Simpan Perubahan  
                        </button>  
                    </div> 
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('profile-upload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
            }
            
            reader.readAsDataURL(file);
        });
    </script>
</body>
</html>