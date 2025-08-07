<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-green-100 p-2 rounded-lg">
                    <i class="fas fa-recycle text-green-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                        @section('title', 'Data Nasabah')
                    </h2>
                    <p class="text-sm text-gray-600">Kelola data nasabah bank sampah</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-gray-600 text-sm bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100">
                    <i class="fas fa-calendar-alt mr-2 text-green-600"></i>
                    <span id="currentDate" class="font-medium"></span>
                </div>
                <div class="relative">
                    <button
                        class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center hover:bg-green-200 transition-all duration-200 shadow-sm">
                        <i class="fas fa-bell text-green-600"></i>
                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>
                    </button>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-users text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Nasabah</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $nasabah->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-user-check text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Nasabah Aktif</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $nasabah->where('status', 'active')->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <i class="fas fa-coins text-yellow-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Saldo</p>
                            <p class="text-2xl font-bold text-gray-900">
                                Rp{{ number_format($nasabah->sum('saldo'), 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="bg-purple-100 p-3 rounded-full">
                            <i class="fas fa-chart-line text-purple-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Rata-rata Saldo</p>
                            <p class="text-2xl font-bold text-gray-900">
                                Rp{{ number_format($nasabah->avg('saldo'), 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Table Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Table Header -->
                <div class="bg-gradient-to-r from-green-50 to-blue-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center space-x-3">
                            <div class="bg-green-100 p-2 rounded-lg">
                                <i class="fas fa-table text-green-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Daftar Nasabah Bank Sampah</h3>
                                <p class="text-sm text-gray-600">Kelola dan pantau aktivitas nasabah</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="relative">
                                <form action="{{ route('admin.nasabah.index') }}" method="GET"
                                    class="flex items-center space-x-3">
                                    <div class="relative">
                                        <input type="text" name="search" placeholder="Cari nasabah..."
                                            value="{{ request('search') }}"
                                            class="pl-10 pr-10 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none text-sm w-64">
                                        <i
                                            class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                        @if (request('search'))
                                            <a href="{{ route('admin.nasabah.index') }}"
                                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <button type="submit"
                                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center space-x-2">
                                        <i class="fas fa-search"></i>
                                        <span>Cari</span>
                                    </button>
                                </form>
                            </div>
                            <a href="{{ route('admin.nasabah.create') }}"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center space-x-2">
                                <i class="fas fa-plus"></i>
                                <span>Tambah Nasabah</span>
                            </a>
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
                                    <div class="flex items-center space-x-1">
                                        <span>No</span>
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-user text-gray-400"></i>
                                        <span>Nasabah</span>
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-wallet text-gray-400"></i>
                                        <span>Saldo</span>
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-check-circle text-gray-400"></i>
                                        <span>Status</span>
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                                        <span>Alamat</span>
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-calendar text-gray-400"></i>
                                        <span>Bergabung</span>
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($nasabah as $n)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                        <div
                                            class="flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full text-xs font-semibold">
                                            {{ $loop->iteration }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                                {{ strtoupper(substr($n->name, 0, 1)) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900">{{ $n->name }}
                                                </div>
                                                <div class="text-sm text-gray-500 flex items-center">
                                                    <i class="fas fa-envelope text-xs mr-1"></i>
                                                    {{ $n->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-900">
                                            Rp{{ number_format($n->saldo, 0, ',', '.') }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            @if ($n->saldo >= 100000)
                                                <span class="text-green-600"><i class="fas fa-arrow-up"></i>
                                                    Tinggi</span>
                                            @elseif($n->saldo >= 50000)
                                                <span class="text-yellow-600"><i class="fas fa-minus"></i>
                                                    Sedang</span>
                                            @else
                                                <span class="text-red-600"><i class="fas fa-arrow-down"></i>
                                                    Rendah</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($n->status == 'active')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                <i class="fas fa-check-circle mr-1 text-green-600"></i>
                                                Aktif
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                                <i class="fas fa-times-circle mr-1 text-red-600"></i>
                                                Tidak Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="max-w-[200px] overflow-hidden text-ellipsis whitespace-nowrap">
                                            @if ($n->alamat)
                                                <div class="truncate flex items-center" title="{{ $n->alamat }}">
                                                    <i class="fas fa-map-marker-alt text-gray-400 mr-1"></i>
                                                    {{ $n->alamat }}
                                                </div>
                                            @else
                                                <span class="text-gray-400 italic text-xs">Belum diisi</span>
                                            @endif
                                        </div>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex flex-col">
                                            <span class="font-medium">{{ $n->created_at->format('d M Y') }}</span>
                                            <span
                                                class="text-xs text-gray-500">{{ $n->created_at->diffForHumans() }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('admin.nasabah.edit', $n->id) }}"
                                                class="text-green-600 hover:text-green-800 transition-colors"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button
                                                onclick="confirmDelete('{{ route('admin.nasabah.destroy', $n->id) }}')"
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
                                                <i class="fas fa-users text-gray-400 text-2xl"></i>
                                            </div>
                                            <div class="text-gray-500">
                                                <p class="text-lg font-medium">Belum ada nasabah</p>
                                                <p class="text-sm">Mulai tambahkan nasabah pertama Anda</p>
                                            </div>
                                            <a href="{{ route('admin.nasabah.create') }}"
                                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center space-x-2">
                                                <i class="fas fa-plus"></i>
                                                <span>Tambah Nasabah</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer -->
                @if ($nasabah->hasPages())
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                            <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                                Menampilkan <span class="font-medium">{{ $nasabah->firstItem() }}</span> sampai
                                <span class="font-medium">{{ $nasabah->lastItem() }}</span> dari
                                <span class="font-medium">{{ $nasabah->total() }}</span> nasabah
                            </div>
                            <div class="flex items-center space-x-1">
                                {{-- Previous Page Link --}}
                                @if ($nasabah->onFirstPage())
                                    <span
                                        class="px-3 py-1 text-sm text-gray-400 bg-white border border-gray-300 rounded cursor-not-allowed">
                                        <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                    </span>
                                @else
                                    <a href="{{ $nasabah->previousPageUrl() }}"
                                        class="px-3 py-1 text-sm text-gray-500 bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
                                        <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                <div class="hidden sm:flex items-center space-x-1">
                                    @foreach ($nasabah->getUrlRange(1, $nasabah->lastPage()) as $page => $url)
                                        @if ($page == $nasabah->currentPage())
                                            <span
                                                class="px-3 py-1 text-sm text-white bg-green-600 rounded">{{ $page }}</span>
                                        @else
                                            <a href="{{ $url }}"
                                                class="px-3 py-1 text-sm text-gray-500 bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    @endforeach
                                </div>

                                {{-- Next Page Link --}}
                                @if ($nasabah->hasMorePages())
                                    <a href="{{ $nasabah->nextPageUrl() }}"
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

    <script>
        // Update current date
        document.getElementById('currentDate').innerText = new Date().toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        // Add some interactive features
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.querySelector('input[placeholder="Cari nasabah..."]');
            const tableBody = document.querySelector('tbody');
            const emptyRow = document.querySelector('tbody tr:last-child');
            const isEmptyState = emptyRow && emptyRow.querySelector('[colspan="7"]');

            if (searchInput && !isEmptyState) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase().trim();
                    const rows = document.querySelectorAll('tbody tr');
                    let visibleCount = 0;

                    rows.forEach(row => {
                        // Skip if this is an empty state row
                        if (row.querySelector('[colspan="7"]')) {
                            return;
                        }

                        // Get searchable text from specific columns
                        const nameCell = row.cells[1];
                        const emailCell = row.cells[1];
                        const addressCell = row.cells[4];

                        let searchableText = '';

                        if (nameCell) {
                            const nameElement = nameCell.querySelector('.text-sm.font-semibold');
                            const emailElement = nameCell.querySelector('.text-sm.text-gray-500');

                            if (nameElement) searchableText += nameElement.textContent + ' ';
                            if (emailElement) searchableText += emailElement.textContent + ' ';
                        }

                        if (addressCell) {
                            const addressText = addressCell.textContent.replace('Belum diisi', '');
                            searchableText += addressText;
                        }

                        searchableText = searchableText.toLowerCase();

                        if (searchTerm === '' || searchableText.includes(searchTerm)) {
                            row.style.display = '';
                            row.style.opacity = '1';
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                            row.style.opacity = '0';
                        }
                    });

                    // Show/hide "no results" message
                    let noResultsRow = document.querySelector('#no-results-row');

                    if (visibleCount === 0 && searchTerm !== '') {
                        if (!noResultsRow) {
                            noResultsRow = document.createElement('tr');
                            noResultsRow.id = 'no-results-row';
                            noResultsRow.innerHTML = `
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center space-y-3">
                                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-search text-gray-400 text-2xl"></i>
                                        </div>
                                        <div class="text-gray-500">
                                            <p class="text-lg font-medium">Tidak ada hasil</p>
                                            <p class="text-sm">Tidak ditemukan nasabah dengan kata kunci "${searchTerm}"</p>
                                        </div>
                                        <button onclick="document.querySelector('input[placeholder=\\"Cari nasabah...\\"]').value=''; document.querySelector('input[placeholder=\\"Cari nasabah...\\"]').dispatchEvent(new Event('input'));" class="text-green-600 hover:text-green-700 text-sm font-medium">
                                            <i class="fas fa-times mr-1"></i>
                                            Hapus pencarian
                                        </button>
                                    </div>
                                </td>
                            `;
                            tableBody.appendChild(noResultsRow);
                        }
                        noResultsRow.style.display = '';
                    } else {
                        if (noResultsRow) {
                            noResultsRow.style.display = 'none';
                        }
                    }

                    // Update table footer count
                    const tableFooter = document.querySelector('.bg-gray-50.px-6.py-4');
                    if (tableFooter && visibleCount > 0) {
                        const countText = tableFooter.querySelector('.text-sm.text-gray-700');
                        if (countText) {
                            const totalRows = rows.length - (isEmptyState ? 1 : 0);
                            if (searchTerm === '') {
                                countText.innerHTML =
                                    `Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">${totalRows}</span> dari <span class="font-medium">${totalRows}</span> nasabah`;
                            } else {
                                countText.innerHTML =
                                    `Menampilkan <span class="font-medium">${visibleCount}</span> hasil dari <span class="font-medium">${totalRows}</span> nasabah untuk "${searchTerm}"`;
                            }
                        }
                    }
                });

                // Add clear search functionality
                const clearButton = document.createElement('button');
                clearButton.innerHTML = '<i class="fas fa-times"></i>';
                clearButton.className =
                    'absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors';
                clearButton.style.display = 'none';
                clearButton.onclick = function() {
                    searchInput.value = '';
                    searchInput.dispatchEvent(new Event('input'));
                    searchInput.focus();
                };

                searchInput.parentElement.appendChild(clearButton);

                // Show/hide clear button
                searchInput.addEventListener('input', function() {
                    clearButton.style.display = this.value ? 'block' : 'none';
                });
            }

            // Add hover effects to action buttons
            const actionButtons = document.querySelectorAll('tbody button');
            actionButtons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.1)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });
        });

        function confirmDelete(url) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data nasabah akan dihapus secara permanen!",
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
                        return response.json();
                    }).catch(error => {
                        Swal.showValidationMessage(
                            `Request failed: ${error}`
                        );
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Terhapus!',
                        'Data nasabah telah dihapus.',
                        'success'
                    ).then(() => {
                        window.location.reload();
                    });
                }
            });
        }
    </script>

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

        tbody tr {
            animation: fadeIn 0.3s ease-out;
        }

        .hover\\:shadow-md:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        button {
            transition: all 0.2s ease;
        }
    </style>
</x-app-layout>
