<x-nasabah-layout>
    <!-- Header Section -->
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div class="flex items-center space-x-4">
                <div class="bg-gradient-to-br from-blue-500 to-indigo-600 p-4 rounded-2xl shadow-lg">
                    <i class="fas fa-exchange-alt text-white text-2xl"></i>
                </div>
                <div>
                    <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                        @section('title', 'Riwayat Transaksi')
                        Riwayat Transaksi
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">Pantau dan kelola seluruh aktivitas transaksi Anda</p>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <div
                    class="hidden sm:flex items-center text-gray-600 text-sm bg-white px-5 py-3 rounded-2xl shadow-md border border-gray-100">
                    <i class="fas fa-calendar-alt mr-3 text-blue-500"></i>
                    <span id="currentDate" class="font-medium"></span>
                </div>
                <button
                    class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-3 rounded-2xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 font-medium">
                    <i class="fas fa-print mr-2"></i>
                    Cetak
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div
                    class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-green-600 mb-1">Total Pemasukan</p>
                            <p class="text-2xl font-bold text-green-700">
                                Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                            <p class="text-xs text-green-500 mt-1">
                                @if ($perubahanPemasukan >= 0)
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    +{{ number_format(abs($perubahanPemasukan), 1) }}% dari bulan lalu
                                @else
                                    <i class="fas fa-arrow-down mr-1"></i>
                                    {{ number_format($perubahanPemasukan, 1) }}% dari bulan lalu
                                @endif
                            </p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-xl">
                            <i class="fas fa-arrow-down text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Change this card -->
                <div class="bg-gradient-to-br from-red-50 to-rose-50 rounded-2xl p-6 border border-red-100 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-red-600 mb-1">Total Pengeluaran</p>
                            <p class="text-2xl font-bold text-red-700">
                                Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                            <p class="text-xs text-red-500 mt-1">
                                @if ($perubahanPengeluaran >= 0)
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    +{{ number_format(abs($perubahanPengeluaran), 1) }}% dari bulan lalu
                                @else
                                    <i class="fas fa-arrow-down mr-1"></i>
                                    {{ number_format($perubahanPengeluaran, 1) }}% dari bulan lalu
                                @endif
                            </p>
                        </div>
                        <div class="bg-red-100 p-3 rounded-xl">
                            <i class="fas fa-shopping-cart text-red-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-600 mb-1">Saldo Akhir</p>
                            <p class="text-2xl font-bold text-blue-700">Rp{{ number_format($saldoAkhir, 0, ',', '.') }}
                            </p>
                            <p class="text-xs text-blue-500 mt-1">
                                <i class="fas fa-wallet mr-1"></i>
                                Saldo terkini
                            </p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-xl">
                            <i class="fas fa-wallet text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters and Search -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="bg-blue-100 p-2 rounded-xl">
                                <i class="fas fa-filter text-blue-600"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Filter & Pencarian</h3>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <!-- Search Bar -->
                            <form action="{{ route('nasabah.riwayat.index') }}" method="GET"
                                class="flex items-center">
                                <div class="relative">
                                    <input type="text" name="search" placeholder="Cari transaksi..."
                                        value="{{ $search }}"
                                        class="pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm w-80 bg-gray-50 focus:bg-white transition-colors">
                                    <i
                                        class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    @if ($search)
                                        <a href="{{ route('nasabah.riwayat.index') }}"
                                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </div>

                                <!-- Hidden inputs untuk mempertahankan filter lain -->
                                <input type="hidden" name="date_filter" value="{{ $dateFilter }}">
                                <input type="hidden" name="type_filter" value="{{ $typeFilter }}">
                            </form>

                            <!-- Date Filter -->
                            <form action="{{ route('nasabah.riwayat.index') }}" method="GET"
                                onchange="this.submit()">
                                <select name="date_filter"
                                    class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm bg-gray-50 focus:bg-white transition-colors">
                                    <option value="">Semua Periode</option>
                                    <option value="today" {{ $dateFilter == 'today' ? 'selected' : '' }}>Hari Ini
                                    </option>
                                    <option value="week" {{ $dateFilter == 'week' ? 'selected' : '' }}>Minggu Ini
                                    </option>
                                    <option value="month" {{ $dateFilter == 'month' ? 'selected' : '' }}>Bulan Ini
                                    </option>
                                    <option value="year" {{ $dateFilter == 'year' ? 'selected' : '' }}>Tahun Ini
                                    </option>
                                </select>
                                <input type="hidden" name="search" value="{{ $search }}">
                                <input type="hidden" name="type_filter" value="{{ $typeFilter }}">
                            </form>

                            <!-- Type Filter -->
                            <form action="{{ route('nasabah.riwayat.index') }}" method="GET"
                                onchange="this.submit()">
                                <!-- Change this select input -->
                                <select name="type_filter"
                                    class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm bg-gray-50 focus:bg-white transition-colors">
                                    <option value="">Semua Jenis</option>
                                    <option value="pemasukan" {{ $typeFilter == 'pemasukan' ? 'selected' : '' }}>
                                        Pemasukan</option>
                                    <option value="pengeluaran" {{ $typeFilter == 'pengeluaran' ? 'selected' : '' }}>
                                        Pengeluaran</option>
                                </select>
                                <input type="hidden" name="search" value="{{ $search }}">
                                <input type="hidden" name="date_filter" value="{{ $dateFilter }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction Table Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Table Header -->
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white p-2 rounded-xl shadow-sm">
                                <i class="fas fa-table text-gray-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Daftar Transaksi</h3>
                                <p class="text-sm text-gray-500">Riwayat lengkap aktivitas keuangan</p>
                            </div>
                        </div>

                        <div class="text-sm text-gray-600">
                            <i class="fas fa-list mr-2"></i>
                            {{ $transaksis->total() ?? 0 }} transaksi ditemukan
                        </div>
                    </div>
                </div>

                <!-- Table Content -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-calendar text-gray-400"></i>
                                        <span>Tanggal & Waktu</span>
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-tag text-gray-400"></i>
                                        <span>Jenis</span>
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-info-circle text-gray-400"></i>
                                        <span>Keterangan</span>
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-money-bill-wave text-gray-400"></i>
                                        <span>Jumlah</span>
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-check-circle text-gray-400"></i>
                                        <span>Status</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($transaksis as $transaksi)
                                <tr class="hover:bg-blue-50/50 transition-all duration-200 group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $transaksi->created_at ? $transaksi->created_at->format('d M Y') : 'N/A' }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $transaksi->created_at ? $transaksi->created_at->format('H:i') : '' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <!-- Change this section -->
                                        @if ($transaksi->tipe == 'pemasukan')
                                            <span
                                                class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 border border-green-200 shadow-sm">
                                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse">
                                                </div>
                                                <i class="fas fa-arrow-down mr-1"></i>
                                                Pemasukan
                                            </span>
                                        @elseif ($transaksi->tipe == 'pengeluaran')
                                            <span
                                                class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold bg-gradient-to-r from-red-100 to-rose-100 text-red-700 border border-red-200 shadow-sm">
                                                <div class="w-2 h-2 bg-red-500 rounded-full mr-2 animate-pulse"></div>
                                                <i class="fas fa-shopping-cart mr-1"></i>
                                                Pengeluaran
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1-5 rounded-xl text-xs font-semibold bg-gradient-to-r from-gray-100 to-slate-100 text-gray-700 border border-gray-200 shadow-sm">
                                                <div class="w-2 h-2 bg-gray-500 rounded-full mr-2"></div>
                                                <i class="fas fa-question mr-1"></i>
                                                {{ ucfirst($transaksi->tipe) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div
                                            class="text-sm font-semibold text-gray-900 group-hover:text-blue-700 transition-colors">
                                            {{ $transaksi->keterangan }}
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            ID: #{{ str_pad($transaksi->id ?? 0, 6, '0', STR_PAD_LEFT) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div
                                            class="text-base font-bold {{ $transaksi->tipe == 'pemasukan' ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $transaksi->tipe == 'pemasukan' ? '+' : '-' }}Rp{{ number_format($transaksi->jumlah, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold border shadow-sm
    @switch($transaksi->status)
        @case('selesai')
            bg-gradient-to-r from-green-100 to-teal-100 text-green-700 border-green-200
            @break
        @case('pending')
            bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-700 border-yellow-200
            @break
        @case('ditolak')
            bg-gradient-to-r from-red-100 to-pink-100 text-red-700 border-red-200
            @break
    @endswitch">
                                            <div
                                                class="w-2 h-2 rounded-full mr-2
        @switch($transaksi->status)
            @case('selesai') bg-green-500 @break
            @case('pending') bg-yellow-500 @break
            @case('ditolak') bg-red-500 @break
        @endswitch">
                                            </div>
                                            <i
                                                class="fas
        @switch($transaksi->status)
            @case('selesai') fa-check-circle @break
            @case('pending') fa-clock @break
            @case('ditolak') fa-times-circle @break
        @endswitch mr-1"></i>
                                            {{ ucfirst($transaksi->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center space-y-4">
                                            <div
                                                class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center shadow-inner">
                                                <i class="fas fa-exchange-alt text-gray-400 text-3xl"></i>
                                            </div>
                                            <div class="text-gray-500">
                                                <p class="text-xl font-semibold mb-2">Belum ada transaksi</p>
                                                <p class="text-sm text-gray-400">Transaksi Anda akan muncul di sini
                                                    setelah melakukan aktivitas keuangan</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Enhanced Pagination Footer -->
                @if ($transaksis->hasPages())
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-info-circle mr-2 text-gray-400"></i>
                                Menampilkan <span
                                    class="font-semibold text-gray-900">{{ $transaksis->firstItem() }}</span> sampai
                                <span class="font-semibold text-gray-900">{{ $transaksis->lastItem() }}</span> dari
                                <span class="font-semibold text-gray-900">{{ $transaksis->total() }}</span> total
                                transaksi
                            </div>
                            <div class="flex items-center space-x-1">
                                {{ $transaksis->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Quick Actions for Nasabah -->

        </div>
    </div>

    <!-- Enhanced JavaScript -->
    <script>
        // Update current date with better formatting
        document.getElementById('currentDate').innerText = new Date().toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        // Enhanced search highlighting
        @if ($search)
            document.addEventListener('DOMContentLoaded', function() {
                const searchTerm = '{{ $search }}';
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const keteranganCell = row.querySelector('td:nth-child(3) .font-semibold');
                    if (keteranganCell) {
                        const keteranganText = keteranganCell.textContent;
                        const highlightedText = keteranganText.replace(new RegExp(searchTerm, 'gi'),
                            match => `<span class="bg-yellow-200 px-1 rounded">${match}</span>`
                        );
                        keteranganCell.innerHTML = highlightedText;
                    }
                });
            });
        @endif

        // Add smooth scrolling and loading states
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading state to buttons
            const buttons = document.querySelectorAll('button[type="submit"]');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mencari...';
                    this.disabled = true;
                });
            });

            // Add row click animation
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                row.addEventListener('click', function() {
                    this.classList.add('ring-2', 'ring-blue-500', 'ring-opacity-50');
                    setTimeout(() => {
                        this.classList.remove('ring-2', 'ring-blue-500', 'ring-opacity-50');
                    }, 1000);
                });
            });
        });

        // Add auto-refresh functionality
        let autoRefresh = false;

        function toggleAutoRefresh() {
            autoRefresh = !autoRefresh;
            if (autoRefresh) {
                setInterval(() => {
                    if (document.visibilityState === 'visible') {
                        location.reload();
                    }
                }, 30000); // Refresh every 30 seconds
            }
        }
    </script>

    <!-- Add custom styles -->
    <style>
        /* Custom scrollbar */
        .overflow-x-auto::-webkit-scrollbar {
            height: 8px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Custom animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        /* Hover effects */
        .hover-scale:hover {
            transform: scale(1.02);
        }

        /* Custom gradient borders */
        .gradient-border {
            background: linear-gradient(45deg, #3b82f6, #8b5cf6);
            padding: 2px;
            border-radius: 1rem;
        }

        .gradient-border>div {
            background: white;
            border-radius: calc(1rem - 2px);
        }
    </style>
</x-nasabah-layout>
