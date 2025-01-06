@props(['type', 'message', 'details'])

<div id="alert-detail" class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-xs p-4 rounded-lg {{ $type === 'success' ? 'bg-green-500' : ($type === 'danger' ? 'bg-red-500' : 'bg-blue-500') }}" role="alert">
    <div class="flex items-center mb-3">
        <span class="text-lg font-semibold text-white">{{ $message }}</span>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 text-white rounded-lg p-1.5 hover:bg-gray-200 hover:text-gray-900 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-detail">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
    @if(is_array($details))
        <div class="text-sm text-white">
            <ul class="list-disc list-inside">
                @foreach($details as $detail)
                    <li>{{ is_array($detail) ? implode(', ', $detail) : $detail }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<script>
    // Auto hide alert after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.getElementById('alert-detail');
        if (alert) {
            setTimeout(() => {
                alert.style.display = 'none';
            }, 5000);
        }
    });

    // Close button functionality
    document.querySelectorAll('[data-dismiss-target="#alert-detail"]').forEach(button => {
        button.addEventListener('click', () => {
            const alert = document.getElementById('alert-detail');
            if (alert) {
                alert.style.display = 'none';
            }
        });
    });
</script>