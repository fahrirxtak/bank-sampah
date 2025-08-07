<x-nasabah-layout>
    <!-- Header Section -->
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div class="flex items-center space-x-3">
                <div class="bg-gradient-to-br from-blue-100 to-indigo-100 p-3 rounded-xl shadow-sm">
                    <i class="fas fa-exchange-alt text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                        @section('title', 'Riwayat Transaksi')
                        Riwayat Transaksi
                    </h2>
                    <p class="text-sm text-gray-600">Daftar seluruh transaksi Anda</p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <div class="text-gray-600 text-sm bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100">
                    <i class="fas fa-calendar-alt mr-2 text-blue-600"></i>
                    <span id="currentDate" class="font-medium"></span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Transaksi Card -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-200">
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
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-200">
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

                <!-- Total Penarikan Card -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-center">
                        <div class="bg-red-100 p-3 rounded-full">
                            <i class="fas fa-arrow-up text-red-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Penarikan</p>
                            <p class="text-2xl font-bold text-gray-900">
                                Rp{{ number_format($totalPenarikan, 0, ',', '.') }}</p>
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
                                <h3 class="text-lg font-semibold text-gray-800">Daftar Transaksi</h3>
                                <p class="text-sm text-gray-600">Riwayat transaksi Anda</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <form action="{{ route('nasabah.riwayat.index') }}" method="GET" class="flex items-center">
                                <div class="relative">
                                    <input type="text" name="search" placeholder="Cari transaksi..."
                                        value="{{ request('search') }}"
                                        class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm w-64">
                                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    @if (request('search'))
                                        <a href="{{ route('nasabah.riwayat.index') }}"
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
                        </div>
                    </div>
                </div>

                <!-- Table Content -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    No
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Tanggal
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Jenis
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Keterangan
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Jumlah
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status
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
                                        {{ $transaksi->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($transaksi->tipe == 'pemasukan')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                <i class="fas fa-arrow-down mr-1 text-green-600"></i>
                                                Setoran
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                                <i class="fas fa-arrow-up mr-1 text-red-600"></i>
                                                Penarikan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-semibold text-gray-900">{{ $transaksi->keterangan }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold {{ $transaksi->tipe == 'pemasukan' ? 'text-green-600' : 'text-red-600' }}">
                                            Rp{{ number_format($transaksi->jumlah, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($transaksi->status == 'selesai')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                <i class="fas fa-check-circle mr-1 text-green-600"></i>
                                                Selesai
                                            </span>
                                        @elseif($transaksi->status == 'pending')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                <i class="fas fa-clock mr-1 text-yellow-600"></i>
                                                Pending
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                                <i class="fas fa-times-circle mr-1 text-red-600"></i>
                                                Ditolak
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center space-y-3">
                                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-exchange-alt text-gray-400 text-2xl"></i>
                                            </div>
                                            <div class="text-gray-500">
                                                <p class="text-lg font-medium">Belum ada transaksi</p>
                                                <p class="text-sm">Mulai lakukan transaksi pertama Anda</p>
                                            </div>
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
                                {{ $transaksis->links() }}
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

        // Highlight search term in table
        @if (request('search'))
            document.addEventListener('DOMContentLoaded', function() {
                const searchTerm = '{{ request('search') }}';
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const keteranganCell = row.querySelector('td:nth-child(4) .font-semibold');
                    if (keteranganCell) {
                        const keteranganText = keteranganCell.textContent;
                        const highlightedText = keteranganText.replace(new RegExp(searchTerm, 'gi'), match =>
                            `<span class="bg-yellow-200">${match}</span>`
                        );
                        keteranganCell.innerHTML = highlightedText;
                    }
                });
            });
        @endif
    </script>
</x-nasabah-layout>
