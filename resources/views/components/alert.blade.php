@props(['type', 'message'])

<div id="alert-short" class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 flex items-center p-4 mb-4 rounded-lg shadow-lg animate-slide-down {{ $type === 'success' ? 'bg-gradient-to-r from-green-500 to-green-600' : ($type === 'danger' ? 'bg-gradient-to-r from-red-500 to-red-600' : 'bg-gradient-to-r from-blue-500 to-blue-600') }}" role="alert" style="z-index: 9999;">
    {{-- Icon berdasarkan tipe alert --}}
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-lg {{ $type === 'success' ? 'bg-green-200 text-green-600' : ($type === 'danger' ? 'bg-red-200 text-red-600' : 'bg-blue-200 text-blue-600') }}">
        @if($type === 'success')
            <svg class="w-5 h-5 sm:w-6 sm:h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        @elseif($type === 'danger')
            <svg class="w-5 h-5 sm:w-6 sm:h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        @else
            <svg class="w-5 h-5 sm:w-6 sm:h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
            </svg>
        @endif
    </div>

    {{-- Message --}}
    <div class="ml-3 sm:ml-4 text-sm sm:text-base font-medium text-white flex-grow">
        {{ $message }}
    </div>

    {{-- Close button --}}
    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white bg-opacity-10 hover:bg-opacity-20 rounded-lg focus:ring-2 focus:ring-white p-1.5 inline-flex items-center justify-center h-8 w-8 sm:h-10 sm:w-10 transition-all duration-200" data-dismiss-target="#alert-short">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3 sm:w-4 sm:h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>

<style>
    @keyframes slide-down {
        0% {
            transform: translate(-50%, -100%);
            opacity: 0;
        }
        100% {
            transform: translate(-50%, 0);
            opacity: 1;
        }
    }

    .animate-slide-down {
        animation: slide-down 0.3s ease-out forwards;
    }

    #alert-short {
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(8px);
        width: min(600px, 95%);
        padding: 1rem 1.5rem;
    }

    #alert-short:hover {
        transform: translate(-50%, 0) scale(1.02);
        transition: transform 0.2s ease;
    }

    /* Tablet */
    @media (max-width: 1024px) {
        #alert-short {
            width: min(500px, 90%);
            padding: 0.875rem 1.25rem;
        }
    }

    /* Mobile */
    @media (max-width: 640px) {
        #alert-short {
            width: min(400px, 85%);
            padding: 0.75rem 1rem;
            top: 1rem;
        }
    }

    /* Small Mobile */
    @media (max-width: 380px) {
        #alert-short {
            width: 90%;
            padding: 0.625rem 0.875rem;
        }
    }
</style>

<script>
    // Auto hide alert after 3 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.getElementById('alert-short');
        if (alert) {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transform = 'translate(-50%, -100%)';
                alert.style.transition = 'all 0.3s ease-out';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 300);
            }, 3000);
        }
    });

    // Close button functionality with animation
    document.querySelectorAll('[data-dismiss-target="#alert-short"]').forEach(button => {
        button.addEventListener('click', () => {
            const alert = document.getElementById('alert-short');
            if (alert) {
                alert.style.opacity = '0';
                alert.style.transform = 'translate(-50%, -100%)';
                alert.style.transition = 'all 0.3s ease-out';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 300);
            }
        });
    });
</script>

