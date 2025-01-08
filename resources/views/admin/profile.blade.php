<!-- Form section -->
<form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-8">
    @csrf
    @method('PUT')

    <!-- Informasi Pribadi -->
    <div>
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pribadi</h2>
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name', $user->name) }}" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror"
                    required
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input 
                    type="email" 
                    value="{{ $user->email }}" 
                    class="w-full px-3 py-2 border border-gray-200 rounded-md bg-gray-50"
                    disabled
                >
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                <input 
                    type="tel" 
                    name="phone" 
                    value="{{ old('phone', $user->phone) }}" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 @error('phone') border-red-500 @enderror"
                >
                @error('phone')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Keamanan -->
    <div>
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Keamanan</h2>
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                <input 
                    type="password" 
                    name="password" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 @error('password') border-red-500 @enderror"
                >
                <p class="mt-1 text-sm text-gray-500">Kosongkan jika tidak ingin mengubah password</p>
                @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500"
                >
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div>
        <button 
            type="submit" 
            class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200"
        >
            Simpan Perubahan
        </button>
    </div>

    @if(session('success'))
        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form> 