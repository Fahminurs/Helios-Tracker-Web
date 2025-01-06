<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History - Helios Tracker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
        /* Default styles for mobile */
        .container {
            padding-left: -50px;
            padding-right: -50px;
            padding-top: 50px;
            padding-bottom: 100px;
        }

        /* Tablet styles */
        @media (min-width: 768px) {
            .container {
                padding-left: 40px;
                padding-right: 40px;
                padding-top: 100px;
                padding-bottom: 100px;
            }
        }

        /* Desktop styles */
        @media (min-width: 1024px) {
            .container {
                padding-left: 200px;
                padding-right: 100px;
                padding-top: 20px;
                padding-bottom: 40px;
            }
        }

        /* Adjust card layout for different screens */
        @media (max-width: 512px) {
            .grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            #deviceCardsContainer {
                margin-bottom: 80px;
            }
        }

        @media (min-width: 641px) and (max-width: 1023px) {
            .grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }
        }
        
        /* Responsive grid untuk tab */
        @media (max-width: 640px) {
            #default-tab {
                @apply grid-cols-5 text-xs;
            }
            
            #default-tab button {
                @apply px-2 py-3;
            }
        }

        /* Active state styling */
        [aria-selected="true"] {
            @apply text-[#7847EB] border-[#7847EB] font-semibold;
        }

        /* Hover effect */
        .hover-tab-effect {
            @apply transition-all duration-200;
        }

        /* Prevent text wrapping */
        .whitespace-nowrap {
            white-space: nowrap;
        }

        /* Style for dropdown */
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236B7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }

        /* Active state for dropdown */
        select:focus {
            border-color: #7847EB;
            box-shadow: 0 0 0 2px rgba(120, 71, 235, 0.2);
        }

        /* Active tab icon animation */
        [aria-selected="true"] i {
            @apply text-[#7847EB] scale-110;
        }

        /* Hover animation */
        .group:hover i {
            @apply text-[#7847EB];
        }
    </style>
</head>
<body>  
    <!-- Include Navigation -->  
    <x-navigationbardesktop/>  
    <x-navigationbarmobile/>  

    <div class="container overflow-y-auto pb-24">  
        <!-- Header Section dengan Dropdown untuk Mobile/Tablet -->  
        <div class="max-w-7xl mx-auto">  
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 md:mb-8 lg:ml-0 ml-4">History Tracking</h1>  

            <!-- Dropdown untuk Mobile/Tablet & Tabs untuk Desktop -->  
            <div class="mb-4">  
                <!-- Dropdown untuk Mobile/Tablet -->  
                <div class="md:hidden mb-6 m-5">  
                    <div class="relative">  
                        <!-- Custom Dropdown Button -->  
                        <button id="dropdown-button"   
                                class="w-full bg-white p-4 rounded-xl shadow-md flex items-center justify-between  
                                       border border-gray-100 hover:border-[#7847EB]/30 transition-all duration-300  
                                       focus:outline-none focus:ring-2 focus:ring-[#7847EB]/20">  
                            <div class="flex items-center gap-3">  
                                <div class="w-8 h-8 rounded-lg bg-[#7847EB]/10 flex items-center justify-center">  
                                    <i id="dropdown-icon" class="fas fa-clock text-[#7847EB]"></i>  
                                </div>  
                                <div class="text-left">  
                                    <span id="selected-text" class="block text-gray-900 font-medium">Monitoring</span>  
                                    <span class="text-xs text-gray-500">Pilih periode waktu</span>  
                                </div>  
                            </div>  
                            <i class="fas fa-chevron-down text-gray-400 transition-transform duration-300" id="dropdown-arrow"></i>  
                        </button>  

                        <!-- Dropdown Menu -->  
                        <div id="dropdown-menu"   
                             class="absolute z-10 w-full mt-2 hidden opacity-0 transform scale-95 transition-all duration-300">  
                            <div class="bg-white rounded-xl shadow-lg border border-gray-100 py-2 overflow-hidden">  
                                <div class="space-y-1">  
                                    <!-- Monitoring Option -->  
                                    <button onclick="selectOption('waktunyata', 'Monitoring', 'fa-clock')"   
                                            class="w-full px-4 py-3 flex items-center gap-3 hover:bg-[#7847EB]/5 transition-colors group">  
                                        <div class="w-8 h-8 rounded-lg bg-[#7847EB]/10 flex items-center justify-center group-hover:bg-[#7847EB] group-hover:rotate-12 transition-all duration-300">  
                                            <i class="fas fa-clock text-[#7847EB] group-hover:text-white"></i>  
                                        </div>  
                                        <div class="flex flex-col items-start">  
                                            <span class="font-medium">Monitoring</span>  
                                            <span class="text-xs text-gray-500">Pantau secara real-time</span>  
                                        </div>  
                                    </button>  

                                    <!-- Daily Option -->  
                                    <button onclick="selectOption('daily', 'Harian', 'fa-calendar-day')"   
                                            class="w-full px-4 py-3 flex items-center gap-3 hover:bg-[#7847EB]/5 transition-colors group">  
                                        <div class="w-8 h-8 rounded-lg bg-[#7847EB]/10 flex items-center justify-center group-hover:bg-[#7847EB] group-hover:rotate-12 transition-all duration-300">  
                                            <i class="fas fa-calendar-day text-[#7847EB] group-hover:text-white"></i>  
                                        </div>  
                                        <div class="flex flex-col items-start">  
                                            <span class="font-medium">Harian</span>  
                                            <span class="text-xs text-gray-500">Lihat data per hari</span>  
                                        </div>  
                                    </button>  

                                    <!-- Weekly Option -->  
                                    <button onclick="selectOption('weekly', 'Mingguan', 'fa-calendar-week')"   
                                            class="w-full px-4 py-3 flex items-center gap-3 hover:bg-[#7847EB]/5 transition-colors group">  
                                        <div class="w-8 h-8 rounded-lg bg-[#7847EB]/10 flex items-center justify-center group-hover:bg-[#7847EB] group-hover:rotate-12 transition-all duration-300">  
                                            <i class="fas fa-calendar-week text-[#7847EB] group-hover:text-white"></i>  
                                        </div>  
                                        <div class="flex flex-col items-start">  
                                            <span class="font-medium">Mingguan</span>  
                                            <span class="text-xs text-gray-500">Analisis per minggu</span>  
                                        </div>  
                                    </button>  

                                    <!-- Monthly Option -->  
                                    <button onclick="selectOption('monthly', 'Bulanan', 'fa-calendar-alt')"   
                                            class="w-full px-4 py-3 flex items-center gap-3 hover:bg-[#7847EB]/5 transition-colors group">  
                                        <div class="w-8 h-8 rounded-lg bg-[#7847EB]/10 flex items-center justify-center group-hover:bg-[#7847EB] group-hover:rotate-12 transition-all duration-300">  
                                            <i class="fas fa-calendar-alt text-[#7847EB] group-hover:text-white"></i>  
                                        </div>  
                                        <div class="flex flex-col items-start">  
                                            <span class="font-medium">Bulanan</span>  
                                            <span class="text-xs text-gray-500">Ringkasan bulanan</span>  
                                        </div>  
                                    </button>  

                                    <!-- Yearly Option -->  
                                    <button onclick="selectOption('yearly', 'Tahunan', 'fa-calendar')"   
                                            class="w-full px-4 py-3 flex items-center gap-3 hover:bg-[#7847EB]/5 transition-colors group">  
                                        <div class="w-8 h-8 rounded-lg bg-[#7847EB]/10 flex items-center justify-center group-hover:bg-[#7847EB] group-hover:rotate-12 transition-all duration-300">  
                                            <i class="fas fa-calendar text-[#7847EB] group-hover:text-white"></i>  
                                        </div>  
                                        <div class="flex flex-col items-start">  
                                            <span class="font-medium">Tahunan</span>  
                                            <span class="text-xs text-gray-500">Laporan tahunan</span>  
                                        </div>  
                                    </button>  
                                </div>  
                            </div>  
                        </div>  
                    </div>  
                </div>  

                <!-- Tabs (Tampil di Desktop) -->  
                <div class="hidden md:block border-b border-gray-200 mt-10">  
                    <ul class="grid grid-cols-5 -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">  
                        <li role="presentation">  
                            <button class="w-full p-4 border-b-2 rounded-t-lg hover:text-[#7847EB] hover:border-[#7847EB] whitespace-nowrap group"   
                                    id="waktunyata-tab"   
                                    data-tabs-target="#waktunyata"   
                                    type="button"   
                                    role="tab"   
                                    aria-controls="waktunyata"   
                                    aria-selected="true"   
                                    onclick="changeTab('waktunyata')">  
                                <div class="flex items-center justify-center gap-2">  
                                    <i class="fas fa-clock text-lg group-hover:scale-110 transition-transform"></i>  
                                    <span>Monitoring</span>  
                                </div>  
                            </button>  
                        </li>  
                        <li role="presentation">  
                            <button class="w-full p-4 border-b-2 rounded-t-lg hover:text-[#7847EB] hover:border-[#7847EB] whitespace-nowrap group"   
                                    id="daily-tab"   
                                    data-tabs-target="#daily"   
                                    type="button"   
                                    role="tab"   
                                    aria-controls="daily"   
                                    aria-selected="false"   
                                    onclick="changeTab('daily')">  
                                <div class="flex items-center justify-center gap-2">  
                                    <i class="fas fa-calendar-day text-lg group-hover:scale-110 transition-transform"></i>  
                                    <span>Harian</span>  
                                </div>  
                            </button>  
                        </li>  
                        <li role="presentation">  
                            <button class="w-full p-4 border-b-2 rounded-t-lg hover:text-[#7847EB] hover:border-[#7847EB] whitespace-nowrap group"   
                                    id="weekly-tab"   
                                    data-tabs-target="#weekly"   
                                    type="button"   
                                    role="tab"   
                                    aria-controls="weekly"   
                                    aria-selected="false"   
                                    onclick="changeTab('weekly')">  
                                <div class="flex items-center justify-center gap-2">  
                                    <i class="fas fa-calendar-week text-lg group-hover:scale-110 transition-transform"></i>  
                                    <span>Mingguan</span>  
                                </div>  
                            </button>  
                        </li>  
                        <li role="presentation">  
                            <button class="w-full p-4 border-b-2 rounded-t-lg hover:text-[#7847EB] hover:border-[#7847EB] whitespace-nowrap group"   
                                    id="monthly-tab"   
                                    data-tabs-target="#monthly"   
                                    type="button"   
                                    role="tab"   
                                    aria-controls="monthly"   
                                    aria-selected="false"   
                                    onclick="changeTab('monthly')">  
                                <div class="flex items-center justify-center gap-2">  
                                    <i class="fas fa-calendar-alt text-lg group-hover:scale-110 transition-transform"></i>  
                                    <span>Bulanan</span>  
                                </div>  
                            </button>  
                        </li>  
                        <li role="presentation">  
                            <button class="w-full p-4 border-b-2 rounded-t-lg hover:text-[#7847EB] hover:border-[#7847EB] whitespace-nowrap group"   
                                    id="yearly-tab"   
                                    data-tabs-target="#yearly"   
                                    type="button"   
                                    role="tab"   
                                    aria-controls="yearly"   
                                    aria-selected="false"   
                                    onclick="changeTab('yearly')">  
                                <div class="flex items-center justify-center gap-2">  
                                    <i class="fas fa-calendar text-lg group-hover:scale-110 transition-transform"></i>  
                                    <span>Tahunan</span>  
                                </div>  
                            </button>  
                        </li>  
                    </ul>  
                </div>  
            </div>  

            <!-- Tab Content -->  
            <div id="default-tab-content">  
                <!-- Waktu Nyata Tab Content -->  
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6" id="waktunyata" role="tabpanel" aria-labelledby="waktunyata-tab">  
                    @include('histori.monitoring-waktunyata')
                </div>  

                <!-- Harian Tab Content -->  
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6 hidden" id="daily" role="tabpanel" aria-labelledby="daily-tab">  
                    @include('histori.harian')
                </div>  

                <!-- Other tabs content -->  
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6 hidden" id="weekly" role="tabpanel" aria-labelledby="weekly-tab">  
                    @include('histori.mingguan')
                </div>  
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6 hidden" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">  
                    @include('histori.bulanan')
                </div>  
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6 hidden" id="yearly" role="tabpanel" aria-labelledby="yearly-tab">  
                    @include('histori.tahunan')
                </div>  
            </div>  
        </div>  
    </div>  

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
 
    <script>
    // Card template function - Reusable across all tabs
    function generateDeviceCard(device) {  
        return `  
            <div class="bg-white rounded-xl shadow-lg border border-blue-300 p-4 hover:shadow-md transition-shadow">  
                <div class="mb-4">  
                    <h3 class="text-lg font-semibold text-gray-800">${device.name}</h3>  
                    <div class="flex flex-col gap-1">  
                        <p class="text-sm text-gray-500">Kode: ${device.code}</p>  
                        <div class="flex items-center text-gray-500">  
                            <i class="fas fa-clock text-sm mr-2"></i>  
                            <span class="text-sm">${device.time}</span>  
                        </div>  
                    </div>  
                </div>  
                <div class="grid grid-cols-3 gap-3">  
                    <div class="p-3 bg-gray-50 rounded-lg text-center">  
                        <i class="fas fa-bolt text-[#7847EB] mb-1"></i>  
                        <p class="text-xs text-gray-500">Ampere</p>  
                        <p class="font-semibold text-sm">${device.ampere}A</p>  
                    </div>  
                    <div class="p-3 bg-gray-50 rounded-lg text-center">  
                        <i class="fas fa-plug text-[#7847EB] mb-1"></i>  
                        <p class="text-xs text-gray-500">Voltage</p>  
                        <p class="font-semibold text-sm">${device.voltage}V</p>  
                    </div>  
                    <div class="p-3 bg-gray-50 rounded-lg text-center">  
                        <i class="fas fa-battery-three-quarters text-[#7847EB] mb-1"></i>  
                        <p class="text-xs text-gray-500">Battery</p>  
                        <p class="font-semibold text-sm">${device.battery}%</p>  
                    </div>  
                </div>  
            </div>  
        `;  
    }  

    // Enhanced DeviceFilter class to handle different time formats
    class DeviceFilter {
        constructor(tabId, devices) {
            console.log('Creating DeviceFilter for tab:', tabId);
            this.tabId = tabId;
            this.devices = devices;
            this.initializeElements();
            this.setupEventListeners();
            this.renderDevices(devices);
        }

        initializeElements() {
            const prefix = this.getInputPrefix();
            console.log('Using prefix:', prefix);
            console.log('Looking for elements with IDs:');
            console.log(`- Search Input: ${this.tabId}SearchInput`);
            console.log(`- Start Input: ${prefix}StartInput`);
            console.log(`- End Input: ${prefix}EndInput`);
            console.log(`- Search Button: ${prefix}SearchButton`);
            console.log(`- Search Button Container: ${prefix}SearchButtonContainer`);
            console.log(`- Cards Container: ${this.tabId}CardsContainer`);
            console.log(`- No Data Found: ${this.tabId}NoDataFound`);

            this.searchInput = document.getElementById(`${this.tabId}SearchInput`);
            this.startInput = document.getElementById(`${prefix}StartInput`);
            this.endInput = document.getElementById(`${prefix}EndInput`);
            this.searchButton = document.getElementById(`${prefix}SearchButton`);
            this.searchButtonContainer = document.getElementById(`${prefix}SearchButtonContainer`);
            this.deviceCardsContainer = document.getElementById(`${this.tabId}CardsContainer`);
            this.noDataFound = document.getElementById(`${this.tabId}NoDataFound`);

            console.log('Found elements:', {
                searchInput: this.searchInput,
                startInput: this.startInput,
                endInput: this.endInput,
                searchButton: this.searchButton,
                searchButtonContainer: this.searchButtonContainer,
                deviceCardsContainer: this.deviceCardsContainer,
                noDataFound: this.noDataFound
            });
        }

        getInputPrefix() {
            switch(this.tabId) {
                case 'waktunyata': return 'time';
                case 'daily': return 'date';
                case 'weekly': return 'week';
                case 'monthly': return 'month';
                case 'yearly': return 'year';
                default: return 'date';
            }
        }

        setupEventListeners() {
            if (this.searchInput) {
                this.searchInput.addEventListener('input', () => {
                    this.clearTimeInputs();
                    this.applyFilters();
                });
            }

            if (this.startInput) {
                this.startInput.addEventListener('change', () => {
                    this.clearSearchInput();
                    this.toggleSearchButton();
                });
            }

            if (this.endInput) {
                this.endInput.addEventListener('change', () => {
                    this.clearSearchInput();
                    this.toggleSearchButton();
                });
            }

            if (this.searchButton) {
                this.searchButton.addEventListener('click', () => this.searchByTime());
            }
        }

        clearSearchInput() {
            if (this.searchInput) {
                this.searchInput.value = '';
            }
        }

        clearTimeInputs() {
            if (this.startInput) {
                this.startInput.value = '';
            }
            if (this.endInput) {
                this.endInput.value = '';
            }
        }

        toggleSearchButton() {
            const startValue = this.startInput.value;
            const endValue = this.endInput.value;

            console.log('Toggle search button:', {
                startValue,
                endValue,
                container: this.searchButtonContainer
            });

            if (startValue || endValue) {
                this.searchButtonContainer?.classList.remove('hidden');
            } else {
                this.searchButtonContainer?.classList.add('hidden');
            }
        }

        searchByTime() {
            const startValue = this.startInput.value;
            const endValue = this.endInput.value;

            if (!startValue && !endValue) {
                alert('Silakan masukkan kriteria pencarian');
                return;
            }

            let filteredDevices;
            if (this.tabId === 'waktunyata') {
                if (startValue && endValue && this.timeToSeconds(startValue + ':00') > this.timeToSeconds(endValue + ':00')) {
                    alert('Waktu akhir tidak boleh kurang dari waktu awal');
                    return;
                }
                filteredDevices = this.filterByTime(startValue, endValue);
            } else {
                if (startValue && endValue && new Date(startValue) > new Date(endValue)) {
                    alert('Tanggal akhir tidak boleh kurang dari tanggal awal');
                    return;
                }
                filteredDevices = this.filterByDate(startValue, endValue);
            }

            this.updateDisplay(filteredDevices);
        }

        filterByTime(startTime, endTime) {
            return this.devices.filter(device => {
                const deviceTime = this.timeToSeconds(device.time);
                const start = startTime ? this.timeToSeconds(startTime + ':00') : 0;
                const end = endTime ? this.timeToSeconds(endTime + ':00') : 86400;

                return (!startTime || deviceTime >= start) &&
                       (!endTime || deviceTime <= end);
            });
        }

        filterByDate(startDate, endDate) {
            console.log('Filtering by date:', { startDate, endDate });
            return this.devices.filter(device => {
                const deviceDate = new Date(device.time);
                const start = startDate ? new Date(startDate + 'T00:00:00') : new Date('1970-01-01');
                const end = endDate ? new Date(endDate + 'T23:59:59') : new Date('9999-12-31');

                console.log('Comparing dates:', {
                    device: deviceDate,
                    start: start,
                    end: end
                });

                return (!startDate || deviceDate >= start) &&
                       (!endDate || deviceDate <= end);
            });
        }

        timeToSeconds(timeString) {
            if (!timeString) return null;
            const [hours, minutes, seconds] = timeString.split(':').map(Number);
            return hours * 3600 + minutes * 60 + (seconds || 0);
        }

        applyFilters() {
            const searchTerm = this.searchInput ? this.searchInput.value.toLowerCase().trim() : '';
            const filteredDevices = this.devices.filter(device =>
                device.code.toLowerCase().includes(searchTerm) ||
                device.name.toLowerCase().includes(searchTerm)
            );

            this.updateDisplay(filteredDevices);
        }

        updateDisplay(filteredDevices) {
            if (filteredDevices.length === 0) {
                this.deviceCardsContainer.innerHTML = '';
                this.noDataFound.classList.remove('hidden');
            } else {
                this.noDataFound.classList.add('hidden');
                this.renderDevices(filteredDevices);
            }
        }

        renderDevices(devicesToRender) {
            console.log('Rendering devices:', devicesToRender);
            if (!this.deviceCardsContainer) {
                console.error(`Cards container not found for tab ${this.tabId}`);
                return;
            }
            this.deviceCardsContainer.innerHTML = devicesToRender
                .map(device => generateDeviceCard(device))
                .join('');
            console.log('Devices rendered');
        }
    }

    // Initialize filters when tab changes
    function initializeTabFilter(tabId) {
        console.log('Initializing filter for tab:', tabId);
        
        // Sample data dengan format waktu yang sesuai untuk setiap tab
        const devices = [
            {
                name: 'Helios Tracker #1',
                code: 'HT-001',
                time: tabId === 'waktunyata' ? '14:30:25' : '2024-03-15',
                ampere: 2.5,
                voltage: 220,
                battery: 85
            },
            {
                name: 'Helios Tracker #2',
                code: 'HT-002',
                time: tabId === 'waktunyata' ? '15:45:10' : '2024-03-16',
                ampere: 2.3,
                voltage: 220,
                battery: 75
            },
            {
                name: 'Helios Tracker #3',
                code: 'HT-003',
                time: tabId === 'waktunyata' ? '16:15:30' : '2024-03-17',
                ampere: 2.1,
                voltage: 220,
                battery: 90
            }
        ];

        // Sesuaikan format waktu berdasarkan tab
        devices.forEach(device => {
            if (tabId !== 'waktunyata') {
                // Format tanggal YYYY-MM-DD untuk tab selain waktunyata
                device.time = new Date(device.time).toISOString().split('T')[0];
            }
        });

        console.log('Sample devices data:', devices);

        const filter = new DeviceFilter(tabId, devices);
        console.log('Filter initialized:', filter);
        return filter;
    }

    // Modified changeTab function
    function changeTab(tabId) {
        console.log('Changing to tab:', tabId);
        const panels = document.querySelectorAll('[role="tabpanel"]');
        panels.forEach(panel => {
            if (panel.id === tabId) {
                panel.classList.remove('hidden');
            } else {
                panel.classList.add('hidden');
            }
        });
        
        document.querySelectorAll('[role="tab"]').forEach(tab => {
            const targetId = tab.getAttribute('data-tabs-target').substring(1); // Remove the # from the target
            const isSelected = targetId === tabId;
            tab.setAttribute('aria-selected', isSelected);
            if (isSelected) {
                tab.classList.add('text-[#7847EB]', 'border-[#7847EB]');
            } else {
                tab.classList.remove('text-[#7847EB]', 'border-[#7847EB]');
            }
        });

        // Initialize the filter for the new tab
        initializeTabFilter(tabId);
    }

    // Initialize the default tab on page load
    document.addEventListener('DOMContentLoaded', () => {
        initializeTabFilter('waktunyata');
    });

    function clearSearch() {
        const activeTab = document.querySelector('[role="tabpanel"]:not(.hidden)').id;
        const prefix = activeTab === 'waktunyata' ? 'time' : 'date';
        
        // Reset input pencarian
        document.getElementById(`${activeTab}SearchInput`).value = '';
        document.getElementById(`${prefix}StartInput`).value = '';
        document.getElementById(`${prefix}EndInput`).value = '';
        
        // Render ulang semua perangkat
        initializeTabFilter(activeTab);
    }
    </script>

</body>
</html>