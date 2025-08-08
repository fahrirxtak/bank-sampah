<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bank Sampah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('Logo.png') }}">
    <title>{{ config('app.name', 'Bank Sampah') }}</title>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    },
                    animation: {
                        'slide-in': 'slideIn 0.3s ease-out',
                        'slide-out': 'slideOut 0.3s ease-out',
                        'fade-in': 'fadeIn 0.2s ease-out',
                        'pulse-subtle': 'pulseSubtle 2s ease-in-out infinite',
                    },
                    keyframes: {
                        slideIn: {
                            '0%': {
                                transform: 'translateX(-100%)'
                            },
                            '100%': {
                                transform: 'translateX(0)'
                            }
                        },
                        slideOut: {
                            '0%': {
                                transform: 'translateX(0)'
                            },
                            '100%': {
                                transform: 'translateX(-100%)'
                            }
                        },
                        fadeIn: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(10px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        },
                        pulseSubtle: {
                            '0%,100%': {
                                transform: 'scale(1)'
                            },
                            '50%': {
                                transform: 'scale(1.02)'
                            }
                        }
                    }
                }
            }
        }
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-link-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-link-hover:hover {
            transform: translateX(8px);
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar-gradient {
            display: flex;
            flex-direction: column;
            color: white;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            /* shadow-2xl */
            z-index: 9998;
            background: linear-gradient(to bottom, #15803d, #22c55e);
        }


        .sidebar-gradient::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 50%, rgba(0, 0, 0, 0.05) 100%);
            pointer-events: none;
        }

        .scrollbar-thin::-webkit-scrollbar {
            width: 4px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Sidebar collapse (desktop) */
        .sidebar-collapsed {
            width: 5rem !important;
            transition: width 0.3s ease;
        }

        .sidebar-collapsed .sidebar-text,
        .sidebar-collapsed .sidebar-header-text {
            display: none;
        }

        .sidebar-collapsed .sidebar-icon-only {
            justify-content: center;
        }

        .sidebar-collapsed .nav-link-hover:hover {
            transform: none;
        }

        .main-content-expanded {
            margin-left: 5rem !important;
            transition: margin-left 0.3s ease;
        }

        .swal2-container {
            z-index: 99999 !important;
        }
    </style>
</head>

<body class="bg-gray-50 overflow-x-hidden">

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed top-0 left-0 h-screen w-72 sidebar-gradient text-white flex flex-col shadow-2xl
           z-[9998] transition-all duration-300 ease-in-out transform -translate-x-full lg:translate-x-0">

        <!-- Header -->
        <div class="p-4 border-b border-white/10">
            <div class="flex items-center gap-4 justify-center">
                <!-- Logo Container -->
                <div class="w-16 h-16 bg-white/20 rounded-full overflow-hidden flex-shrink-0 glass-effect">
                    <img src="{{ asset('Logo.png') }}" alt="Bank Sampah Logo" class="w-full h-full object-cover">
                </div>

                <!-- Text Content -->
                <div class="text-center">
                    <h1 class="text-lg font-bold text-white tracking-tight">Bank Sampah</h1>
                    <p class="text-xs text-white/70 mt-1">Nasabah Panel</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <!-- Navigation -->
        <nav class="flex-1 px-2 py-4 overflow-y-auto scrollbar-thin">
            <div class="space-y-1">
                <h3 class="text-xs font-semibold text-white/60 uppercase tracking-wider mb-3 px-3 sidebar-header-text">
                    Menu Utama</h3>

                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link-hover flex items-center gap-3 px-3 py-3 rounded-lg text-sm font-medium text-white/90 hover:text-white group sidebar-icon-only">
                    <i class="fas fa-home text-lg w-6 text-center group-hover:scale-110 transition-transform"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>

                <a href="{{ route('admin.transaksi.index') }}"
                    class="nav-link-hover flex items-center gap-3 px-3 py-3 rounded-lg text-sm font-medium text-white/90 hover:text-white group sidebar-icon-only">
                    <i class="fas fa-coins text-lg w-6 text-center group-hover:scale-110 transition-transform"></i>
                    <span class="sidebar-text">Transaksi</span>
                </a>

                <a href="{{ route('admin.setor.index') }}"
                    class="nav-link-hover flex items-center gap-3 px-3 py-3 rounded-lg text-sm font-medium text-white/90 hover:text-white group sidebar-icon-only">
                    <i
                        class="fas fa-hand-holding text-lg w-6 text-center group-hover:scale-110 transition-transform"></i>
                    <span class="sidebar-text">Setoran</span>
                </a>

                <h3
                    class="text-xs font-semibold text-white/60 uppercase tracking-wider mb-3 mt-4 px-3 sidebar-header-text">
                    Data Master</h3>

                <a href="{{ route('admin.nasabah.index') }}"
                    class="nav-link-hover flex items-center gap-3 px-3 py-3 rounded-lg text-sm font-medium text-white/90 hover:text-white group sidebar-icon-only">
                    <i class="fas fa-users text-lg w-6 text-center group-hover:scale-110 transition-transform"></i>
                    <span class="sidebar-text">Nasabah</span>
                </a>

                <a href="{{ route('admin.sampah.index') }}"
                    class="nav-link-hover flex items-center gap-3 px-3 py-3 rounded-lg text-sm font-medium text-white/90 hover:text-white group sidebar-icon-only">
                    <i class="fas fa-dumpster text-lg w-6 text-center group-hover:scale-110 transition-transform"></i>
                    <span class="sidebar-text">Jenis Sampah</span>
                </a>
            </div>
        </nav>


        <!-- Footer -->
        <div class="p-2 border-t border-white/10 bg-black/10">
            <div class="flex items-center gap-3 p-2 rounded-lg glass-effect hover:bg-white/10 transition-colors">
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center gap-3 w-full text-white hover:text-white no-underline sidebar-icon-only">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center font-bold text-sm shadow-lg text-white uppercase">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 sidebar-text">
                        <h6 class="text-sm font-semibold mb-0">{{ auth()->user()->name }}</h6>
                        <small class="text-xs text-white/70">Administrator</small>
                    </div>
                </a>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="w-full mt-2">
                @csrf
                <button type="submit"
                    class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-medium py-2 px-2 rounded-lg flex items-center justify-center gap-2 transition-all duration-300 hover:shadow-lg hover:scale-[1.02] active:scale-95 sidebar-icon-only">
                    <i class="fas fa-sign-out-alt text-sm"></i>
                    <span class="sidebar-text">Logout</span>
                </button>
            </form>
        </div>
    </aside>


    <!-- Top Bar -->
    <header id="topbar"
        class="fixed top-0 right-0 left-0 lg:left-72 h-16 bg-white shadow-sm z-[9996] border-b border-gray-100 transition-all duration-300 ease-in-out flex items-center justify-between px-4 sm:px-6">
        <!-- Left -->
        <div class="flex items-center space-x-4">
            <button id="top-hamburger" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                <i class="fas fa-bars text-lg"></i>
            </button>
            <h1 class="text-lg font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
        </div>
        <!-- Right -->
        <div class="flex items-center space-x-4">
            <div class="hidden md:block">
                <div class="relative">
                    <input type="text" placeholder="Cari sesuatu..."
                        class="w-40 sm:w-64 pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition-all duration-200 outline-none text-sm">
                    <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <span class="text-sm font-medium text-gray-700 hidden md:inline-block">Saldo:</span>
                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                    Rp {{ number_format(auth()->user()->saldo ?? 0, 0, ',', '.') }}
                </span>
            </div>
            <button
                class="relative p-2 rounded-full hover:bg-gray-100 text-gray-600 hover:text-gray-800 transition-colors">
                <i class="fas fa-bell text-lg"></i>
                <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
            </button>
            <div class="relative">
                <button id="user-menu-button" class="flex items-center space-x-2 focus:outline-none">
                    <div
                        class="w-8 h-8 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center text-white font-semibold text-sm">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <span
                        class="hidden md:inline-block text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                    <i class="fas fa-chevron-down text-xs text-gray-500 hidden md:inline-block"></i>
                </button>
                <div id="user-dropdown"
                    class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-100">
                    <a href="{{ route('profile.edit') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i
                            class="fas fa-user-circle mr-2"></i> Profil Saya</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i
                            class="fas fa-cog mr-2"></i> Pengaturan</a>
                    <div class="border-t border-gray-100"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"><i
                                class="fas fa-sign-out-alt mr-2"></i> Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main id="main-content"
        class="lg:ml-72 ml-0 pt-20 p-4 sm:p-6 min-h-screen overflow-y-auto transition-all duration-300">
        {{ $slot }}
    </main>

    <!-- Mobile Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black/50 z-[9997] lg:hidden hidden"></div>


    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const overlay = document.getElementById('mobile-overlay');
            const topbar = document.getElementById('topbar');
            const mobileToggle = document.getElementById('top-hamburger');
            const userMenuButton = document.getElementById('user-menu-button');
            const userDropdown = document.getElementById('user-dropdown');

            function toggleSidebar() {
                if (window.innerWidth < 1024) {
                    sidebar.classList.toggle('-translate-x-full');
                    overlay.classList.toggle('hidden');
                } else {
                    sidebar.classList.toggle('sidebar-collapsed');
                    mainContent.classList.toggle('main-content-expanded');
                    topbar.classList.toggle('lg:left-72');
                    topbar.classList.toggle('lg:left-20');
                }
            }

            mobileToggle.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            });

            // User dropdown
            userMenuButton.addEventListener('click', () => userDropdown.classList.toggle('hidden'));
            document.addEventListener('click', e => {
                if (!userMenuButton.contains(e.target)) userDropdown.classList.add('hidden');
            });

            // Auto reset on resize
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.add('hidden');
                } else {
                    sidebar.classList.remove('sidebar-collapsed');
                    mainContent.classList.remove('main-content-expanded');
                    topbar.classList.remove('lg:left-20');
                    topbar.classList.add('lg:left-72');
                }
            });
            // Sweetalert Toaster
            @if (session('success'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#d1fae5',
                    color: '#065f46'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#fee2e2',
                    color: '#991b1b'
                });
            @endif
        });


        function showSuccessToast(message) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#d1fae5',
                color: '#065f46',
                customClass: {
                    container: 'swal2-container'
                }
            });

        }

        function showErrorToast(message) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: message,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#fee2e2',
                color: '#991b1b',
                customClass: {
                    container: 'swal2-container'
                }
            });
        }
    </script>
</body>

</html>
