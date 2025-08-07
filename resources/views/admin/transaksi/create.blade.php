<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-blue-100 p-2 rounded-lg">
                    <i class="fas fa-exchange-alt text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                        @section('title', 'Tambah Transaksi')
                    </h2>
                    <p class="text-sm text-gray-600">Tambahkan transaksi operasional baru</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.transaksi.index') }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center space-x-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
                <div class="text-gray-600 text-sm bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100">
                    <i class="fas fa-calendar-alt mr-2 text-blue-600"></i>
                    <span id="currentDate" class="font-medium"></span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-16">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Main Form Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-8 py-6 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-exchange-alt text-blue-600 text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">Form Tambah Transaksi</h3>
                            <p class="text-sm text-gray-600">Lengkapi data transaksi operasional</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <form action="{{ route('admin.transaksi.store') }}" method="POST" class="p-8" id="createTransaksiForm">
                    @csrf

                    <div class="grid grid-cols-1 gap-8">
                        <!-- Transaction Information -->
                        <div class="space-y-6">
                            <div class="border-b border-gray-200 pb-4">
                                <h4 class="text-lg font-medium text-gray-800 flex items-center">
                                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                                    Informasi Transaksi
                                </h4>
                                <p class="text-sm text-gray-600 mt-1">Data dasar transaksi operasional</p>
                            </div>

                            <!-- Transaction Type -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">
                                    Jenis Transaksi <span class="text-red-500">*</span>
                                </label>
                                <div class="grid grid-cols-2 gap-3">
                                    <label class="relative flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50 transition-colors">
                                        <input type="radio"
                                               name="tipe"
                                               value="pemasukan"
                                               class="sr-only peer"
                                               {{ old('tipe') == 'pemasukan' ? 'checked' : '' }}
                                               required>
                                        <div class="absolute inset-0 border-2 border-transparent peer-checked:border-green-500 peer-checked:bg-green-50 rounded-lg transition-all"></div>
                                        <div class="relative flex items-center space-x-2">
                                            <div class="w-4 h-4 bg-green-100 rounded-full flex items-center justify-center peer-checked:bg-green-500">
                                                <i class="fas fa-check text-green-600 text-xs peer-checked:text-white"></i>
                                            </div>
                                            <span class="text-sm font-medium text-gray-700">Pemasukan</span>
                                        </div>
                                    </label>

                                    <label class="relative flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-red-50 transition-colors">
                                        <input type="radio"
                                               name="tipe"
                                               value="pengeluaran"
                                               class="sr-only peer"
                                               {{ old('tipe') == 'pengeluaran' ? 'checked' : '' }}>
                                        <div class="absolute inset-0 border-2 border-transparent peer-checked:border-red-500 peer-checked:bg-red-50 rounded-lg transition-all"></div>
                                        <div class="relative flex items-center space-x-2">
                                            <div class="w-4 h-4 bg-red-100 rounded-full flex items-center justify-center peer-checked:bg-red-500">
                                                <i class="fas fa-check text-red-600 text-xs peer-checked:text-white"></i>
                                            </div>
                                            <span class="text-sm font-medium text-gray-700">Pengeluaran</span>
                                        </div>
                                    </label>
                                </div>
                                @error('tipe')
                                    <p class="text-sm text-red-600 flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Description Field -->
                            <div class="space-y-2">
                                <label for="keterangan" class="block text-sm font-semibold text-gray-700">
                                    Keterangan <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-align-left text-gray-400"></i>
                                    </div>
                                    <input type="text"
                                           id="keterangan"
                                           name="keterangan"
                                           value="{{ old('keterangan') }}"
                                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('keterangan') border-red-500 @enderror"
                                           placeholder="Masukkan keterangan transaksi"
                                           required>
                                </div>
                                @error('keterangan')
                                    <p class="text-sm text-red-600 flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Amount Field -->
                            <div class="space-y-2">
                                <label for="jumlah" class="block text-sm font-semibold text-gray-700">
                                    Jumlah (Rp) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 text-sm">Rp</span>
                                    </div>
                                    <input type="number"
                                           id="jumlah"
                                           name="jumlah"
                                           value="{{ old('jumlah') }}"
                                           min="0"
                                           step="0.01"
                                           class="block w-full pl-12 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('jumlah') border-red-500 @enderror"
                                           placeholder="0"
                                           required>
                                </div>
                                @error('jumlah')
                                    <p class="text-sm text-red-600 flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Date Field -->
                            <div class="space-y-2">
                                <label for="tanggal" class="block text-sm font-semibold text-gray-700">
                                    Tanggal <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-calendar text-gray-400"></i>
                                    </div>
                                    <input type="date"
                                           id="tanggal"
                                           name="tanggal"
                                           value="{{ old('tanggal', date('Y-m-d')) }}"
                                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('tanggal') border-red-500 @enderror"
                                           required>
                                </div>
                                @error('tanggal')
                                    <p class="text-sm text-red-600 flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Admin Field -->
                            <div class="space-y-2">
                                <label for="admin_id" class="block text-sm font-semibold text-gray-700">
                                    Admin Penanggung Jawab <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user-shield text-gray-400"></i>
                                    </div>
                                    <select id="admin_id"
                                            name="admin_id"
                                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('admin_id') border-red-500 @enderror"
                                            required>
                                        <option value="">Pilih Admin</option>
                                        @foreach($admins as $admin)
                                            <option value="{{ $admin->id }}" {{ old('admin_id') == $admin->id ? 'selected' : '' }}>
                                                {{ $admin->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('admin_id')
                                    <p class="text-sm text-red-600 flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-10 pt-6 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="text-sm text-gray-600 flex items-center">
                                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                <span>Fields dengan <span class="text-red-500">*</span> wajib diisi</span>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-3">
                                <button type="button"
                                        onclick="resetForm()"
                                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors duration-200 flex items-center justify-center space-x-2">
                                    <i class="fas fa-undo"></i>
                                    <span>Reset</span>
                                </button>

                                <button type="submit"
                                        class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-lg font-medium transition-all duration-200 flex items-center justify-center space-x-2 shadow-lg hover:shadow-xl transform hover:scale-105">
                                    <i class="fas fa-plus-circle"></i>
                                    <span>Tambah Transaksi</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
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

        // Reset form
        function resetForm() {
            if (confirm('Apakah Anda yakin ingin mereset form? Data yang sudah diisi akan hilang.')) {
                document.getElementById('createTransaksiForm').reset();
                // Set default date to today
                document.getElementById('tanggal').value = new Date().toISOString().split('T')[0];
            }
        }

        // Auto-hide alerts after 5 seconds
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

        // Format amount input
        document.getElementById('jumlah').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^\d.]/g, '');
            if (value.includes('.')) {
                const parts = value.split('.');
                if (parts[1] && parts[1].length > 2) {
                    parts[1] = parts[1].substring(0, 2);
                    value = parts.join('.');
                }
            }
            e.target.value = value;
        });

        // Animate form elements on load
        document.addEventListener('DOMContentLoaded', function() {
            const formElements = document.querySelectorAll('.space-y-6 > div');
            formElements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    element.style.transition = 'all 0.5s ease-out';
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        /* Custom radio button styling */
        input[type="radio"]:checked + .absolute {
            border-color: currentColor;
        }

        /* Smooth transitions */
        input, button, select {
            transition: all 0.2s ease-in-out;
        }

        /* Focus states */
        input:focus, select:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Loading state for submit button */
        button[type="submit"]:active {
            transform: scale(0.98);
        }
    </style>
</x-app-layout>
