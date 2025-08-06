<x-nasabah-layout>

<div class="min-h-screen bg-gray-50 py-12">
    <div class="p-4 md:p-8">
        <div class="max-w-4xl mx-auto">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Edit Profil Nasabah Bank Sampah</h1>
                <p class="text-gray-500 text-sm mt-1">Perbarui informasi akun Anda untuk memantau setoran, saldo, dan riwayat transaksi</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <!-- Profile Form -->
                <form method="POST" action="{{ route('nasabah.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div>
                            <!-- Identitas Nasabah -->
                            <div class="mb-6">
                                <h2 class="text-lg font-semibold mb-4 text-gray-800 border-b pb-2">Identitas Nasabah</h2>
                                <div class="flex items-center gap-4">
                                    <div class="w-24 h-24 rounded-full bg-green-100 flex items-center justify-center">
                                        <span class="text-3xl font-semibold text-green-600 uppercase">
                                            {{ substr(auth()->user()->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-700">Nama: {{ auth()->user()->name }}</p>
                                        <p class="text-xs text-gray-500 mt-1">ID Nasabah: {{ auth()->user()->id }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Nasabah -->
                            <div class="mb-6">
                                <h2 class="text-lg font-semibold mb-4 text-gray-800 border-b pb-2">Status Akun</h2>
                                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 8.293a1 1 0 101.414 1.414l2 2a1 1 0 001.414-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="font-medium">Akun Nasabah Aktif</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-2">Akun siap digunakan untuk setor dan tarik saldo Bank Sampah</p>
                                    <p class="text-sm text-gray-600 mt-1">Terdaftar sejak: {{ auth()->user()->created_at->format('d F Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div>
                            <h2 class="text-lg font-semibold mb-4 text-gray-800 border-b pb-2">Informasi Akun</h2>

                            <div class="space-y-4">
                                <!-- Nama -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('name') border-red-500 @enderror">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('email') border-red-500 @enderror">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                                    <div class="relative">
                                        <input type="password" id="password" name="password"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 pr-10 @error('password') border-red-500 @enderror"
                                            placeholder="Masukkan password baru">
                                        <button type="button" class="absolute right-3 top-2.5 text-gray-500 hover:text-gray-700 toggle-password">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Konfirmasi Password -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                                    <div class="relative">
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 pr-10"
                                            placeholder="Konfirmasi password baru">
                                        <button type="button" class="absolute right-3 top-2.5 text-gray-500 hover:text-gray-700 toggle-password">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8">
                                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 px-6 rounded-lg transition-colors duration-200">
                                    Simpan Perubahan Profil
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tips Section -->
            <div class="mt-6 bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold mb-4 text-gray-800 border-b pb-2">Tips Penggunaan Akun Nasabah</h2>
                <div class="space-y-3">
                    @foreach([
                        'Pastikan informasi akun Anda selalu benar dan terbaru.',
                        'Gunakan password yang kuat dan ganti secara berkala.',
                        'Cek saldo dan riwayat transaksi secara rutin.',
                        'Lakukan setor sampah secara konsisten agar saldo bertambah.'
                    ] as $tip)
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-gray-700">{{ $tip }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
            const input = this.closest('.relative').querySelector('input');
            input.type = input.type === 'password' ? 'text' : 'password';
        });
    });
});
</script>
</x-nasabah-layout>
