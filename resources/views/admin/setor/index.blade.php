<x-app-layout>
    <x-slot name="header">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <div class="bg-gradient-to-br from-green-100 via-emerald-100 to-teal-100 p-4 rounded-2xl shadow-md">
                        <i class="fas fa-piggy-bank text-green-600 text-2xl"></i>
                    </div>
                    <div
                        class="absolute -top-1 -right-1 w-6 h-6 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full animate-pulse">
                    </div>
                </div>
                <div>
                    <h2 class="font-bold text-3xl text-gray-800 leading-tight">
                        @section('title', 'Transaksi Nasabah')
                        Transaksi Nasabah
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Kelola transaksi sampah dan keuangan dengan mudah</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="bg-green-50 px-4 py-2 rounded-lg">
                    <span class="text-sm font-medium text-green-700">Saldo: Rp
                        {{ number_format(Auth::user()->saldo ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Enhanced Tab Navigation -->
            <div class="mb-8">
                <div class="border-b border-gray-200 bg-white rounded-t-xl shadow-sm">
                    <nav class="flex space-x-8 px-6" aria-label="Tabs">
                        <button id="tabSetorSampah"
                            class="tab-button active py-4 px-2 border-b-2 font-medium text-sm transition-all duration-200 border-green-500 text-green-600">
                            <i class="fas fa-recycle mr-2"></i>
                            Setor Sampah
                        </button>
                        <button id="tabSetorTunai"
                            class="tab-button py-4 px-2 border-b-2 font-medium text-sm transition-all duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            <i class="fas fa-coins mr-2"></i>
                            Setor Tunai
                        </button>
                        <button id="tabTarikTunai"
                            class="tab-button py-4 px-2 border-b-2 font-medium text-sm transition-all duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            <i class="fas fa-money-bill-wave mr-2"></i>
                            Tarik Tunai
                        </button>
                        <button id="tabKonfirmasiTarikTunai"
                            class="tab-button py-4 px-2 border-b-2 font-medium text-sm transition-all duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            <i class="fas fa-money-bill-wave mr-2"></i>
                            Konfirmasi Tarik Tunai
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Form Setor Sampah -->
            <div id="formSetorSampah" class="form-container animate-fade-in">
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-6 text-white">
                        <h3 class="text-xl font-bold flex items-center">
                            <i class="fas fa-recycle mr-3 text-2xl"></i>
                            Form Setor Sampah
                        </h3>
                        <p class="text-green-100 mt-2">Bawa sampah ke bank sampah untuk ditimbang oleh admin</p>
                    </div>

                    <form action="{{ route('setor.sampah.store') }}" method="POST" class="p-8 space-y-6"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="jenis_transaksi" value="setor_sampah">

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                            <!-- Pilih User yang Setor -->
                            <div class="space-y-3">
                                <label class="flex items-center text-sm font-semibold text-gray-700">
                                    <i class="fas fa-user mr-2 text-blue-600"></i>
                                    nasabah yang Setor <span class="text-red-500 ml-1">*</span>
                                </label>

                                <div class="searchable-select">
                                    <input type="text" id="searchableUserInputSetorSampah"
                                        class="search-input w-full rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 p-3"
                                        placeholder="Pilih atau ketik nama user..." autocomplete="off"
                                        onfocus="showUserDropdown('searchableUserInputSetorSampah', 'userDropdownOptionsSetorSampah')"
                                        oninput="filterUserOptions('searchableUserInputSetorSampah', 'userDropdownOptionsSetorSampah', 'selectedUserIdSetorSampah')"
                                        onblur="hideUserDropdownDelayed('userDropdownOptionsSetorSampah')">

                                    <div id="userDropdownOptionsSetorSampah" class="dropdown-options">
                                        <!-- Options akan diisi otomatis dari data Laravel -->
                                    </div>

                                    <!-- Hidden input untuk form submission -->
                                    <input type="hidden" name="user_id" id="selectedUserIdSetorSampah" required>
                                </div>
                            </div>

                            <!-- Jenis Sampah -->
                            <div class="space-y-3">
                                <label class="flex items-center text-sm font-semibold text-gray-700">
                                    <i class="fas fa-tags mr-2 text-green-600"></i>
                                    Jenis Sampah <span class="text-red-500 ml-1">*</span>
                                </label>
                                <select name="sampah_id" id="sampahSelect"
                                    class="w-full rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 p-3"
                                    required>
                                    <option value="">Pilih Jenis Sampah</option>
                                    @foreach ($sampahs as $sampah)
                                        <option value="{{ $sampah->id }}" data-harga="{{ $sampah->harga_kg }}">
                                            {{ $sampah->nama }}
                                            (Rp{{ number_format($sampah->harga_kg, 0, ',', '.') }}/kg)
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Berat -->
                            <div class="space-y-3">
                                <label class="flex items-center text-sm font-semibold text-gray-700">
                                    <i class="fas fa-weight mr-2 text-green-600"></i>
                                    Berat (kg) <span class="text-red-500 ml-1">*</span>
                                </label>
                                <input type="number" name="berat" id="beratInput" step="0.1" min="0.1"
                                    class="w-full rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 p-3"
                                    placeholder="Contoh: 2.5" required>
                            </div>

                            <!-- Catatan -->
                            <div class="space-y-3">
                                <label class="flex items-center text-sm font-semibold text-gray-700">
                                    <i class="fas fa-sticky-note mr-2 text-green-600"></i>
                                    Catatan (Opsional)
                                </label>
                                <textarea name="catatan" rows="3"
                                    class="w-full rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 p-3"
                                    placeholder="Tambahkan catatan tentang sampah..."></textarea>
                            </div>
                        </div>

                        <!-- Preview Harga -->
                        <div id="previewHarga" class="hidden">
                            <div
                                class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-xl border-2 border-green-200">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-sm font-medium text-green-700">Perkiraan Nilai Sampah</p>
                                        <p class="text-3xl font-bold text-green-600 mt-1" id="nilaiSampah">Rp 0</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-green-600" id="detailPerhitungan">0 kg × Rp 0</p>
                                        <p class="text-xs text-gray-500 mt-1">Harga dapat berubah saat penimbangan</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-200">
                            <button type="submit"
                                class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl font-semibold hover:from-green-700 hover:to-emerald-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Ajukan Setoran Sampah
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Form Setor Tunai -->
            <div id="formSetorTunai" class="form-container hidden animate-fade-in">
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-8 py-6 text-white">
                        <h3 class="text-xl font-bold flex items-center">
                            <i class="fas fa-coins mr-3 text-2xl"></i>
                            Form Setor Tunai
                        </h3>
                        <p class="text-blue-100 mt-2">Tambahkan saldo ke rekening bank sampah Anda</p>
                    </div>

                    <form action="{{ route('setor.tunai.store') }}" method="POST" enctype="multipart/form-data"
                        class="p-8 space-y-6">

                        @csrf
                        <input type="hidden" name="jenis_transaksi" value="setor_tunai">

                        <div class="space-y-3">
                            <label class="flex items-center text-sm font-semibold text-gray-700">
                                <i class="fas fa-user mr-2 text-blue-600"></i>
                                User yang Setor <span class="text-red-500 ml-1">*</span>
                            </label>

                            <div class="searchable-select">
                                <input type="text" id="searchableUserInputSetorTunai"
                                    class="search-input w-full rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 p-3"
                                    placeholder="Pilih atau ketik nama user..." autocomplete="off"
                                    onfocus="showUserDropdown('searchableUserInputSetorTunai', 'userDropdownOptionsSetorTunai')"
                                    oninput="filterUserOptions('searchableUserInputSetorTunai', 'userDropdownOptionsSetorTunai', 'selectedUserIdSetorTunai')"
                                    onblur="hideUserDropdownDelayed('userDropdownOptionsSetorTunai')">

                                <div id="userDropdownOptionsSetorTunai" class="dropdown-options">
                                    <!-- Options akan diisi otomatis dari data Laravel -->
                                </div>

                                <!-- Hidden input untuk form submission -->
                                <input type="hidden" name="user_id" id="selectedUserIdSetorTunai" required>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="flex items-center text-sm font-semibold text-gray-700">
                                <i class="fas fa-money-bill mr-2 text-blue-600"></i>
                                Jumlah Setoran (Rp) <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="number" name="jumlah_uang" min="1000" step="1000"
                                class="w-full rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 p-3 text-lg"
                                placeholder="Minimal Rp 1.000" required>
                            <p class="text-sm text-gray-500">Minimal setoran Rp 1.000, kelipatan Rp 1.000</p>
                        </div>

                        <div class="space-y-3">
                            <label class="flex items-center text-sm font-semibold text-gray-700">
                                <i class="fas fa-sticky-note mr-2 text-blue-600"></i>
                                Catatan (Opsional)
                            </label>
                            <textarea name="catatan" rows="3"
                                class="w-full rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 p-3"
                                placeholder="Tambahkan catatan setoran..."></textarea>
                        </div>

                        <div class="pt-6 border-t border-gray-200">
                            <button type="submit"
                                class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-semibold hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
                                <i class="fas fa-check-circle mr-2"></i>
                                Proses Setoran Tunai
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="formTarikTunai" class="form-container hidden animate-fade-in">
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-500 to-violet-600 px-8 py-6 text-white">
                        <h3 class="text-xl font-bold flex items-center">
                            <i class="fas fa-money-bill-wave mr-3 text-2xl"></i>
                            Form Tarik Tunai
                        </h3>
                        <p class="text-purple-100 mt-2">Tarik saldo dari rekening bank sampah</p>
                    </div>

                    <form id="tarikTunaiForm" action="{{ route('penarikan.admin') }}" method="POST"
                        class="p-8 space-y-6">
                        @csrf
                        <input type="hidden" name="jenis_transaksi" value="tarik_tunai">

                        <!-- Pilih User -->
                        <div class="space-y-3">
                            <label class="flex items-center text-sm font-semibold text-gray-700">
                                <i class="fas fa-user mr-2 text-blue-600"></i>
                                User yang Setor <span class="text-red-500 ml-1">*</span>
                            </label>

                            <div class="searchable-select">
                                <input type="text" id="searchableUserInputTarikTunai"
                                    class="search-input w-full rounded-xl border-2 border-gray-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200 p-3"
                                    placeholder="Pilih atau ketik nama user..." autocomplete="off"
                                    onfocus="showUserDropdown('searchableUserInputTarikTunai', 'userDropdownOptionsTarikTunai')"
                                    oninput="filterUserOptions('searchableUserInputTarikTunai', 'userDropdownOptionsTarikTunai', 'selectedUserIdTarikTunai')"
                                    onblur="hideUserDropdownDelayed('userDropdownOptionsTarikTunai')">

                                <div id="userDropdownOptionsTarikTunai" class="dropdown-options">
                                    <!-- Options akan diisi otomatis dari data Laravel -->
                                </div>

                                <!-- Hidden input untuk form submission -->
                                <input type="hidden" name="user_id" id="selectedUserIdTarikTunai" required>
                            </div>
                        </div>

                        <!-- Jumlah Penarikan -->
                        <div class="space-y-3">
                            <label class="flex items-center text-sm font-semibold text-gray-700">
                                <i class="fas fa-money-bill-wave mr-2 text-purple-600"></i>
                                Jumlah Penarikan (Rp) <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="number" name="jumlah_uang" min="10000" step="1000"
                                class="w-full rounded-xl border-2 border-gray-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200 p-3 text-lg"
                                placeholder="Minimal Rp 10.000" required>
                            <p class="text-sm text-gray-500">Minimal penarikan Rp 10.000</p>
                        </div>

                        <!-- Info Penarikan -->
                        <div
                            class="bg-gradient-to-r from-purple-50 to-violet-50 p-6 rounded-xl border border-purple-200">
                            <h4 class="font-semibold text-purple-800 mb-3">Informasi Penarikan</h4>
                            <div class="space-y-2 text-sm text-gray-700">
                                <p>• Penarikan tunai: Datang ke bank sampah dengan membawa KTP</p>
                                <p>• Masukan Password User</p>
                                <p>• Pastikan jumlah penarikan sesuai saldo</p>
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div class="space-y-3">
                            <label class="flex items-center text-sm font-semibold text-gray-700">
                                <i class="fas fa-sticky-note mr-2 text-purple-600"></i>
                                Catatan / Nomor Rekening <span class="text-red-500 ml-1">*</span>
                            </label>
                            <textarea name="catatan" rows="3"
                                class="w-full rounded-xl border-2 border-gray-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200 p-3"
                                placeholder="Untuk transfer: tulis nomor rekening dan nama bank
Untuk tunai: tulis alasan penarikan" required></textarea>
                        </div>

                        <!-- Tombol -->
                        <div class="pt-6 border-t border-gray-200">
                            <button type="button" onclick="showPasswordModal()"
                                class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-purple-600 to-violet-600 text-white rounded-xl font-semibold hover:from-purple-700 hover:to-violet-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
                                <i class="fas fa-hand-holding-usd mr-2"></i>
                                Ajukan Penarikan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Password -->
            <div id="passwordModal"
                class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="bg-white p-6 rounded-xl w-96">
                    <h3 class="text-lg font-semibold mb-4">Masukkan Password User</h3>
                    <input type="password" name="password_user" form="tarikTunaiForm"
                        class="w-full p-3 border rounded-lg mb-4" placeholder="Password user" required>
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="hidePasswordModal()"
                            class="px-4 py-2 bg-gray-300 rounded-lg">Batal</button>
                        <button type="submit" form="tarikTunaiForm"
                            class="px-4 py-2 bg-purple-600 text-white rounded-lg">Proses</button>
                    </div>
                </div>
            </div>

            <div id="formKonfirmasiTarikTunai"
                class="form-container min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 py-8 hidden">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 animate-fade-in">
                    <!-- Header Section -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-3xl font-bold text-gray-800">Konfirmasi Penarikan Dana</h1>
                                    <p class="text-gray-600">Kelola dan konfirmasi penarikan dana nasabah</p>
                                </div>
                            </div>

                            <!-- Stats Cards -->
                            <div class="hidden md:flex space-x-4">
                                <div
                                    class="bg-white/80 backdrop-blur-sm rounded-xl px-4 py-3 shadow-lg border border-green-100">
                                    <div class="text-sm text-gray-600">Total Ajuan</div>
                                    <div class="text-2xl font-bold text-gray-800">{{ $ajuan->count() }}</div>
                                </div>
                                <div
                                    class="bg-white/80 backdrop-blur-sm rounded-xl px-4 py-3 shadow-lg border border-yellow-100">
                                    <div class="text-sm text-gray-600">Pending</div>
                                    <div class="text-2xl font-bold text-yellow-600">
                                        {{ $ajuan->where('status', 'pending')->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Success Alert -->
                    @if (session('success'))
                        <div
                            class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl mb-6 flex items-center shadow-lg">
                            <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <div class="font-medium">Berhasil!</div>
                                <div class="text-sm">{{ session('success') }}</div>
                            </div>
                        </div>
                    @endif

                    <!-- Main Content Card -->
                    <div
                        class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-green-100 overflow-hidden ">
                        <!-- Card Header -->
                        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <h2 class="text-xl font-bold text-white">Daftar Penarikan</h2>
                                <div class="text-green-100 text-sm">
                                    {{ now()->format('d M Y') }}
                                </div>
                            </div>
                        </div>

                        <!-- Table Section -->
                        <div class="p-6">
                            @if ($ajuan->count() > 0)
                                <!-- Mobile Stats (visible on small screens) -->
                                <div class="md:hidden grid grid-cols-2 gap-4 mb-6">
                                    <div class="bg-gray-50 rounded-xl px-4 py-3">
                                        <div class="text-sm text-gray-600">Total Ajuan</div>
                                        <div class="text-2xl font-bold text-gray-800">{{ $ajuan->count() }}</div>
                                    </div>
                                    <div class="bg-yellow-50 rounded-xl px-4 py-3">
                                        <div class="text-sm text-gray-600">Pending</div>
                                        <div class="text-2xl font-bold text-yellow-600">
                                            {{ $ajuan->where('status', 'pending')->count() }}</div>
                                    </div>
                                </div>

                                <!-- Desktop Table -->
                                <div class="hidden lg:block overflow-hidden rounded-xl border border-gray-200">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    #</th>
                                                <th
                                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Nasabah</th>
                                                <th
                                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Jumlah</th>
                                                <th
                                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Tanggal</th>
                                                <th
                                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Status</th>
                                                <th
                                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($ajuan as $item)
                                                <tr class="hover:bg-gray-50 transition-colors">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div
                                                                class="w-10 h-10 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center mr-3">
                                                                <span class="text-white font-medium text-sm">
                                                                    {{ substr($item->user->name, 0, 1) }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    {{ $item->user->name }}</div>
                                                                <div class="text-sm text-gray-500">
                                                                    {{ $item->user->email }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-bold text-gray-900">Rp
                                                            {{ number_format($item->jumlah_tarik, 0, ',', '.') }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $item->created_at->format('d M Y') }}
                                                        <div class="text-xs text-gray-400">
                                                            {{ $item->created_at->format('H:i') }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if ($item->status == 'approved')
                                                            <span
                                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                <span
                                                                    class="w-2 h-2 bg-green-400 rounded-full mr-2"></span>
                                                                Disetujui
                                                            </span>
                                                        @elseif ($item->status == 'rejected')
                                                            <span
                                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                                <span
                                                                    class="w-2 h-2 bg-red-400 rounded-full mr-2"></span>
                                                                Ditolak
                                                            </span>
                                                        @else
                                                            <span
                                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                                <span
                                                                    class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></span>
                                                                Pending
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        @if ($item->status == 'pending')
                                                            <div class="flex space-x-2">
                                                                <form method="POST"
                                                                    action="{{ route('admin.penarikan.konfirmasi', $item->id) }}"
                                                                    class="inline">
                                                                    @csrf
                                                                    @method('POST')
                                                                    <input type="hidden" name="status"
                                                                        value="approved">
                                                                    <button type="submit"
                                                                        onclick="return confirm('Apakah Anda yakin ingin menyetujui penarikan ini?')"
                                                                        class="inline-flex items-center px-3 py-1.5 bg-green-500 hover:bg-green-600 text-white text-xs font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                                                        <svg class="w-3 h-3 mr-1" fill="none"
                                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                stroke-width="2" d="M5 13l4 4L19 7">
                                                                            </path>
                                                                        </svg>
                                                                        Setujui
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        @else
                                                            <span class="text-gray-400 text-xs">Sudah diproses</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Mobile Cards -->
                                <div class="lg:hidden space-y-4">
                                    @foreach ($ajuan as $item)
                                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                            <div class="flex items-center justify-between mb-3">
                                                <div class="flex items-center">
                                                    <div
                                                        class="w-10 h-10 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center mr-3">
                                                        <span class="text-white font-medium text-sm">
                                                            {{ substr($item->user->name, 0, 1) }}
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <div class="font-medium text-gray-900">{{ $item->user->name }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ $item->created_at->format('d M Y, H:i') }}</div>
                                                    </div>
                                                </div>
                                                @if ($item->status == 'approved')
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <span class="w-2 h-2 bg-green-400 rounded-full mr-1"></span>
                                                        Disetujui
                                                    </span>
                                                @elseif ($item->status == 'rejected')
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        <span class="w-2 h-2 bg-red-400 rounded-full mr-1"></span>
                                                        Ditolak
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <span class="w-2 h-2 bg-yellow-400 rounded-full mr-1"></span>
                                                        Pending
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <div class="text-lg font-bold text-gray-900">Rp
                                                    {{ number_format($item->jumlah_tarik, 0, ',', '.') }}</div>
                                            </div>

                                            @if ($item->status == 'pending')
                                                <div class="flex space-x-2">
                                                    <form method="POST"
                                                        action="{{ route('admin.penarikan.konfirmasi', $item->id) }}"
                                                        class="flex-1">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="approved">
                                                        <button type="submit"
                                                            onclick="return confirm('Apakah Anda yakin ingin menyetujui penarikan ini?')"
                                                            class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-sm font-medium rounded-lg transition-colors">
                                                            <svg class="w-4 h-4 mr-2" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                            Setujui
                                                        </button>
                                                    </form>
                                                    <form method="POST"
                                                        action="{{ route('admin.penarikan.konfirmasi', $item->id) }}"
                                                        class="flex-1">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button type="submit"
                                                            onclick="return confirm('Apakah Anda yakin ingin menolak penarikan ini?')"
                                                            class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-lg transition-colors">
                                                            <svg class="w-4 h-4 mr-2" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                            Tolak
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="text-center text-gray-400 text-sm py-2">Sudah diproses
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <!-- Empty State -->
                                <div class="text-center py-12">
                                    <div
                                        class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                            </path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada penarikan yang
                                        menunggu konfirmasi</h3>
                                    <p class="text-gray-500 max-w-md mx-auto">Semua permintaan penarikan telah diproses
                                        atau belum ada pengajuan penarikan baru.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Footer Info -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-blue-800">Proses Konfirmasi</h4>
                            </div>
                            <p class="text-blue-700 text-sm">Periksa setiap pengajuan dengan teliti sebelum memberikan
                                konfirmasi.</p>
                        </div>

                        <div class="bg-green-50 border border-green-200 rounded-xl p-6">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-green-800">Waktu Proses</h4>
                            </div>
                            <p class="text-green-700 text-sm">Konfirmasi penarikan dalam 1-2 hari kerja untuk menjaga
                                kepercayaan nasabah.</p>
                        </div>

                        <div class="bg-purple-50 border border-purple-200 rounded-xl p-6">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                        </path>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-purple-800">Keamanan</h4>
                            </div>
                            <p class="text-purple-700 text-sm">Pastikan saldo nasabah mencukupi sebelum menyetujui
                                penarikan.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Konfirmasi Password -->
            <div id="passwordModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-md">
                    <h2 class="text-lg font-semibold mb-4">Masukkan Password untuk Konfirmasi</h2>
                    <form action="{{ route('tarik.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id_hidden" id="user_id_hidden">
                        <input type="hidden" name="jumlah_uang_hidden" id="jumlah_uang_hidden">
                        <input type="hidden" name="catatan_hidden" id="catatan_hidden">

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" required
                                class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-purple-300">
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="hidePasswordModal()"
                                class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                            <button type="submit"
                                class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">Konfirmasi</button>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Riwayat Transaksi -->
            <div class="mt-12">
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-600 to-slate-700 px-8 py-6 text-white">
                        <h3 class="text-xl font-bold flex items-center">
                            <i class="fas fa-history mr-3 text-2xl"></i>
                            Riwayat Transaksi
                        </h3>
                        <p class="text-gray-200 mt-2">Semua aktivitas transaksi Anda</p>
                    </div>

                    <div class="p-6">
                        <!-- Filter & Search -->
                        <form method="GET" class="flex flex-col sm:flex-row gap-4 mb-6">
                            <select name="tipe"
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                <option value="">Semua Transaksi</option>
                                <option value="setor" {{ request('tipe') == 'setor' ? 'selected' : '' }}>Setor
                                </option>
                                <option value="tarik" {{ request('tipe') == 'tarik' ? 'selected' : '' }}>Tarik
                                </option>
                                <option value="operasional" {{ request('tipe') == 'operasional' ? 'selected' : '' }}>
                                    Operasional</option>
                            </select>
                            <select name="kategori"
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                <option value="">Semua Kategori</option>
                                <option value="pemasukan" {{ request('kategori') == 'pemasukan' ? 'selected' : '' }}>
                                    Pemasukan</option>
                                <option value="pengeluaran"
                                    {{ request('kategori') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                            </select>
                            <input type="search" name="search" placeholder="Cari transaksi..."
                                value="{{ request('search') }}"
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 flex-1">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                            @if (request('tipe') || request('kategori') || request('search'))
                                <a href="{{ url()->current() }}"
                                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                                    <i class="fas fa-times"></i> Reset
                                </a>
                            @endif
                        </form>

                        <!-- Tabel Desktop -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tipe</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kategori</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Keterangan</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($riwayatTransaksi as $item)
                                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($item->tipe == 'setor')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <i class="fas fa-arrow-up mr-1"></i>
                                                        Setor
                                                    </span>
                                                @elseif($item->tipe == 'tarik')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        <i class="fas fa-arrow-down mr-1"></i>
                                                        Tarik
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        <i class="fas fa-cog mr-1"></i>
                                                        Operasional
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ ucfirst($item->kategori) }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ $item->keterangan }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm font-semibold @if ($item->kategori == 'pemasukan') text-green-600 @else text-red-600 @endif">
                                                @if ($item->kategori == 'pemasukan')
                                                    + Rp{{ number_format($item->jumlah, 0, ',', '.') }}
                                                @else
                                                    - Rp{{ number_format($item->jumlah, 0, ',', '.') }}
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-12 text-center">
                                                <div class="text-gray-400">
                                                    <i class="fas fa-inbox text-4xl mb-4"></i>
                                                    <p class="text-sm text-gray-500">Belum ada riwayat transaksi</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Cards Mobile -->
                        <div class="md:hidden space-y-4">
                            @forelse($riwayatTransaksi as $item)
                                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="text-sm text-gray-500">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y H:i') }}
                                            </p>
                                            <h4 class="font-medium mt-1">{{ $item->keterangan }}</h4>
                                        </div>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if ($item->tipe == 'setor') bg-green-100 text-green-800
                                @elseif($item->tipe == 'tarik') bg-red-100 text-red-800
                                @else bg-blue-100 text-blue-800 @endif">
                                            {{ ucfirst($item->tipe) }}
                                        </span>
                                    </div>
                                    <div class="mt-3 flex justify-between items-center">
                                        <span class="text-sm text-gray-500">{{ ucfirst($item->kategori) }}</span>
                                        <span
                                            class="font-semibold @if ($item->kategori == 'pemasukan') text-green-600 @else text-red-600 @endif">
                                            @if ($item->kategori == 'pemasukan')
                                                + Rp{{ number_format($item->jumlah, 0, ',', '.') }}
                                            @else
                                                - Rp{{ number_format($item->jumlah, 0, ',', '.') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <i class="fas fa-inbox text-4xl text-gray-400 mb-3"></i>
                                    <p class="text-gray-500">Belum ada riwayat transaksi</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination dengan Style Custom -->
                        @if ($riwayatTransaksi->hasPages())
                            <div class="mt-6">
                                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                                    <div class="text-sm text-gray-600">
                                        Menampilkan <span
                                            class="font-medium">{{ $riwayatTransaksi->firstItem() }}</span>
                                        sampai <span class="font-medium">{{ $riwayatTransaksi->lastItem() }}</span>
                                        dari
                                        <span class="font-medium">{{ $riwayatTransaksi->total() }}</span> transaksi
                                    </div>

                                    <div class="flex flex-wrap gap-1">
                                        {{ $riwayatTransaksi->withQueryString()->onEachSide(1)->links('pagination::tailwind') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Tambahkan style untuk pagination jika belum ada -->
            <style>
                .pagination {
                    display: flex;
                    gap: 0.5rem;
                    flex-wrap: wrap;
                }

                .page-item {
                    list-style: none;
                }

                .page-link {
                    display: block;
                    padding: 0.5rem 1rem;
                    border: 1px solid #d1d5db;
                    border-radius: 0.375rem;
                    color: #4b5563;
                    text-decoration: none;
                    transition: all 0.2s;
                }

                .page-link:hover {
                    background-color: #f3f4f6;
                }

                .page-item.active .page-link {
                    background-color: #3b82f6;
                    color: white;
                    border-color: #3b82f6;
                }

                .page-item.disabled .page-link {
                    color: #9ca3af;
                    pointer-events: none;
                    background-color: #f9fafb;
                }
            </style>
        </div>
    </div>
    <!-- JS Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- JavaScript -->
    <script>
        function showPasswordModal() {
            const userId = document.getElementById('selectedUserIdTarikTunai').value;
            const jumlah = parseInt(document.querySelector('input[name="jumlah_uang"]').value, 10) || 0;
            const catatan = document.querySelector('textarea[name="catatan"]').value;

            if (!userId) {
                alert('Silakan pilih user terlebih dahulu.');
                return;
            }

       

            document.getElementById('passwordModal').classList.remove('hidden');
        }


        function hidePasswordModal() {
            document.getElementById('passwordModal').classList.add('hidden');
        }


        // Tab switching functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = {
                tabSetorSampah: 'formSetorSampah',
                tabSetorTunai: 'formSetorTunai',
                tabTarikTunai: 'formTarikTunai',
                tabKonfirmasiTarikTunai: 'formKonfirmasiTarikTunai'
            };

            // Initialize first tab as active
            document.getElementById('formSetorSampah').classList.remove('hidden');
            document.getElementById('tabSetorSampah').classList.add('active');

            // Add click event listeners to all tabs
            Object.keys(tabs).forEach(tabId => {
                const tabButton = document.getElementById(tabId);
                const formId = tabs[tabId];

                tabButton.addEventListener('click', function() {
                    // Hide all forms
                    document.querySelectorAll('.form-container').forEach(form => {
                        form.classList.add('hidden');
                    });

                    // Remove active class from all tabs
                    document.querySelectorAll('.tab-button').forEach(tab => {
                        tab.classList.remove('active', 'border-green-500',
                            'text-green-600');
                        tab.classList.add('border-transparent', 'text-gray-500');
                    });

                    // Show selected form
                    document.getElementById(formId).classList.remove('hidden');

                    // Add active class to selected tab
                    this.classList.remove('border-transparent', 'text-gray-500');
                    this.classList.add('active', 'border-green-500', 'text-green-600');
                });
            });
        });

        // Calculate waste value
        const sampahSelect = document.querySelector('select[name="sampah_id"]');
        const beratInput = document.querySelector('input[name="berat"]');
        const previewHarga = document.getElementById('previewHarga');
        const nilaiSampah = document.getElementById('nilaiSampah');
        const detailPerhitungan = document.getElementById('detailPerhitungan');

        function hitungNilaiSampah() {
            const selectedOption = sampahSelect.options[sampahSelect.selectedIndex];
            const hargaPerKg = selectedOption ? parseFloat(selectedOption.dataset.harga) : 0;
            const berat = parseFloat(beratInput.value) || 0;
            const total = hargaPerKg * berat;

            if (selectedOption && berat > 0) {
                previewHarga.classList.remove('hidden');
                nilaiSampah.textContent = 'Rp' + total.toLocaleString('id-ID');
                detailPerhitungan.textContent = `${berat} kg × Rp${hargaPerKg.toLocaleString('id-ID')}`;
            } else {
                previewHarga.classList.add('hidden');
            }
        }

        if (sampahSelect && beratInput) {
            sampahSelect.addEventListener('change', hitungNilaiSampah);
            beratInput.addEventListener('input', hitungNilaiSampah);
        }

        // Form submissions
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;

                // Show loading state
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
                submitBtn.disabled = true;

                // Re-enable after 3 seconds (for demo)
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            });
        });


        // Data users dari Laravel (ganti dengan @json($users))
        // Data users dari Laravel
        const allUsers = @json($users);

        // Fungsi untuk menampilkan dropdown
        function showUserDropdown(inputId, dropdownId) {
            document.getElementById(dropdownId).classList.add('show');
            populateUserDropdown(inputId, dropdownId);
        }

        // Fungsi untuk menyembunyikan dropdown dengan delay
        function hideUserDropdownDelayed(dropdownId) {
            setTimeout(() => {
                document.getElementById(dropdownId).classList.remove('show');
            }, 200);
        }

        // Fungsi untuk mengisi dropdown dengan filtering
        function populateUserDropdown(inputId, dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            const searchTerm = document.getElementById(inputId).value.toLowerCase();

            // Filter users berdasarkan pencarian
            const filteredUsers = allUsers.filter(user =>
                user.name.toLowerCase().includes(searchTerm)
            );

            dropdown.innerHTML = '';

            if (filteredUsers.length === 0) {
                dropdown.innerHTML = '<div class="no-options">🔍 Tidak ada user ditemukan</div>';
                return;
            }

            // Buat option untuk setiap user
            filteredUsers.forEach(user => {
                const option = document.createElement('div');
                option.className = 'dropdown-option';

                // Tambahkan avatar dan nama
                const avatar = document.createElement('div');
                avatar.className = 'user-avatar';
                avatar.textContent = user.name.charAt(0).toUpperCase();

                const nameSpan = document.createElement('span');
                nameSpan.textContent = user.name;

                option.appendChild(avatar);
                option.appendChild(nameSpan);

                // Handle click
                option.onclick = () => selectUser(user.id, user.name, inputId, dropdownId);

                dropdown.appendChild(option);
            });
        }

        // Fungsi untuk memilih user
        function selectUser(id, name, inputId, dropdownId) {
            const input = document.getElementById(inputId);
            const hiddenInputId = 'selectedUserId' + inputId.replace('searchableUserInput', '');
            const hiddenInput = document.getElementById(hiddenInputId);

            // Set values
            input.value = name;
            input.classList.add('has-value');
            hiddenInput.value = id;

            // Hide dropdown
            document.getElementById(dropdownId).classList.remove('show');
        }

        // Fungsi untuk memfilter options saat mengetik
        function filterUserOptions(inputId, dropdownId, hiddenInputId) {
            const input = document.getElementById(inputId);
            const hiddenInput = document.getElementById(hiddenInputId);

            // Reset selection jika user mengubah input
            if (input.value !== input.dataset.selectedName) {
                hiddenInput.value = '';
                input.classList.remove('has-value');
            }

            populateUserDropdown(inputId, dropdownId);
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const searchableSelects = document.querySelectorAll('.searchable-select');

            searchableSelects.forEach(select => {
                if (!select.contains(event.target)) {
                    const dropdownId = select.querySelector('.dropdown-options').id;
                    document.getElementById(dropdownId).classList.remove('show');
                }
            });
        });
    </script>

    <!-- JS Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#userSelect').select2({
                placeholder: "Ketik nama user...",
                allowClear: true,
                minimumInputLength: 1, // option muncul setelah ketik minimal 1 huruf
                width: '100%',
                language: {
                    inputTooShort: function() {
                        return "Ketik minimal 1 huruf untuk mencari...";
                    },
                    noResults: function() {
                        return "User tidak ditemukan";
                    }
                }
            });

            // Biar select2 tampilannya selaras sama rounded form
            $('.select2-container--default .select2-selection--single').css({
                'height': '48px',
                'border-radius': '0.75rem',
                'border': '2px solid #e5e7eb', // tailwind gray-200
                'padding': '8px 12px'
            });
        });
    </script>

    <style>
        /* CSS untuk Searchable Select */
        .searchable-select {
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 14px;
            outline: none;
            transition: all 0.2s;
            background: white;
        }

        .search-input:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 2px #bbf7d0;
        }

        .search-input.has-value {
            color: #374151;
            font-weight: 500;
        }

        .dropdown-options {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 2px solid #e5e7eb;
            border-top: none;
            border-radius: 0 0 12px 12px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .dropdown-options.show {
            display: block;
        }

        .dropdown-option {
            padding: 12px;
            cursor: pointer;
            transition: all 0.2s;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            align-items: center;
        }

        .dropdown-option:hover {
            background-color: #f9fafb;
            transform: translateX(2px);
        }

        .dropdown-option.selected {
            background-color: #10b981;
            color: white;
        }

        .dropdown-option:last-child {
            border-bottom: none;
        }

        .no-options {
            padding: 12px;
            color: #6b7280;
            font-style: italic;
            text-align: center;
        }

        .user-avatar {
            width: 24px;
            height: 24px;
            background: #10b981;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 10px;
            font-weight: bold;
            margin-right: 8px;
        }

        /* Loading state */
        .search-input.loading {
            background-image: url("data:image/svg+xml,%3csvg width='20' height='20' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M10 3V6M10 14V17M17 10H14M6 10H3M15.364 4.636L13.243 6.757M6.757 13.243L4.636 15.364M15.364 15.364L13.243 13.243M6.757 6.757L4.636 4.636' stroke='%2310b981' stroke-width='2' stroke-linecap='round'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 20px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive */
        @media (max-width: 640px) {
            .dropdown-options {
                max-height: 150px;
            }
        }
    </style>
</x-app-layout>
