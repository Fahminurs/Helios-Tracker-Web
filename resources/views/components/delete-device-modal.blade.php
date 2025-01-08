@props(['deviceNumber', 'deviceId'])

<div x-data="{ show: false }" 
     x-show="show" 
     x-on:open-delete-modal.window="show = true"
     x-on:close-delete-modal.window="show = false"
     x-on:keydown.escape.window="show = false"
     class="fixed inset-0 z-50 overflow-y-auto" 
     style="display: none;">
    
    <!-- Backdrop -->
    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
        <div class="absolute inset-0 bg-black bg-opacity-25"></div>
    </div>

    <!-- Modal -->
    <div class="flex items-center justify-center min-h-screen p-4 text-center">
        <div class="relative bg-white rounded-3xl max-w-sm w-full mx-auto shadow-xl transform transition-all"
             @click.away="show = false">
            
            <!-- Modal Content -->
            <div class="p-6">
                <!-- Icon and Title -->
                <div class="text-center mb-5">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-50 mb-4">
                        <i class="fas fa-trash-alt text-2xl text-red-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Hapus Device</h3>
                    <p class="text-gray-600">Apakah Anda yakin ingin menghapus ?</p>
                </div>

                <!-- Buttons -->
                <div class="flex justify-center gap-3 mt-6">
                    <button @click="show = false" 
                            type="button"
                            class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 font-medium text-sm">
                        Batal
                    </button>
                    
                    <a href="{{ route('device.delete', ['id' => $deviceId]) }}"
                       class="px-6 py-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200 font-medium text-sm">
                        Ya, Hapus
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> 