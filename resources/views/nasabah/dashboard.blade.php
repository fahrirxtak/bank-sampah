<x-nasabah-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Nasabah') }}
            </h2>
            <div class="flex items-center space-x-4">
                <div class="text-gray-600 text-sm bg-gray-50 px-3 py-1 rounded-full border border-gray-200">
                    <i class="fas fa-calendar-alt mr-2 text-green-600"></i>
                    <span id="currentDate"></span>
                </div>
                <div class="relative">
                    <div
                        class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center hover:bg-indigo-200 transition-colors cursor-pointer">
                        <i class="fas fa-bell text-indigo-600 text-sm"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </div>
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
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .fade-in-up {
                animation: fadeInUp 0.6s ease-out;
            }

            .saldo-card {
                background: linear-gradient(135deg, #22c55e 0%, #15803d 100%);
            }

            .setor-card {
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            }

            .tarik-card {
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            }
        </style>
    @endpush

    <div class="py-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-8">
                <!-- Stats Cards for Nasabah -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 fade-in-up">
                    <!-- Total Setoran -->
                    <div
                        class="relative overflow-hidden rounded-xl shadow-lg p-6 text-white bg-gradient-to-br from-green-500 via-green-600 to-green-700 card-hover">
                        <div
                            class="absolute right-0 top-0 w-32 h-32 bg-white/20 rounded-full -translate-y-1/3 translate-x-1/3">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent to-white/5"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold">Total Setoran Saya</h3>
                                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-trash text-xl"></i>
                                </div>
                            </div>
                            <p class="text-3xl font-bold mb-2">125 Kg</p>
                            <div class="flex items-center text-green-100 text-sm">
                                <i class="fas fa-arrow-up mr-1"></i>
                                <span>+10 Kg bulan ini</span>
                            </div>
                        </div>
                    </div>

                    <!-- Saldo Tabungan -->
                    <div
                        class="relative overflow-hidden rounded-xl shadow-lg p-6 text-white bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 card-hover">
                        <div class="absolute right-6 bottom-0 w-24 h-24 bg-white/10 rounded-full translate-y-1/3"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent to-white/5"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold">Saldo Tersedia</h3>
                                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-wallet text-xl"></i>
                                </div>
                            </div>
                            <p class="text-3xl font-bold mb-2">Rp1.250.000</p>
                            <div class="flex items-center text-blue-100 text-sm">
                                <i class="fas fa-arrow-up mr-1"></i>
                                <span>+Rp150k bulan ini</span>
                            </div>
                        </div>
                    </div>

                    <!-- Total Tarikan -->
                    <div
                        class="relative overflow-hidden rounded-xl shadow-lg p-6 text-white bg-gradient-to-br from-purple-600 via-purple-700 to-purple-800 card-hover">
                        <div
                            class="absolute right-0 top-0 w-32 h-32 bg-white/20 rounded-full -translate-y-1/3 translate-x-1/3">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent to-white/5"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold">Total Tarikan</h3>
                                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-arrow-down text-xl"></i>
                                </div>
                            </div>
                            <p class="text-3xl font-bold mb-2">Rp500.000</p>
                            <div class="flex items-center text-purple-100 text-sm">
                                <i class="fas fa-arrow-down mr-1"></i>
                                <span>2 kali bulan ini</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 fade-in-up">
                    <!-- Statistik Setoran -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-800">Statistik Setoran Saya</h3>
                            <div class="flex items-center space-x-2">
                                <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full">Tahun
                                    2023</span>
                                <button class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                        <div class="h-80">
                            <canvas id="nasabahChart"></canvas>
                        </div>
                    </div>

                    <!-- Jenis Sampah Saya -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-800">Komposisi Sampah Saya</h3>
                            <div
                                class="text-sm text-green-600 bg-green-50 px-3 py-1 rounded-full border border-green-200">
                                <i class="fas fa-filter mr-1"></i> Bulan Ini
                            </div>
                        </div>
                        <div class="h-80 flex items-center justify-center">
                            <canvas id="nasabahTypeChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Bottom Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 fade-in-up">
                    <!-- Transaksi Terakhir -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-800">Transaksi Terakhir</h3>
                            <a href=""
                                class="text-sm text-green-600 hover:text-green-800 font-medium transition-colors">
                                Lihat Semua
                            </a>
                        </div>
                        <div class="space-y-4">
                            <!-- Item -->
                            <div
                                class="flex items-start space-x-3 p-3 hover:bg-green-50 rounded-lg transition-colors cursor-pointer">
                                <div
                                    class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-recycle text-green-600 text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-800">Setoran sampah</p>
                                    <p class="text-xs text-gray-500">Plastik: 5kg, Kertas: 3kg</p>
                                    <p class="text-xs text-gray-400 mt-1">2 hari yang lalu</p>
                                </div>
                                <div class="text-sm text-green-600 font-semibold">+Rp45k</div>
                            </div>

                            <!-- Item -->
                            <div
                                class="flex items-start space-x-3 p-3 hover:bg-blue-50 rounded-lg transition-colors cursor-pointer">
                                <div
                                    class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-money-bill-wave text-blue-600 text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-800">Penarikan saldo</p>
                                    <p class="text-xs text-gray-500">Transfer ke BCA •••• 1234</p>
                                    <p class="text-xs text-gray-400 mt-1">5 hari yang lalu</p>
                                </div>
                                <div class="text-sm text-red-600 font-semibold">-Rp200k</div>
                            </div>

                            <!-- Item -->
                            <div
                                class="flex items-start space-x-3 p-3 hover:bg-yellow-50 rounded-lg transition-colors cursor-pointer">
                                <div
                                    class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-recycle text-yellow-600 text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-800">Setoran sampah</p>
                                    <p class="text-xs text-gray-500">Logam: 2kg, Kaca: 1kg</p>
                                    <p class="text-xs text-gray-400 mt-1">1 minggu yang lalu</p>
                                </div>
                                <div class="text-sm text-green-600 font-semibold">+Rp35k</div>
                            </div>
                        </div>
                    </div>

                    <!-- Harga Sampah Terkini -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-800">Harga Sampah Terkini</h3>
                            <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full">Per Kg</span>
                        </div>
                        <div class="space-y-3">
                            <!-- Item -->
                            <div
                                class="flex items-center justify-between p-2 hover:bg-green-50 rounded-lg transition-colors">
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-trash text-green-600 text-xs"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-800">Plastik</span>
                                </div>
                                <span class="text-sm font-semibold text-green-600">Rp5,000</span>
                            </div>

                            <!-- Item -->
                            <div
                                class="flex items-center justify-between p-2 hover:bg-blue-50 rounded-lg transition-colors">
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-file-alt text-blue-600 text-xs"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-800">Kertas</span>
                                </div>
                                <span class="text-sm font-semibold text-blue-600">Rp3,000</span>
                            </div>

                            <!-- Item -->
                            <div
                                class="flex items-center justify-between p-2 hover:bg-yellow-50 rounded-lg transition-colors">
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-cube text-yellow-600 text-xs"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-800">Logam</span>
                                </div>
                                <span class="text-sm font-semibold text-yellow-600">Rp10,000</span>
                            </div>

                            <!-- Item -->
                            <div
                                class="flex items-center justify-between p-2 hover:bg-red-50 rounded-lg transition-colors">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-wine-bottle text-red-600 text-xs"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-800">Kaca</span>
                                </div>
                                <span class="text-sm font-semibold text-red-600">Rp2,500</span>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <a href=""
                                class="text-sm text-green-600 hover:text-green-800 font-medium transition-colors inline-flex items-center">
                                Lihat detail harga sampah <i class="fas fa-chevron-right ml-1 text-xs"></i>
                            </a>
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

                // Nasabah Chart
                const nasabahCanvas = document.getElementById('nasabahChart');
                if (nasabahCanvas) {
                    const nasabahCtx = nasabahCanvas.getContext('2d');
                    new Chart(nasabahCtx, {
                        type: 'bar',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt',
                                'Nov', 'Des'
                            ],
                            datasets: [{
                                label: 'Setoran Sampah (kg)',
                                data: [12, 8, 15, 10, 18, 22, 25, 30, 28, 35, 40, 45],
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

                // Nasabah Type Chart (Doughnut)
                const nasabahTypeCanvas = document.getElementById('nasabahTypeChart');
                if (nasabahTypeCanvas) {
                    const nasabahTypeCtx = nasabahTypeCanvas.getContext('2d');
                    new Chart(nasabahTypeCtx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Plastik', 'Kertas', 'Logam', 'Kaca', 'Lainnya'],
                            datasets: [{
                                data: [45, 30, 15, 8, 2],
                                backgroundColor: [
                                    '#3B82F6',
                                    '#10B981',
                                    '#F59E0B',
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
                                            return context.label + ': ' + context.parsed + 'kg';
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
</x-nasabah-layout>
