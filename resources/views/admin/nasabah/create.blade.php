
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-blue-100 p-2 rounded-lg">
                    <i class="fas fa-user-plus text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                        @section('title', 'Tambah Nasabah')
                    </h2>
                    <p class="text-sm text-gray-600">Tambahkan nasabah baru ke sistem bank sampah</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.nasabah.index') }}"
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
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-6 py-4 rounded-lg flex items-center space-x-3 animate-fade-in">
                    <i class="fas fa-check-circle text-green-600 text-lg"></i>
                    <div>
                        <p class="font-medium">Berhasil!</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-200 text-red-700 px-6 py-4 rounded-lg flex items-center space-x-3 animate-fade-in">
                    <i class="fas fa-exclamation-circle text-red-600 text-lg"></i>
                    <div>
                        <p class="font-medium">Terjadi Kesalahan!</p>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <!-- Main Form Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-blue-50 to-green-50 px-8 py-6 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-user-plus text-blue-600 text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">Form Tambah Nasabah</h3>
                            <p class="text-sm text-gray-600">Lengkapi data nasabah dengan benar</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <form action="{{ route('admin.nasabah.store') }}" method="POST" class="p-8" id="createNasabahForm">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Column - Personal Info -->
                        <div class="space-y-6">
                            <div class="border-b border-gray-200 pb-4">
                                <h4 class="text-lg font-medium text-gray-800 flex items-center">
                                    <i class="fas fa-user text-blue-600 mr-2"></i>
                                    Informasi Personal
                                </h4>
                                <p class="text-sm text-gray-600 mt-1">Data pribadi nasabah</p>
                            </div>

                            <!-- Name Field -->
                            <div class="space-y-2">
                                <label for="name" class="block text-sm font-semibold text-gray-700">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                    <input type="text"
                                           id="name"
                                           name="name"
                                           value="{{ old('name') }}"
                                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('name') border-red-500 @enderror"
                                           placeholder="Masukkan nama lengkap"
                                           required>
                                </div>
                                @error('name')
                                    <p class="text-sm text-red-600 flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-semibold text-gray-700">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-envelope text-gray-400"></i>
                                    </div>
                                    <input type="email"
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('email') border-red-500 @enderror"
                                           placeholder="contoh@email.com"
                                           required>
                                </div>
                                @error('email')
                                    <p class="text-sm text-red-600 flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Address Field -->
                            <div class="space-y-2">
                                <label for="alamat" class="block text-sm font-semibold text-gray-700">
                                    Alamat
                                </label>
                                <div class="relative">
                                    <div class="absolute top-3 left-3 pointer-events-none">
                                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                                    </div>
                                    <textarea id="alamat"
                                              name="alamat"
                                              rows="4"
                                              class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors resize-none @error('alamat') border-red-500 @enderror"
                                              placeholder="Masukkan alamat lengkap (opsional)">{{ old('alamat') }}</textarea>
                                </div>
                                @error('alamat')
                                    <p class="text-sm text-red-600 flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column - Account Info -->
                        <div class="space-y-6">
                            <div class="border-b border-gray-200 pb-4">
                                <h4 class="text-lg font-medium text-gray-800 flex items-center">
                                    <i class="fas fa-cog text-green-600 mr-2"></i>
                                    Informasi Akun
                                </h4>
                                <p class="text-sm text-gray-600 mt-1">Data login dan pengaturan akun</p>
                            </div>

                            <!-- Password Field -->
                            <div class="space-y-2">
                                <label for="password" class="block text-sm font-semibold text-gray-700">
                                    Password <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input type="password"
                                           id="password"
                                           name="password"
                                           class="block w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('password') border-red-500 @enderror"
                                           placeholder="Minimal 8 karakter"
                                           required>
                                    <button type="button"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                            onclick="togglePassword('password')">
                                        <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="password-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="text-sm text-red-600 flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                                <div class="text-xs text-gray-500 mt-1">
                                    <p>Password harus mengandung minimal 8 karakter</p>
                                </div>
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="space-y-2">
                                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">
                                    Konfirmasi Password <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input type="password"
                                           id="password_confirmation"
                                           name="password_confirmation"
                                           class="block w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('password_confirmation') border-red-500 @enderror"
                                           placeholder="Ulangi password"
                                           required>
                                    <button type="button"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                            onclick="togglePassword('password_confirmation')">
                                        <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="password_confirmation-eye"></i>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <p class="text-sm text-red-600 flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Initial Balance Field -->
                            <div class="space-y-2">
                                <label for="saldo" class="block text-sm font-semibold text-gray-700">
                                    Saldo Awal
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 text-sm">Rp</span>
                                    </div>
                                    <input type="number"
                                           id="saldo"
                                           name="saldo"
                                           value="{{ old('saldo', '0') }}"
                                           min="0"
                                           step="0.01"
                                           class="block w-full pl-12 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('saldo') border-red-500 @enderror"
                                           placeholder="0">
                                </div>
                                @error('saldo')
                                    <p class="text-sm text-red-600 flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                                <div class="text-xs text-gray-500 mt-1">
                                    <p>Kosongkan atau isi 0 jika tidak ada saldo awal</p>
                                </div>
                            </div>

                            <!-- Status Field -->
                            <div class="space-y-2">
                                <label for="status" class="block text-sm font-semibold text-gray-700">
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <div class="grid grid-cols-2 gap-3">
                                    <label class="relative flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio"
                                               name="status"
                                               value="active"
                                               class="sr-only peer"
                                               {{ old('status', 'active') == 'active' ? 'checked' : '' }}
                                               required>
                                        <div class="absolute inset-0 border-2 border-transparent peer-checked:border-green-500 peer-checked:bg-green-50 rounded-lg transition-all"></div>
                                        <div class="relative flex items-center space-x-2">
                                            <div class="w-4 h-4 bg-green-100 rounded-full flex items-center justify-center peer-checked:bg-green-500">
                                                <i class="fas fa-check text-green-600 text-xs peer-checked:text-white"></i>
                                            </div>
                                            <span class="text-sm font-medium text-gray-700">Aktif</span>
                                        </div>
                                    </label>

                                    <label class="relative flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio"
                                               name="status"
                                               value="inactive"
                                               class="sr-only peer"
                                               {{ old('status') == 'inactive' ? 'checked' : '' }}>
                                        <div class="absolute inset-0 border-2 border-transparent peer-checked:border-red-500 peer-checked:bg-red-50 rounded-lg transition-all"></div>
                                        <div class="relative flex items-center space-x-2">
                                            <div class="w-4 h-4 bg-red-100 rounded-full flex items-center justify-center peer-checked:bg-red-500">
                                                <i class="fas fa-times text-red-600 text-xs peer-checked:text-white"></i>
                                            </div>
                                            <span class="text-sm font-medium text-gray-700">Tidak Aktif</span>
                                        </div>
                                    </label>
                                </div>
                                @error('status')
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
                                        class="px-8 py-3 bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 text-white rounded-lg font-medium transition-all duration-200 flex items-center justify-center space-x-2 shadow-lg hover:shadow-xl transform hover:scale-105">
                                    <i class="fas fa-plus-circle"></i>
                                    <span>Tambah Nasabah</span>
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

        // Toggle password visibility
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(fieldId + '-eye');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

        // Reset form
        function resetForm() {
            if (confirm('Apakah Anda yakin ingin mereset form? Data yang sudah diisi akan hilang.')) {
                document.getElementById('createNasabahForm').reset();
                // Reset radio button to default (active)
                document.querySelector('input[name="status"][value="active"]').checked = true;
            }
        }

        // Form validation
        document.getElementById('createNasabahForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak cocok!');
                return false;
            }

            if (password.length < 8) {
                e.preventDefault();
                alert('Password minimal 8 karakter!');
                return false;
            }
        });

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

        // Format saldo input
        document.getElementById('saldo').addEventListener('input', function(e) {
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
        input, textarea, button {
            transition: all 0.2s ease-in-out;
        }

        /* Focus states */
        input:focus, textarea:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Loading state for submit button */
        button[type="submit"]:active {
            transform: scale(0.98);
        }
    </style>
</x-app-layout>
