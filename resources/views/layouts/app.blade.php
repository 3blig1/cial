<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Formation')</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/Logo_icone.png') }}">
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4F46E5',
                        secondary: '#6B7280'
                    },
                    borderRadius: {
                        'none': '0px',
                        'sm': '4px',
                        DEFAULT: '8px',
                        'md': '12px',
                        'lg': '16px',
                        'xl': '20px',
                        '2xl': '24px',
                        '3xl': '32px',
                        'full': '9999px',
                        'button': '8px'
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .custom-radio {
            width: 20px; height: 20px; border: 2px solid #E5E7EB; border-radius: 50%;
            position: relative; cursor: pointer;
        }
        .custom-radio::after {
            content: ''; position: absolute; top: 50%; left: 50%;
            transform: translate(-50%, -50%); width: 10px; height: 10px;
            background: #4F46E5; border-radius: 50%; opacity: 0; transition: 0.2s;
        }
        input[type="radio"]:checked + .custom-radio::after { opacity: 1; }
        input[type="radio"] { display: none; }

        .custom-checkbox {
            width: 20px; height: 20px; border: 2px solid #E5E7EB; border-radius: 4px;
            position: relative; cursor: pointer; transition: 0.2s;
        }
        .custom-checkbox::after {
            content: '\\ea63'; /* Remixicon check icon */
            font-family: 'remixicon'; position: absolute; top: 50%; left: 50%;
            transform: translate(-50%, -50%); color: white; opacity: 0; transition: 0.2s;
        }
        input[type="checkbox"]:checked + .custom-checkbox { background: #4F46E5; border-color: #4F46E5; }
        input[type="checkbox"]:checked + .custom-checkbox::after { opacity: 1; }
        input[type="checkbox"] { display: none; }
    </style>
</head>
<body class="bg-gray-50">
    <div id="sidebar-overlay" class="fixed inset-0 z-30 hidden bg-slate-900/40 lg:hidden"></div>
    <div class="min-h-screen lg:flex">
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 flex h-screen w-72 max-w-[85vw] -translate-x-full flex-col bg-white shadow-xl transition-transform duration-300 ease-out lg:static lg:z-auto lg:h-auto lg:w-64 lg:max-w-none lg:translate-x-0 lg:shadow-lg">
            <div class="flex items-center justify-between p-4">
                <a href="{{ route('dashboard') }}"><img src="{{ asset('logo/Logo_cial.png') }}" alt="Logo FormaLang" class="h-12"></a>
                <button type="button" data-sidebar-toggle class="inline-flex h-10 w-10 items-center justify-center rounded-full text-gray-500 hover:bg-gray-100 lg:hidden">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            <nav class="mt-4 flex-1 overflow-y-auto pb-6 lg:max-h-[calc(100vh-120px)]">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('dashboard') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                    <i class="ri-dashboard-line w-5 h-5 mr-3"></i><span>Tableau de bord</span>
                </a>
                @if(auth()->user()->hasAnyRole(['admin', 'secretary']))
                    <a href="{{ route('students.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('students.*') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="ri-user-line w-5 h-5 mr-3"></i><span>Élèves</span>
                    </a>
                     <a href="{{ route('pending-students.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('pending-students.*') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="ri-time-line w-5 h-5 mr-3"></i><span>Liste d'attente</span>
                    </a>   
                @endif
                @if(auth()->user()->hasAnyRole(['admin', 'secretary', 'teacher']))
                    <a href="{{ route('reports.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('reports.*') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="ri-file-chart-line w-5 h-5 mr-3"></i><span>Rapports</span>
                    </a>
                @endif
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('teachers.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('teachers.*') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="ri-team-line w-5 h-5 mr-3"></i><span>Enseignants</span>
                    </a>
                    <a href="{{ route('courses.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('courses.*') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="ri-book-open-line w-5 h-5 mr-3"></i><span>Cours</span>
                    </a>
                    <a href="{{ route('subjects.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('subjects.*') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="ri-book-2-line w-5 h-5 mr-3"></i><span>Matières</span>
                    </a>
                    <a href="{{ route('schools.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('schools.*') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="ri-building-line w-5 h-5 mr-3"></i><span>Écoles</span>
                    </a>
                    <a href="{{ route('users.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('users.*') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="ri-user-line w-5 h-5 mr-3"></i><span>utilisateurs</span>
                    </a>
                @endif
                @if(auth()->user()->hasAnyRole(['admin', 'teacher']))
                    <a href="{{ route('exams.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('exams.*') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="ri-file-list-2-line w-5 h-5 mr-3"></i><span>Exams</span>
                    </a>
                @endif
                <a href="{{ route('chat.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('chat.*') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                    <i class="ri-chat-3-line w-5 h-5 mr-3"></i><span>Messagerie</span>
                </a>

               
            </nav>
        </aside>
        <main class="min-w-0 flex-1 lg:ml-0">
            <header class="bg-white shadow-sm sticky top-0 z-20">
                <div class="flex flex-col gap-4 px-4 py-4 sm:px-6 lg:px-8">
                    <!-- Contenu spécifique à la page (titre, recherche, boutons) -->
                    <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                        <div class="flex min-w-0 flex-1 items-start gap-3 sm:items-center">
                            <button type="button" data-sidebar-toggle class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-gray-200 text-gray-600 hover:bg-gray-50 lg:hidden">
                                <i class="ri-menu-line text-xl"></i>
                            </button>
                            <div class="flex min-w-0 flex-1 flex-wrap items-center gap-3">
                                @yield('header-content')
                            </div>
                        </div>

                        <!-- Menu utilisateur (toujours présent) -->
                        <div class="flex flex-wrap items-center justify-end gap-3 sm:gap-4">
                            @php
                                $currentSchool = \App\Models\School::find(session('school_id'));
                            @endphp

                            @if($currentSchool)
                                <div class="flex max-w-full items-center gap-2 rounded-full bg-indigo-50 px-2 py-1.5 text-xs font-medium text-indigo-700 sm:px-3">
                                    <i class="ri-building-line shrink-0"></i>
                                    <span class="max-w-[160px] truncate sm:max-w-[220px]">École : {{ $currentSchool->name }}</span>
                                </div>
                            @endif

                            <a href="{{ route('chat.index') }}" class="relative shrink-0">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full text-gray-600 hover:bg-gray-50">
                                    <i class="ri-notification-line"></i>
                                </div>
                                @php
                                    $totalUnread = \App\Http\Controllers\ChatRoomController::getTotalUnreadMessages(auth()->id());
                                @endphp
                                <span class="absolute right-1 top-1 flex h-5 min-w-[18px] items-center justify-center rounded-full bg-red-500 px-1 text-xs font-bold text-white">
                                    {{ $totalUnread > 0 ? $totalUnread : '' }}
                                </span>
                            </a>
                            <div class="relative max-w-full">
                                <button type="button" id="user-menu-button" class="flex max-w-full items-center gap-2 rounded-full px-1 py-1 hover:bg-gray-50 sm:px-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=7F9CF5&background=EBF4FF" class="h-10 w-10 rounded-full object-cover" alt="Avatar de {{ auth()->user()->name }}">
                                    <span class="hidden max-w-[120px] truncate text-sm font-medium sm:inline">{{ auth()->user()->name }}</span>
                                    @if(auth()->user()->isAdmin())
                                        <span class="hidden rounded-full bg-indigo-100 px-2 py-0.5 text-xs text-indigo-700 md:inline">Admin global</span>
                                    @endif
                                    <i class="ri-arrow-down-s-line"></i>
                                </button>
                                <div id="user-menu" class="hidden absolute right-0 mt-2 w-52 overflow-hidden rounded-md bg-white py-1 shadow-lg z-30">
                                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="ri-user-line text-gray-500"></i>
                                        <span>Mon profil</span>
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-left text-sm text-red-600 hover:bg-gray-100">
                                            <i class="ri-logout-box-r-line"></i>
                                            <span>Déconnexion</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
                @if (session('success'))
                    <div class="bg-violet-100 border-l-4 border-violet-500 text-violet-700 p-4 mb-6 rounded-r-md" role="alert">
                        <p class="font-bold">Succès</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-violet-50 border-l-4 border-violet-400 text-violet-700 p-4 mb-6 rounded-r-md" role="alert">
                        <p class="font-bold">Erreur</p>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const button = document.getElementById('user-menu-button');
            const menu = document.getElementById('user-menu');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const sidebarToggles = document.querySelectorAll('[data-sidebar-toggle]');
            const sidebarLinks = sidebar ? sidebar.querySelectorAll('a') : [];

            const closeSidebar = function () {
                if (!sidebar || window.innerWidth >= 1024) {
                    return;
                }

                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            };

            const toggleSidebar = function () {
                if (!sidebar || window.innerWidth >= 1024) {
                    return;
                }

                const isHidden = sidebar.classList.contains('-translate-x-full');
                sidebar.classList.toggle('-translate-x-full', !isHidden);
                sidebarOverlay.classList.toggle('hidden', !isHidden);
                document.body.classList.toggle('overflow-hidden', isHidden);
            };

            sidebarToggles.forEach(function (toggle) {
                toggle.addEventListener('click', function () {
                    toggleSidebar();
                });
            });

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', closeSidebar);
            }

            sidebarLinks.forEach(function (link) {
                link.addEventListener('click', closeSidebar);
            });

            if (!button || !menu) {
                return;
            }

            button.addEventListener('click', function (event) {
                event.stopPropagation();
                menu.classList.toggle('hidden');
            });

            document.addEventListener('click', function (event) {
                if (!menu.contains(event.target) && !button.contains(event.target)) {
                    menu.classList.add('hidden');
                }
            });

            window.addEventListener('resize', function () {
                if (window.innerWidth >= 1024) {
                    sidebarOverlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });
        });
    </script>
    @stack('scripts')
    @yield('scripts')
</body>
</html>