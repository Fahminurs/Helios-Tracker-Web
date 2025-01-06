@props(['title', 'message', 'confirmText' => 'Konfirmasi', 'cancelText' => 'Batal', 'confirmRoute' => '', 'method' => 'POST', 'icon' => 'fa-sign-out-alt', 'iconBgColor' => 'bg-red-50', 'iconColor' => 'text-red-500'])

<div x-data="{ show: false }" 
     x-show="show" 
     x-on:open-confirm-modal.window="show = true"
     x-on:close-confirm-modal.window="show = false"
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
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full {{ $iconBgColor }} mb-4">
                        <i class="fas {{ $icon }} text-2xl {{ $iconColor }}"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $title }}</h3>
                    <p class="text-gray-600">{{ $message }}</p>
                </div>

                <!-- Buttons -->
                <div class="flex justify-center gap-3 mt-6">
                    <button @click="show = false" 
                            type="button"
                            class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 font-medium text-sm">
                        {{ $cancelText }}
                    </button>
                    
                    <form action="{{ $confirmRoute }}" method="{{ $method }}" class="m-0">
                        @csrf
                        <button type="submit" 
                                class="px-6 py-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200 font-medium text-sm">
                            {{ $confirmText }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 