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
                <div
                    class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center hover:bg-indigo-200 transition-colors cursor-pointer relative">
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

            .pulse-dot {
                animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }

            @keyframes pulse {

                0%,
                100% {
                    opacity: 1;
                }

                50% {
                    opacity: 0.5;
                }
            }
        </style>
    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-8">
                <!-- Enhanced Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 fade-in-up">

                    <!-- Total Sampah Terkumpul -->
                    <div
                        class="relative overflow-hidden rounded-xl shadow-lg p-6 text-white bg-gradient-to-br from-green-500 via-green-600 to-green-700 card-hover">
                        <div
                            class="absolute right-0 top-0 w-32 h-32 bg-white/20 rounded-full -translate-y-1/3 translate-x-1/3">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent to-white/5"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold">Total Sampah Terkumpul</h3>
                                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-trash-alt text-xl"></i>
                                </div>
                            </div>
                            <p class="text-3xl font-bold mb-2">{{ number_format($totalSampah, 2, ',', '.') }} Kg</p>
                            <div class="flex items-center text-green-100 text-sm">
                                <i class="fas fa-arrow-up mr-1"></i>
                                <span>+18% minggu ini</span>
                            </div>
                        </div>
                    </div>

                    <!-- Nasabah Aktif -->
                    <div
                        class="relative overflow-hidden rounded-xl shadow-lg p-6 text-white bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 card-hover">
                        <div class="absolute right-6 bottom-0 w-24 h-24 bg-white/10 rounded-full translate-y-1/3"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent to-white/5"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold">Nasabah Aktif</h3>
                                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-users text-xl"></i>
                                </div>
                            </div>
                            <p class="text-3xl font-bold mb-2">{{ $nasabahAktif }}</p>
                            <div class="flex items-center text-blue-100 text-sm">
                                <i class="fas fa-arrow-up mr-1"></i>
                                <span>+12% bulan ini</span>
                            </div>
                        </div>
                    </div>

                    <!-- Pendapatan -->
                    <div
                        class="relative overflow-hidden rounded-xl shadow-lg p-6 text-white bg-gradient-to-br from-purple-600 via-purple-700 to-purple-800 card-hover">
                        <div
                            class="absolute right-0 top-0 w-32 h-32 bg-white/20 rounded-full -translate-y-1/3 translate-x-1/3">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent to-white/5"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold">Total Pendapatan</h3>
                                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-coins text-xl"></i>
                                </div>
                            </div>
                            {{-- <p class="text-3xl font-bold mb-2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p> --}}
                            <div class="flex items-center text-purple-100 text-sm">
                                <i class="fas fa-arrow-up mr-1"></i>
                                <span>+25% dari target</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 fade-in-up">
                    <!-- Statistik Sampah Bulanan -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-800">Statistik Sampah Bulanan</h3>
                            <div class="flex items-center space-x-2">
                                <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full">Tahun
                                    {{ date('Y') }}</span>
                                <button class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                        <div class="h-80">
                            <canvas id="wasteChart"></canvas>
                        </div>
                    </div>

                    <!-- Komposisi Jenis Sampah -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-800">Komposisi Jenis Sampah</h3>
                            <div
                                class="text-sm text-green-600 bg-green-50 px-3 py-1 rounded-full border border-green-200">
                                <i class="fas fa-filter mr-1"></i> Bulan Ini
                            </div>
                        </div>
                        <div class="h-80 flex items-center justify-center">
                            <canvas id="wasteTypeChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Bottom Section -->
                <div class="grid grid-cols-1 gap-6 fade-in-up">
                    <!-- Top Nasabah -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-800">Top Nasabah</h3>
                            <a href="{{ route('admin.nasabah.index') }}"
                                class="text-sm text-green-600 hover:text-green-800 font-medium transition-colors">
                                Lihat Semua
                            </a>
                        </div>
                        <div class="space-y-4">
                            @forelse ($topNasabah as $index => $nasabah)
                                <div
                                    class="flex items-center space-x-3 p-2 hover:bg-green-50 rounded-lg transition-colors">
                                    <div
                                        class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-semibold">
                                        {{ $index + 1 }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-800 truncate">{{ $nasabah->user->name }}
                                        </p>
                                        <p class="text-xs text-gray-500">{{ $nasabah->total_berat }} kg sampah</p>
                                    </div>
                                    <span class="text-sm font-semibold text-green-600">
                                        Rp{{ number_format($nasabah->total_uang, 0, ',', '.') }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">Belum ada data nasabah.</p>
                            @endforelse
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
                // Tampilkan tanggal sekarang
                const currentDateElement = document.getElementById('currentDate');
                if (currentDateElement) {
                    currentDateElement.textContent = new Date().toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                }

                // Waste Chart (Bar)
                const wasteCanvas = document.getElementById('wasteChart');
                if (wasteCanvas) {
                    const wasteCtx = wasteCanvas.getContext('2d');

                    const labels = @json($labelsBulanan);
                    const data = @json($dataBulanan);

                    new Chart(wasteCtx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Sampah Terkumpul',
                                data: data,
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

                    const jenisLabels = @json($jenisLabels);
                    const jenisData = @json($jenisData);

                    new Chart(wasteTypeCtx, {
                        type: 'doughnut',
                        data: {
                            labels: jenisLabels,
                            datasets: [{
                                data: jenisData,
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
                                            return context.label + ': ' + context.parsed + ' kg';
                                        }
                                    }
                                }
                            },
                            cutout: '70%'
                        }
                    });
                }

                // Animasi scroll
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
