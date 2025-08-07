<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-green-100 p-2 rounded-lg">
                    <i class="fas fa-trash-alt text-green-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                        @section('title', 'Tambah Sampah')
                    </h2>
                    <p class="text-sm text-gray-600">Tambahkan jenis sampah baru ke sistem</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.sampah.index') }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center space-x-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
                <div class="text-gray-600 text-sm bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100">
                    <i class="fas fa-calendar-alt mr-2 text-green-600"></i>
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
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-8 py-6 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-trash-alt text-green-600 text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">Form Tambah Sampah</h3>
                            <p class="text-sm text-gray-600">Lengkapi data jenis sampah dengan benar</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <form action="{{ route('admin.sampah.store') }}" method="POST" class="p-8" id="createSampahForm">
                    @csrf

                    <div class="grid grid-cols-1 gap-8">
                        <!-- Waste Information -->
                        <div class="space-y-6">
                            <div class="border-b border-gray-200 pb-4">
                                <h4 class="text-lg font-medium text-gray-800 flex items-center">
                                    <i class="fas fa-info-circle text-green-600 mr-2"></i>
                                    Informasi Sampah
                                </h4>
                                <p class="text-sm text-gray-600 mt-1">Data dasar jenis sampah</p>
                            </div>

                            <!-- Name Field -->
                            <div class="space-y-2">
                                <label for="nama" class="block text-sm font-semibold text-gray-700">
                                    Nama Sampah <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-trash-alt text-gray-400"></i>
                                    </div>
                                    <input type="text"
                                           id="nama"
                                           name="nama"
                                           value="{{ old('nama') }}"
                                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-colors @error('nama') border-red-500 @enderror"
                                           placeholder="Masukkan nama jenis sampah"
                                           required>
                                </div>
                                @error('nama')
                                    <p class="text-sm text-red-600 flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Price Field -->
                            <div class="space-y-2">
                                <label for="harga_kg" class="block text-sm font-semibold text-gray-700">
                                    Harga per Kilogram <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 text-sm">Rp</span>
                                    </div>
                                    <input type="number"
                                           id="harga_kg"
                                           name="harga_kg"
                                           value="{{ old('harga_kg') }}"
                                           min="0"
                                           step="0.01"
                                           class="block w-full pl-12 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-colors @error('harga_kg') border-red-500 @enderror"
                                           placeholder="0"
                                           required>
                                </div>
                                @error('harga_kg')
                                    <p class="text-sm text-red-600 flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Unit Field -->
                            <div class="space-y-2">
                                <label for="satuan" class="block text-sm font-semibold text-gray-700">
                                    Satuan <span class="text-red-500">*</span>
                                </label>
                                <div class="grid grid-cols-3 gap-3">
                                    <label class="relative flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio"
                                               name="satuan"
                                               value="kg"
                                               class="sr-only peer"
                                               {{ old('satuan', 'kg') == 'kg' ? 'checked' : '' }}
                                               required>
                                        <div class="absolute inset-0 border-2 border-transparent peer-checked:border-green-500 peer-checked:bg-green-50 rounded-lg transition-all"></div>
                                        <div class="relative flex items-center space-x-2">
                                            <div class="w-4 h-4 bg-green-100 rounded-full flex items-center justify-center peer-checked:bg-green-500">
                                                <i class="fas fa-check text-green-600 text-xs peer-checked:text-white"></i>
                                            </div>
                                            <span class="text-sm font-medium text-gray-700">Kilogram</span>
                                        </div>
                                    </label>

                                    <label class="relative flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio"
                                               name="satuan"
                                               value="liter"
                                               class="sr-only peer"
                                               {{ old('satuan') == 'liter' ? 'checked' : '' }}>
                                        <div class="absolute inset-0 border-2 border-transparent peer-checked:border-emerald-500 peer-checked:bg-emerald-50 rounded-lg transition-all"></div>
                                        <div class="relative flex items-center space-x-2">
                                            <div class="w-4 h-4 bg-emerald-100 rounded-full flex items-center justify-center peer-checked:bg-emerald-500">
                                                <i class="fas fa-check text-emerald-600 text-xs peer-checked:text-white"></i>
                                            </div>
                                            <span class="text-sm font-medium text-gray-700">Liter</span>
                                        </div>
                                    </label>

                                    <label class="relative flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio"
                                               name="satuan"
                                               value="buah"
                                               class="sr-only peer"
                                               {{ old('satuan') == 'buah' ? 'checked' : '' }}>
                                        <div class="absolute inset-0 border-2 border-transparent peer-checked:border-lime-500 peer-checked:bg-lime-50 rounded-lg transition-all"></div>
                                        <div class="relative flex items-center space-x-2">
                                            <div class="w-4 h-4 bg-lime-100 rounded-full flex items-center justify-center peer-checked:bg-lime-500">
                                                <i class="fas fa-check text-lime-600 text-xs peer-checked:text-white"></i>
                                            </div>
                                            <span class="text-sm font-medium text-gray-700">Buah</span>
                                        </div>
                                    </label>
                                </div>
                                @error('satuan')
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
                                <i class="fas fa-info-circle text-green-500 mr-2"></i>
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
                                        class="px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white rounded-lg font-medium transition-all duration-200 flex items-center justify-center space-x-2 shadow-lg hover:shadow-xl transform hover:scale-105">
                                    <i class="fas fa-plus-circle"></i>
                                    <span>Tambah Sampah</span>
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
                document.getElementById('createSampahForm').reset();
                // Reset radio button to default (kg)
                document.querySelector('input[name="satuan"][value="kg"]').checked = true;
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

        // Format harga input
        document.getElementById('harga_kg').addEventListener('input', function(e) {
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
        input, button {
            transition: all 0.2s ease-in-out;
        }

        /* Focus states */
        input:focus {
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        /* Loading state for submit button */
        button[type="submit"]:active {
            transform: scale(0.98);
        }
    </style>
</x-app-layout>
