<x-nasabah-layout>

<div class="min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50">
    <div class="container mx-auto px-4 py-8">


        <!-- Main Balance Card -->
        <div class="max-w-4xl mx-auto mt-4" >
            <div class="bg-white rounded-3xl shadow-2xl border border-green-100 overflow-hidden mb-8">
                <!-- Card Header with Gradient -->
                <div class="bg-gradient-to-r from-green-500 via-emerald-600 to-teal-600 p-8 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 transform translate-x-16 -translate-y-8">
                        <div class="w-32 h-32 bg-white/10 rounded-full"></div>
                    </div>
                    <div class="absolute bottom-0 left-0 transform -translate-x-16 translate-y-8">
                        <div class="w-24 h-24 bg-white/10 rounded-full"></div>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-2xl font-bold mb-2">Saldo</h3>
                                <p class="text-green-100">Dashboard Saldo Nasabah</p>
                            </div>
                            <div class="bg-white/20 backdrop-blur-sm rounded-full p-3">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Information -->
                <div class="p-8">
                    <div class="grid md:grid-cols-2 gap-6 mb-8">
                        <!-- Name Info -->
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-500 mb-1">Nama Lengkap</p>
                                <p class="text-lg font-semibold text-gray-800">{{ $user->name }}</p>
                            </div>
                        </div>

                        <!-- Email Info -->
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-500 mb-1">Email Address</p>
                                <p class="text-lg font-semibold text-gray-800">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Balance Section -->
                    <div class="border-t border-gray-200 pt-8">
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full mb-4 shadow-lg">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            
                            <h4 class="text-xl font-semibold text-gray-700 mb-2">Saldo Tersedia</h4>
                            
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-8 border-2 border-green-100">
                                <div class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-700 mb-2">
                                    Rp {{ number_format($user->saldo, 0, ',', '.') }}
                                </div>
                                <p class="text-gray-600 font-medium">Indonesian Rupiah</p>
                                
                                <!-- Balance Status -->
                                <div class="flex items-center justify-center mt-4">
                                    <div class="flex items-center space-x-2 bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-medium">
                                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                        <span>Aktif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 mt-8">

                        
                        <button class="flex-1 bg-white border-2 border-green-500 text-green-600 py-4 px-6 rounded-xl font-semibold 
                                     hover:bg-green-50 transform hover:scale-105 transition-all duration-300 
                                     shadow-md hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-green-200">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span>Riwayat Transaksi</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

</x-nasabah-layout>