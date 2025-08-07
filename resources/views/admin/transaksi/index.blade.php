<x-app-layout>
    <!-- Header Section -->
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div class="flex items-center space-x-3">
                <div class="bg-gradient-to-br from-blue-100 to-indigo-100 p-3 rounded-xl shadow-sm">
                    <i class="fas fa-exchange-alt text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                        @section('title', 'Transaksi Operasional')
                        Transaksi Operasional
                    </h2>
                    <p class="text-sm text-gray-600">Kelola data pemasukan dan pengeluaran operasional</p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <div class="text-gray-600 text-sm bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100">
                    <i class="fas fa-calendar-alt mr-2 text-blue-600"></i>
                    <span id="currentDate" class="font-medium"></span>
                </div>
                <a href="{{ route('admin.transaksi.create') }}"
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                    <i class="fas fa-plus mr-2"></i>
                    <span>Tambah Transaksi</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Transaksi Card -->
                <div
                    class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-list text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Transaksi</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $transaksis->total() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Pemasukan Card -->
                <div
                    class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-center">
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-arrow-down text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Pemasukan</p>
                            <p class="text-2xl font-bold text-gray-900">
                                Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Pengeluaran Card -->
                <div
                    class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-center">
                        <div class="bg-red-100 p-3 rounded-full">
                            <i class="fas fa-arrow-up text-red-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Pengeluaran</p>
                            <p class="text-2xl font-bold text-gray-900">
                                Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Saldo Card -->
                <div
                    class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-center">
                        <div class="bg-purple-100 p-3 rounded-full">
                            <i class="fas fa-wallet text-purple-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Saldo</p>
                            <p class="text-2xl font-bold text-gray-900">
                                Rp{{ number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Table Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Table Header -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center space-x-3">
                            <div class="bg-blue-100 p-2 rounded-lg">
                                <i class="fas fa-table text-blue-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Daftar Transaksi Operasional</h3>
                                <p class="text-sm text-gray-600">Kelola catatan pemasukan dan pengeluaran</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <form action="{{ route('admin.transaksi.index') }}" method="GET"
                                class="flex items-center">
                                <div class="relative">
                                    <input type="text" name="search" placeholder="Cari keterangan transaksi..."
                                        value="{{ request('search') }}"
                                        class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm w-64">
                                    <i
                                        class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    @if (request('search'))
                                        <a href="{{ route('admin.transaksi.index') }}"
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </div>
                                <button type="submit"
                                    class="ml-2 px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                            <a href="{{ route('admin.transaksi.create') }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center space-x-2">
                                <i class="fas fa-plus"></i>
                                <span>Tambah</span>
                            </a>
                            <div class="flex items-center gap-2">
                                <form action="{{ route('admin.transaksi.index') }}" method="GET" id="sortForm"
                                    class="flex items-center gap-2">
                                    <label for="sort" class="text-sm text-gray-600 font-medium">Urutkan:</label>

                                    <div class="relative">
                                        <select name="sort" id="sort"
                                            class="appearance-none text-sm border border-gray-300 rounded-lg pl-3 pr-8 py-1.5 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                            onchange="document.getElementById('sortForm').submit()">
                                            <option value="tanggal_desc"
                                                {{ request('sort') == 'tanggal_desc' ? 'selected' : '' }}>Tanggal
                                                (Terbaru)</option>
                                            <option value="tanggal_asc"
                                                {{ request('sort') == 'tanggal_asc' ? 'selected' : '' }}>Tanggal
                                                (Terlama)</option>
                                            <option value="jumlah_desc"
                                                {{ request('sort') == 'jumlah_desc' ? 'selected' : '' }}>Jumlah
                                                (Terbesar)</option>
                                            <option value="jumlah_asc"
                                                {{ request('sort') == 'jumlah_asc' ? 'selected' : '' }}>Jumlah
                                                (Terkecil)</option>
                                        </select>

                                        <!-- Icon panah bawah -->
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Hidden field to preserve search when sorting -->
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                </form>
                            </div>
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
                                    No
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Tanggal
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Tipe
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Keterangan
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Jumlah
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Admin
                                </th>
                                <th
                                    class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($transaksis as $index => $transaksi)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                        {{ $transaksis->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($transaksi->tipe == 'pemasukan')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                <i class="fas fa-arrow-down mr-1 text-green-600"></i>
                                                Pemasukan
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                                <i class="fas fa-arrow-up mr-1 text-red-600"></i>
                                                Pengeluaran
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-semibold text-gray-900">{{ $transaksi->keterangan }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div
                                            class="text-sm font-bold {{ $transaksi->tipe == 'pemasukan' ? 'text-green-600' : 'text-red-600' }}">
                                            Rp{{ number_format($transaksi->jumlah, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $transaksi->admin->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center space-x-3">
                                            <a href="{{ route('admin.transaksi.edit', $transaksi->id) }}"
                                                class="text-blue-600 hover:text-blue-800 transition-colors transform hover:scale-110"
                                                title="Edit">
                                                <i class="fas fa-edit text-lg"></i>
                                            </a>
                                            <button
                                                onclick="confirmDelete('{{ route('admin.transaksi.destroy', $transaksi) }}')"
                                                class="text-red-600 hover:text-red-800 transition-colors"
                                                title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center space-y-3">
                                            <div
                                                class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-exchange-alt text-gray-400 text-2xl"></i>
                                            </div>
                                            <div class="text-gray-500">
                                                <p class="text-lg font-medium">Belum ada transaksi operasional</p>
                                                <p class="text-sm">Mulai tambahkan transaksi pertama</p>
                                            </div>
                                            <a href="{{ route('admin.transaksi.create') }}"
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center space-x-2">
                                                <i class="fas fa-plus"></i>
                                                <span>Tambah Transaksi</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer -->
                @if ($transaksis->hasPages())
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                            <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                                Menampilkan <span class="font-medium">{{ $transaksis->firstItem() }}</span> sampai
                                <span class="font-medium">{{ $transaksis->lastItem() }}</span> dari
                                <span class="font-medium">{{ $transaksis->total() }}</span> transaksi
                            </div>
                            <div class="flex items-center space-x-1">
                                {{-- Previous Page Link --}}
                                @if ($transaksis->onFirstPage())
                                    <span
                                        class="px-3 py-1 text-sm text-gray-400 bg-white border border-gray-300 rounded cursor-not-allowed">
                                        <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                    </span>
                                @else
                                    <a href="{{ $transaksis->previousPageUrl() }}"
                                        class="px-3 py-1 text-sm text-gray-500 bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
                                        <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                <div class="hidden sm:flex items-center space-x-1">
                                    @foreach ($transaksis->getUrlRange(1, $transaksis->lastPage()) as $page => $url)
                                        @if ($page == $transaksis->currentPage())
                                            <span
                                                class="px-3 py-1 text-sm text-white bg-blue-600 rounded">{{ $page }}</span>
                                        @else
                                            <a href="{{ $url }}"
                                                class="px-3 py-1 text-sm text-gray-500 bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    @endforeach
                                </div>

                                {{-- Next Page Link --}}
                                @if ($transaksis->hasMorePages())
                                    <a href="{{ $transaksis->nextPageUrl() }}"
                                        class="px-3 py-1 text-sm text-gray-500 bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
                                        Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                                    </a>
                                @else
                                    <span
                                        class="px-3 py-1 text-sm text-gray-400 bg-white border border-gray-300 rounded cursor-not-allowed">
                                        Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Update current date
        document.getElementById('currentDate').innerText = new Date().toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        // Auto-hide success alert
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.animate-fade-in');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease-out';
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }, 5000);
            });
        });

        // Highlight search term in table
        @if (request('search'))
            document.addEventListener('DOMContentLoaded', function() {
                const searchTerm = '{{ request('search') }}';
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const keteranganCell = row.querySelector('td:nth-child(4) .font-semibold');
                    if (keteranganCell) {
                        const keteranganText = keteranganCell.textContent;
                        const highlightedText = keteranganText.replace(new RegExp(searchTerm, 'gi'),
                            match =>
                            `<span class="bg-yellow-200">${match}</span>`
                        );
                        keteranganCell.innerHTML = highlightedText;
                    }
                });
            });
        @endif

        function confirmDelete(url) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Transaksi ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            _method: 'DELETE'
                        })
                    }).then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText);
                        }
                        return response.json(); // OK jika controller kirim response JSON
                    }).catch(error => {
                        Swal.showValidationMessage(
                            `Gagal menghapus: ${error.message}`
                        );
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Terhapus!',
                        'Transaksi telah dihapus.',
                        'success'
                    ).then(() => {
                        window.location.reload(); // Refresh halaman setelah hapus
                    });
                }
            });
        }
    </script>

    <!-- CSS Animations -->
    <style>
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

        .hover\:shadow-lg:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Custom pagination styling */
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .pagination li {
            margin: 0 2px;
        }

        .pagination li a,
        .pagination li span {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
            color: #4a5568;
            font-size: 0.875rem;
        }

        .pagination li.active span {
            background-color: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .pagination li a:hover {
            background-color: #f7fafc;
        }

        /* Custom scrollbar */
        .overflow-x-auto::-webkit-scrollbar {
            height: 6px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</x-app-layout>
