<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get device info from localStorage
    const deviceCode = localStorage.getItem('selectedDeviceCode');
    const deviceName = localStorage.getItem('selectedDeviceName');

    // Get server values
    const serverDeviceCode = '{{ $selectedDeviceCode }}';
    const serverDeviceName = '{{ $deviceName }}';

    // If no device code in localStorage or it's invalid, use the one from server
    if (!deviceCode || deviceCode === 'null' || deviceCode === 'undefined') {
        localStorage.setItem('selectedDeviceCode', serverDeviceCode);
        localStorage.setItem('selectedDeviceName', serverDeviceName);
    }

    // Add headers to all future fetch requests
    const originalFetch = window.fetch;
    window.fetch = function() {
        let [resource, config] = arguments;
        if (!config) {
            config = {};
        }
        if (!config.headers) {
            config.headers = {};
        }
        config.headers['X-Selected-Device-Code'] = localStorage.getItem('selectedDeviceCode') || 'Belum Ada Alat';
        return originalFetch(resource, config);
    };

    // Add headers to all future XHR requests
    const originalXHR = window.XMLHttpRequest;
    function newXHR() {
        const xhr = new originalXHR();
        const originalOpen = xhr.open;
        xhr.open = function() {
            const result = originalOpen.apply(this, arguments);
            this.setRequestHeader('X-Selected-Device-Code', localStorage.getItem('selectedDeviceCode') || 'Belum Ada Alat');
            return result;
        };
        return xhr;
    }
    window.XMLHttpRequest = newXHR;

    // Update device info in the view if elements exist
    const deviceNameElement = document.getElementById('device-name');
    const deviceCodeElement = document.getElementById('device-code');
    
    if (deviceNameElement) {
        deviceNameElement.textContent = localStorage.getItem('selectedDeviceName') || serverDeviceName;
    }
    if (deviceCodeElement) {
        deviceCodeElement.textContent = localStorage.getItem('selectedDeviceCode') || serverDeviceCode;
    }
});
</script>

@livewire('dashboard.main-dashboard')
{{-- Karena menggunakan livewire jadi file terpisah dengan dan sekarang kode ada di livewire main-dashboard --}}
