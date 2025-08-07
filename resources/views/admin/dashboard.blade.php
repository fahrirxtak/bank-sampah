<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                @section('title', 'Dashboard')
            </h2>
            <div class="flex items-center space-x-4">
                <div class="text-gray-600 text-sm bg-gray-50 px-3 py-1 rounded-full border border-gray-200">
                    <i class="fas fa-calendar-alt mr-2 text-green-600"></i>
                    <span id="currentDate"></span>
                </div>
                <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center hover:bg-indigo-200 transition-colors cursor-pointer relative">
                    <i class="fas fa-bell text-indigo-600 text-sm"></i>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                </div>
            </div>
        </div>
    </x-slot>

    @push('styles')
    <style>
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        .pulse-dot {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
    </style>
    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-8">
                <!-- Enhanced Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 fade-in-up">
                    <!-- Total Sampah Terkumpul -->
                    <div class="relative overflow-hidden rounded-xl shadow-lg p-6 text-white bg-gradient-to-br from-green-500 via-green-600 to-green-700 card-hover">
                        <div class="absolute right-0 top-0 w-32 h-32 bg-white/20 rounded-full -translate-y-1/3 translate-x-1/3"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent to-white/5"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold">Total Sampah Terkumpul</h3>
                                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-trash-alt text-xl"></i>
                                </div>
                            </div>
                            <p class="text-3xl font-bold mb-2">2,450 Kg</p>
                            <div class="flex items-center text-green-100 text-sm">
                                <i class="fas fa-arrow-up mr-1"></i>
                                <span>+18% minggu ini</span>
                            </div>
                        </div>
                    </div>

                    <!-- Nasabah Aktif -->
                    <div class="relative overflow-hidden rounded-xl shadow-lg p-6 text-white bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 card-hover">
                        <div class="absolute right-6 bottom-0 w-24 h-24 bg-white/10 rounded-full translate-y-1/3"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent to-white/5"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold">Nasabah Aktif</h3>
                                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-users text-xl"></i>
                                </div>
                            </div>
                            <p class="text-3xl font-bold mb-2">1,248</p>
                            <div class="flex items-center text-blue-100 text-sm">
                                <i class="fas fa-arrow-up mr-1"></i>
                                <span>+12% bulan ini</span>
                            </div>
                        </div>
                    </div>

                    <!-- Pendapatan -->
                    <div class="relative overflow-hidden rounded-xl shadow-lg p-6 text-white bg-gradient-to-br from-purple-600 via-purple-700 to-purple-800 card-hover">
                        <div class="absolute right-0 top-0 w-32 h-32 bg-white/20 rounded-full -translate-y-1/3 translate-x-1/3"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent to-white/5"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold">Total Pendapatan</h3>
                                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-coins text-xl"></i>
                                </div>
                            </div>
                            <p class="text-3xl font-bold mb-2">Rp15.7 Jt</p>
                            <div class="flex items-center text-purple-100 text-sm">
                                <i class="fas fa-arrow-up mr-1"></i>
                                <span>+25% dari target</span>
                            </div>
                        </div>
                    </div>

                    <!-- CO2 Teramat -->
                    <div class="relative overflow-hidden rounded-xl shadow-lg p-6 text-white bg-gradient-to-br from-teal-600 via-teal-700 to-cyan-800 card-hover">
                        <div class="absolute right-0 top-0 w-32 h-32 bg-white/20 rounded-full -translate-y-1/3 translate-x-1/3"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent to-white/5"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold">CO₂ Teramat</h3>
                                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-leaf text-xl"></i>
                                </div>
                            </div>
                            <p class="text-3xl font-bold mb-2">5.8 Ton</p>
                            <div class="flex items-center text-teal-100 text-sm">
                                <i class="fas fa-arrow-up mr-1"></i>
                                <span>+30% bulan ini</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 fade-in-up">
                    <!-- Statistik Sampah -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-800">Statistik Sampah Bulanan</h3>
                            <div class="flex items-center space-x-2">
                                <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full">Tahun 2023</span>
                                <button class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                        <div class="h-80">
                            <canvas id="wasteChart"></canvas>
                        </div>
                    </div>

                    <!-- Jenis Sampah -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-800">Komposisi Jenis Sampah</h3>
                            <div class="text-sm text-green-600 bg-green-50 px-3 py-1 rounded-full border border-green-200">
                                <i class="fas fa-filter mr-1"></i> Bulan Ini
                            </div>
                        </div>
                        <div class="h-80 flex items-center justify-center">
                            <canvas id="wasteTypeChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Bottom Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 fade-in-up">
    <!-- Sumber Sampah -->
    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Sumber Sampah</h3>
            <i class="fas fa-map-marker-alt text-green-500 text-lg"></i>
        </div>
        <div class="space-y-4">
            <!-- Item -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="w-3 h-3 bg-green-600 rounded-full mr-3"></span>
                    <span class="text-sm text-gray-600">Rumah Tangga</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-sm font-semibold">52.8%</span>
                    <div class="w-20 h-2 bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full bg-green-600" style="width: 52.8%"></div>
                    </div>
                </div>
            </div>
            <!-- Item -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="w-3 h-3 bg-blue-600 rounded-full mr-3"></span>
                    <span class="text-sm text-gray-600">Perkantoran</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-sm font-semibold">28.4%</span>
                    <div class="w-20 h-2 bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-600" style="width: 28.4%"></div>
                    </div>
                </div>
            </div>
            <!-- Item -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></span>
                    <span class="text-sm text-gray-600">Sekolah</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-sm font-semibold">12.6%</span>
                    <div class="w-20 h-2 bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full bg-yellow-500" style="width: 12.6%"></div>
                    </div>
                </div>
            </div>
            <!-- Item -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="w-3 h-3 bg-purple-600 rounded-full mr-3"></span>
                    <span class="text-sm text-gray-600">Komersial</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-sm font-semibold">6.2%</span>
                    <div class="w-20 h-2 bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full bg-purple-600" style="width: 6.2%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Nasabah -->
    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Top Nasabah</h3>
            <button class="text-sm text-green-600 hover:text-green-800 font-medium transition-colors">
                Lihat Semua
            </button>
        </div>
        <div class="space-y-4">
            <!-- Repeatable Item -->
            <div class="flex items-center space-x-3 p-2 hover:bg-green-50 rounded-lg transition-colors">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-semibold">1</div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 truncate">Ibu Siti Rahayu</p>
                    <p class="text-xs text-gray-500">120kg sampah</p>
                </div>
                <span class="text-sm font-semibold text-green-600">Rp1.2jt</span>
            </div>

            <div class="flex items-center space-x-3 p-2 hover:bg-green-50 rounded-lg transition-colors">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-semibold">2</div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 truncate">Bapak Joko Susilo</p>
                    <p class="text-xs text-gray-500">98kg sampah</p>
                </div>
                <span class="text-sm font-semibold text-blue-600">Rp980rb</span>
            </div>

            <div class="flex items-center space-x-3 p-2 hover:bg-green-50 rounded-lg transition-colors">
                <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center text-yellow-600 font-semibold">3</div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 truncate">Ibu Maya Indah</p>
                    <p class="text-xs text-gray-500">85kg sampah</p>
                </div>
                <span class="text-sm font-semibold text-yellow-600">Rp850rb</span>
            </div>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Aktivitas Terbaru</h3>
            <button class="text-sm text-green-600 hover:text-green-800 font-medium transition-colors">
                Lihat Semua
            </button>
        </div>
        <div class="space-y-4">
            <div class="flex items-start space-x-3 p-3 hover:bg-green-50 rounded-lg transition-colors cursor-pointer">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                    <i class="fas fa-recycle text-green-600 text-sm"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800">Setoran sampah dari Ibu Sari</p>
                    <p class="text-xs text-gray-500">Plastik: 5kg, Kertas: 3kg - Total: Rp45,000</p>
                    <p class="text-xs text-gray-400 mt-1">2 menit yang lalu</p>
                </div>
                <div class="text-xs text-green-600 font-semibold">+Rp45k</div>
            </div>

            <div class="flex items-start space-x-3 p-3 hover:bg-blue-50 rounded-lg transition-colors cursor-pointer">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                    <i class="fas fa-user-plus text-blue-600 text-sm"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800">Nasabah baru terdaftar</p>
                    <p class="text-xs text-gray-500">Bapak Joko Susilo - RT 05 RW 03</p>
                    <p class="text-xs text-gray-400 mt-1">5 menit yang lalu</p>
                </div>
                <div class="text-xs text-blue-600 font-semibold">Baru</div>
            </div>
        </div>
    </div>
</div>

            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set current date
            const currentDateElement = document.getElementById('currentDate');
            if (currentDateElement) {
                currentDateElement.textContent = new Date().toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
            }

            // Waste Chart
            const wasteCanvas = document.getElementById('wasteChart');
            if (wasteCanvas) {
                const wasteCtx = wasteCanvas.getContext('2d');
                new Chart(wasteCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
                        datasets: [{
                            label: 'Sampah Terkumpul',
                            data: [450, 620, 580, 720, 680, 850, 920, 1050, 980, 1120, 1250, 1450],
                            backgroundColor: '#10B981',
                            borderRadius: 6,
                            borderSkipped: false
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.9)',
                                titleColor: '#ffffff',
                                bodyColor: '#ffffff',
                                borderColor: '#10B981',
                                borderWidth: 1,
                                callbacks: {
                                    label: function(context) {
                                        return context.parsed.y + ' kg';
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: '#6B7280'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                ticks: {
                                    color: '#6B7280',
                                    callback: function(value) {
                                        return value + ' kg';
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Waste Type Chart (Doughnut)
            const wasteTypeCanvas = document.getElementById('wasteTypeChart');
            if (wasteTypeCanvas) {
                const wasteTypeCtx = wasteTypeCanvas.getContext('2d');
                new Chart(wasteTypeCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Plastik', 'Kertas', 'Logam', 'Organik', 'Kaca', 'Lainnya'],
                        datasets: [{
                            data: [35, 25, 15, 12, 8, 5],
                            backgroundColor: [
                                '#3B82F6',
                                '#10B981',
                                '#F59E0B',
                                '#EF4444',
                                '#8B5CF6',
                                '#6B7280'
                            ],
                            borderWidth: 0,
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'right',
                                labels: {
                                    usePointStyle: true,
                                    padding: 20,
                                    font: {
                                        size: 12
                                    },
                                    color: '#374151'
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.9)',
                                titleColor: '#ffffff',
                                bodyColor: '#ffffff',
                                callbacks: {
                                    label: function(context) {
                                        return context.label + ': ' + context.parsed + '%';
                                    }
                                }
                            }
                        },
                        cutout: '70%'
                    }
                });
            }

            // Add animation to cards on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all fade-in-up elements
            document.querySelectorAll('.fade-in-up').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'all 0.6s ease-out';
                observer.observe(el);
            });
        });
    </script>
    @endpush
</x-app-layout>
