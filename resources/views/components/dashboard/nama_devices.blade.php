<div class="flex items-center text-white p-2 rounded-[10px]" style="background-color: #7847eb;">
    <i class="fas fa-microchip mr-2"></i>
    <span class="text-sm lg:text-base" id="deviceNameDisplay">{{ $device->nama_device ?? 'Tidak ada perangkat' }}</span>
</div>

<script>
    // Update nama device dari localStorage saat komponen dimuat
    document.addEventListener('DOMContentLoaded', function() {
        updateDeviceNameFromStorage();
    });

    // Update nama device saat ada perubahan di localStorage
    window.addEventListener('storage', function(e) {
        if (e.key === 'selectedDeviceName') {
            updateDeviceNameFromStorage();
        }
    });

    // Fungsi untuk mengupdate tampilan nama device
    function updateDeviceNameFromStorage() {
        const deviceName = localStorage.getItem('selectedDeviceName') || 'Tidak ada perangkat';
        const deviceNameDisplay = document.getElementById('deviceNameDisplay');
        if (deviceNameDisplay) {
            deviceNameDisplay.textContent = deviceName;
        }
    }

    // Jalankan setiap kali Livewire melakukan update
    document.addEventListener('livewire:load', function() {
        Livewire.hook('message.processed', (message, component) => {
            updateDeviceNameFromStorage();
        });
    });
</script>