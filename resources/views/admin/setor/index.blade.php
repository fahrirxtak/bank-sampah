<x-app-layout>
    <x-slot name="header">
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
                                    <i class="fas fa-user mr-2 text-green-600"></i>
                                    User yang Setor <span class="text-red-500 ml-1">*</span>
                                </label>
                                <select name="user_id"
                                    class="w-full rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 p-3"
                                    required>
                                    <option value="">Pilih User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
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
                            <select name="user_id"
                                class="w-full rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 p-3"
                                required>
                                <option value="">Pilih User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
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

            <!-- Form Tarik Tunai -->
            <div id="formTarikTunai" class="form-container hidden animate-fade-in">
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-500 to-violet-600 px-8 py-6 text-white">
                        <h3 class="text-xl font-bold flex items-center">
                            <i class="fas fa-money-bill-wave mr-3 text-2xl"></i>
                            Form Tarik Tunai
                        </h3>
                        <p class="text-purple-100 mt-2">Tarik saldo dari rekening bank sampah Anda</p>
                    </div>

                    <form action="" method="POST" class="p-8 space-y-6">
                        @csrf
                        <input type="hidden" name="jenis_transaksi" value="tarik_tunai">
                        <div class="space-y-3">
                            <label class="flex items-center text-sm font-semibold text-gray-700">
                                <i class="fas fa-user mr-2 text-blue-600"></i>
                                User yang Setor <span class="text-red-500 ml-1">*</span>
                            </label>
                            <select name="user_id"
                                class="w-full rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 p-3"
                                required>
                                <option value="">Pilih User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" data-saldo="{{ $user->saldo }}">
                                        {{ $user->name }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
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

                        </div>

                        <!-- Info Penarikan -->
                        <div
                            class="bg-gradient-to-r from-purple-50 to-violet-50 p-6 rounded-xl border border-purple-200">
                            <h4 class="font-semibold text-purple-800 mb-3">Informasi Penarikan</h4>
                            <div class="space-y-2 text-sm text-gray-700">
                                <p>• Penarikan tunai: Datang ke bank sampah dengan membawa KTP</p>
                                <p>• Transfer bank: Sertakan nomor rekening di catatan</p>
                                <p>• Proses: 1-2 hari kerja setelah disetujui admin</p>
                                <p>• Biaya admin transfer: Rp 2.500</p>
                            </div>
                        </div>

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

            <div  id="formKonfirmasiTarikTunai" class="form-container min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 py-8 hidden">
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
                        <div class="flex flex-col sm:flex-row gap-4 mb-6">
                            <select
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                <option value="">Semua Transaksi</option>
                                <option value="setor_sampah">Setor Sampah</option>
                                <option value="setor_tunai">Setor Tunai</option>
                                <option value="tarik_tunai">Tarik Tunai</option>
                            </select>
                            <select
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                <option value="">Semua Status</option>
                                <option value="pending">Menunggu</option>
                                <option value="approved">Disetujui</option>
                                <option value="rejected">Ditolak</option>
                            </select>
                            <input type="search" placeholder="Cari transaksi..."
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 flex-1">
                        </div>

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
                                            Jenis</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Detail</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jumlah</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" id="transactionTableBody">
                                    @forelse($transaksi as $item)
                                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $item->created_at->format('d M Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($item->jenis_transaksi == 'setor_sampah')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <i class="fas fa-recycle mr-1"></i>
                                                        Setor Sampah
                                                    </span>
                                                @elseif($item->jenis_transaksi == 'setor_tunai')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        <i class="fas fa-coins mr-1"></i>
                                                        Setor Tunai
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                        <i class="fas fa-money-bill-wave mr-1"></i>
                                                        Tarik Tunai
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                @if ($item->jenis_transaksi == 'setor_sampah')
                                                    <div class="font-medium">
                                                        {{ $item->sampah->nama ?? 'Jenis Sampah' }}</div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ number_format($item->berat, 2) }} kg ×
                                                        Rp{{ number_format($item->harga_per_kg, 0, ',', '.') }}
                                                    </div>
                                                @else
                                                    <div class="font-medium">
                                                        {{ $item->catatan ?? ($item->jenis_transaksi == 'setor_tunai' ? 'Setoran Tunai' : 'Penarikan Tunai') }}
                                                    </div>
                                                    @if ($item->jenis_transaksi == 'tarik_tunai' && $item->metode_penarikan)
                                                        <div class="text-xs text-gray-500">
                                                            Metode:
                                                            {{ $item->metode_penarikan == 'tunai' ? 'Ambil di Lokasi' : 'Transfer Bank' }}
                                                        </div>
                                                    @endif
                                                @endif
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm font-semibold
                                            @if (in_array($item->jenis_transaksi, ['setor_sampah', 'setor_tunai'])) text-green-600 @else text-red-600 @endif">
                                                @if (in_array($item->jenis_transaksi, ['setor_sampah', 'setor_tunai']))
                                                    <span class="inline-flex items-center">
                                                        <i class="fas fa-arrow-up mr-1"></i>
                                                        +
                                                        Rp{{ number_format($item->jenis_transaksi == 'setor_sampah' ? $item->total_harga : $item->jumlah_uang, 0, ',', '.') }}
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center">
                                                        <i class="fas fa-arrow-down mr-1"></i>
                                                        - Rp{{ number_format($item->jumlah_uang, 0, ',', '.') }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($item->status == 'approved')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <i class="fas fa-check-circle mr-1"></i>
                                                        Disetujui
                                                    </span>
                                                    @if ($item->admin)
                                                        <div class="text-xs text-gray-500 mt-1">Oleh:
                                                            {{ $item->admin->name }}</div>
                                                    @endif
                                                @elseif($item->status == 'rejected')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        <i class="fas fa-times-circle mr-1"></i>
                                                        Ditolak
                                                    </span>
                                                    @if ($item->alasan_tolak)
                                                        <div class="text-xs text-gray-500 mt-1">
                                                            {{ $item->alasan_tolak }}</div>
                                                    @endif
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <i class="fas fa-clock mr-1"></i>
                                                        Menunggu
                                                    </span>
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
                        <div class="md:hidden space-y-4" id="transactionCards">
                            <!-- Cards akan diisi oleh JavaScript -->
                        </div>

                        <!-- Pagination -->
                        @if ($transaksi->hasPages())
                            <div class="mt-6 flex items-center justify-between">
                                <div class="text-sm text-gray-700">
                                    Menampilkan <span class="font-medium">{{ $transaksi->firstItem() }}</span> sampai
                                    <span class="font-medium">{{ $transaksi->lastItem() }}</span> dari
                                    <span class="font-medium">{{ $transaksi->total() }}</span> transaksi
                                </div>
                                <div class="flex space-x-1">
                                    {{ $transaksi->links() }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function showPasswordModal() {
            // Ambil nilai dari form utama
            const userId = document.querySelector('select[name="user_id"]').value;
            const jumlah = document.querySelector('input[name="jumlah_uang"]').value;
            const catatan = document.querySelector('textarea[name="catatan"]').value;

            // Masukkan ke input hidden di modal
            document.getElementById('user_id_hidden').value = userId;
            document.getElementById('jumlah_uang_hidden').value = jumlah;
            document.getElementById('catatan_hidden').value = catatan;

            // Tampilkan modal
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
    </script>
</x-app-layout>
