<x-nasabah-layout>
<div class="min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 mt-10">
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Daftar Harga Sampah</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Temukan harga terbaru untuk berbagai jenis sampah yang dapat didaur ulang</p>
            <div class="w-24 h-1 bg-gradient-to-r from-green-500 to-emerald-600 mx-auto mt-4 rounded-full"></div>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($sampah as $item)
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-green-100 overflow-hidden">
                <!-- Image Container -->
                <div class="relative overflow-hidden">
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" 
                             class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300" 
                             alt="{{ $item->nama }}">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" 
                             class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300" 
                             alt="Default Image">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Price Badge -->
                    <div class="absolute top-4 right-4">
                        <span class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                            {{ $item->satuan }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-green-600 transition-colors duration-300">
                        {{ $item->nama }}
                    </h2>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-sm text-gray-500 font-medium">Harga</span>
                        </div>
                    </div>
                    
                    <div class="mt-4 p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-100">
                        <div class="flex items-center justify-center">
                            <span class="text-2xl font-bold text-green-600">
                                Rp {{ number_format($item->harga_kg, 0, ',', '.') }}
                            </span>
                            <span class="text-gray-500 ml-2 font-medium">
                                /{{ $item->satuan }}
                            </span>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <button class="w-full mt-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 px-4 rounded-xl font-semibold 
                                 hover:from-green-600 hover:to-emerald-700 transform hover:scale-105 transition-all duration-300 
                                 shadow-md hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-green-200">
                        <div class="flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Detail Harga</span>
                        </div>
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if($sampah->isEmpty())
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Data Sampah</h3>
            <p class="text-gray-500">Data harga sampah akan muncul di sini setelah ditambahkan.</p>
        </div>
        @endif

        <!-- Info Footer -->
        <div class="mt-16 bg-white rounded-2xl shadow-lg border border-green-100 p-8">
            <div class="grid md:grid-cols-3 gap-6 text-center">
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-1">Harga Terjamin</h4>
                    <p class="text-sm text-gray-600">Harga yang kompetitif dan transparan untuk semua jenis sampah</p>
                </div>
                
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-1">Update Harian</h4>
                    <p class="text-sm text-gray-600">Harga diperbarui secara berkala sesuai kondisi pasar</p>
                </div>
                
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-1">Ramah Lingkungan</h4>
                    <p class="text-sm text-gray-600">Berkontribusi dalam menjaga kelestarian lingkungan</p>
                </div>
            </div>
        </div>
    </div>
</div>
</x-nasabah-layout>