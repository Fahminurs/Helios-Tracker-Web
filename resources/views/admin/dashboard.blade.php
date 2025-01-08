
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
</head>
<body>
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="bg-white border-b border-gray-200">
            <!-- Navbar content -->
        </nav>

        <!-- Page Content -->
        <main>
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
            padding: 16px;
        }
        .sidebar {
            width: 250px;
            background-color: #ffffff;
            height: calc(100vh - 32px);
            position: fixed;
            padding: 20px;
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
            border-radius: 16px;
        }
        .sidebar-brand {
            display: flex;
            align-items: center;
            padding: 0 16px;
            margin-bottom: 32px;
        }
        .sidebar-brand svg {
            width: 32px;
            height: 32px;
            margin-right: 12px;
            color: #5e72e4;
            filter: drop-shadow(0 4px 6px rgba(94, 114, 228, 0.3));
        }
        .sidebar-brand span {
            font-size: 18px;
            font-weight: 700;
            color: #344767;
            letter-spacing: -0.025em;
        }
        .nav-item {
            margin: 8px 0;
        }
        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: #67748e;
            font-size: 14px;
            font-weight: 500;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .nav-link:hover {
            background-color: #f8f9fa;
            color: #5e72e4;
            transform: translateX(5px);
        }
        .nav-link.active {
            background-color: #5e72e4;
            color: white;
            font-weight: 600;
            box-shadow: 0 3px 5px rgb(94 114 228 / 30%);
        }
        .nav-link.active svg {
            color: white;
        }
        .nav-link svg {
            width: 20px;
            height: 20px;
            margin-right: 12px;
            color: #67748e;
            transition: all 0.3s ease;
        }
        .nav-link:hover svg {
            color: #5e72e4;
        }
        .dashboard-card {
            background-color: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
            margin-bottom: 24px;
            transition: all 0.3s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 10%);
        }
        .card-title {
            color: #67748e;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
        .stat-value {
            color: #344767;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 4px;
            letter-spacing: -0.025em;
        }
        .main-content {
            background-color: #ffffff;
            min-height: calc(100vh - 32px);
            padding: 24px;
            margin-left: 280px;
            border-radius: 16px;
            width: calc(100% - 280px);
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 24px;
        }
        .stat-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .stat-icon.purple {
            background: rgba(94, 114, 228, 0.1);
            color: #5e72e4;
        }
        .stat-icon.blue {
            background: rgba(17, 205, 239, 0.1);
            color: #11cdef;
        }
        .stat-icon svg {
            width: 24px;
            height: 24px;
        }
        .chart-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        .generate-section {
            background: linear-gradient(145deg, #5e72e4 0%, #825ee4 100%);
            border-radius: 16px;
            padding: 32px;
            color: white;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
        }

        .generate-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.4;
        }

        .generate-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .generate-description {
            font-size: 14px;
            opacity: 0.8;
            margin-bottom: 24px;
            max-width: 600px;
        }

        .generate-button {
            background: white;
            color: #5e72e4;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .generate-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .recent-devices {
            margin-top: 24px;
        }

        .device-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .device-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .device-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.05);
        }

        .device-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .device-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-active {
            background: rgba(45, 206, 137, 0.1);
            color: #2dce89;
        }

        .status-inactive {
            background: rgba(251, 99, 64, 0.1);
            color: #fb6340;
        }

        .device-info {
            margin-top: 12px;
            font-size: 13px;
            color: #67748e;
        }

        .parallax-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(145deg, rgba(94, 114, 228, 0.05) 0%, rgba(130, 94, 228, 0.05) 100%);
            z-index: -1;
            pointer-events: none;
        }
    </style>

    <div class="wrapper">
        @include('admin.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <!-- Stats Grid -->
            <div class="stats-container">
                <div class="dashboard-card">
                    <div class="stat-card">
                        <div>
                            <h3 class="card-title">TOTAL PERANGKAT</h3>
                            <div class="stat-value">{{ $totalDevices }}</div>
                        </div>
                        <div class="stat-icon purple">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z M12 12h.01M12 12h.01M12 12h.01"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="stat-card">
                        <div>
                            <h3 class="card-title">TOTAL USERS</h3>
                            <div class="stat-value">{{ $totalUsers }}</div>
                        </div>
                        <div class="stat-icon blue">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart -->
            <div class="dashboard-card">
                <div class="chart-container">
                    <h3 class="card-title">TREND PENDAFTARAN USER</h3>
                    <div class="h-96">
                        <canvas id="weeklyUserChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl p-8 mb-8 shadow-lg">
                <h2 class="text-white text-2xl font-semibold mb-3">Generate Kode Perangkat</h2>
                <p class="text-indigo-100 mb-6">
                    Generate kode unik untuk perangkat baru. Kode ini akan digunakan untuk mengidentifikasi dan menghubungkan perangkat dengan sistem.
                </p>
                <button 
                    onclick="generateCode()"
                    class="bg-white text-indigo-600 px-6 py-3 rounded-lg font-medium hover:bg-indigo-50 transition-all duration-200 shadow-md hover:shadow-lg"
                >
                    Generate Kode Baru
                </button>
            </div>

            <div class="recent-devices">
                <h3 class="card-title">PERANGKAT TERDAFTAR</h3>
                <div class="device-list">
                    @forelse($recentDevices as $device)
                        <div class="device-card">
                            <div class="device-header">
                                <h4>Device #{{ $device['code'] }}</h4>
                                <span class="device-status {{ $device['status'] === 'Active' ? 'status-active' : 'status-inactive' }}">
                                    {{ $device['status'] }}
                                </span>
                            </div>
                            <div class="device-info">
                                <p>Status: {{ $device['connection'] }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="device-card">
                            <p class="text-gray-500">Belum ada perangkat yang dibuat</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Tambahkan background parallax -->
            <div class="parallax-bg"></div>
        </div>
    </div>

</main>
</div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Definisikan fungsi generateCode di awal
        function generateCode() {
            fetch('/generate-device-code', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Kode berhasil dibuat: ' + data.data.device_code);
                    location.reload();
                } else {
                    alert('Gagal: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            });
        }

        // Data untuk chart
        window.chartData = {
            labels: {!! json_encode($chartLabels) !!},
            values: {!! json_encode($weeklyData) !!}
        };

        // Animasi counter untuk stat value
        function animateValue(element, start, end, duration) {
            let current = start;
            const range = end - start;
            const increment = end > start ? 1 : -1;
            const stepTime = Math.abs(Math.floor(duration / range));
            
            const timer = setInterval(() => {
                current += increment;
                element.textContent = current;
                if (current === end) {
                    clearInterval(timer);
                }
            }, stepTime);
        }
        
        // Jalankan animasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', () => {
            // Ambil semua elemen stat-value
            const statValues = document.querySelectorAll('.stat-value');
            
            // Animasikan setiap nilai
            statValues.forEach(statValue => {
                const finalValue = parseInt(statValue.textContent) || 0;
                statValue.textContent = '0';
                animateValue(statValue, 0, finalValue, 1000);
            });
        });

        // Script untuk mengatur active state pada menu
        const menuItems = document.querySelectorAll('.nav-link');
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                menuItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Efek parallax saat scroll
        window.addEventListener('scroll', function() {
            const parallax = document.querySelector('.parallax-bg');
            let scrollPosition = window.pageYOffset;
            parallax.style.transform = 'translateY(' + (scrollPosition * 0.5) + 'px)';
        });

        // Setup chart data
        const ctx = document.getElementById('weeklyUserChart').getContext('2d');
        const weeklyUserChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: window.chartData.labels,
                datasets: [{
                    label: 'Pendaftaran User Mingguan',
                    data: window.chartData.values,
                    backgroundColor: 'rgba(94, 114, 228, 0.2)',
                    borderColor: 'rgb(94, 114, 228)',
                    borderWidth: 2,
                    borderRadius: 5,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Trend Pendaftaran User Mingguan'
                    }
                }
            }
        });
    </script>



</body>
</html> 