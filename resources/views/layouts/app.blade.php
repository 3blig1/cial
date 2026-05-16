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
    <div class="min-h-screen flex">
        <aside class="w-64 bg-white shadow-lg">
            <div class="p-4 flex items-center gap-2">
                <a href="{{ route('dashboard') }}"><img src="{{ asset('logo/Logo_cial.png') }}" alt="Logo FormaLang" class="h-12"></a>
            </div>
            <nav class="mt-8 overflow-y-auto max-h-[calc(100vh-200px)]">
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
                    <a href="{{ route('exams.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('exams.*') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="ri-file-list-2-line w-5 h-5 mr-3"></i><span>Exams</span>
                    </a>
                    <a href="{{ route('subjects.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('subjects.*') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="ri-book-mark-line w-5 h-5 mr-3"></i><span>Matières</span>
                    </a>
                    <a href="{{ route('schools.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('schools.*') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="ri-building-line w-5 h-5 mr-3"></i><span>Écoles</span>
                    </a>
                    <a href="{{ route('users.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('users.*') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="ri-user-line w-5 h-5 mr-3"></i><span>utilisateurs</span>
                    </a>
                @endif
                <a href="{{ route('chat.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('chat.*') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                    <i class="ri-chat-3-line w-5 h-5 mr-3"></i><span>Messagerie</span>
                </a>

                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('profile.*') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="ri-user-line w-5 h-5 mr-3"></i><span>Mon Profil</span>
                    </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" class="flex items-center px-4 py-3"
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="ri-user-line w-5 h-5 mr-3" style="color: red;"></i><span style="color: red;">Déconnexion</span>
                                    </a>
                                </form>
            </nav>
        </aside>
        <main class="flex-1">
            <header class="bg-white shadow-sm sticky top-0 z-20">
                <div class="flex items-center justify-between px-8 py-4">
                    <!-- Contenu spécifique à la page (titre, recherche, boutons) -->
                    <div class="flex-1 flex items-center gap-4">
                        @yield('header-content')
                    </div>

                    <!-- Menu utilisateur (toujours présent) -->
                    <div class="flex items-center gap-4 ml-4">
                        @php
                            $currentSchool = \App\Models\School::find(session('school_id'));
                        @endphp

                        @if($currentSchool)
                            <div class="flex items-center gap-2 px-2 sm:px-3 py-1.5 rounded-full bg-indigo-50 text-indigo-700 text-xs font-medium max-w-[170px] sm:max-w-none">
                                <i class="ri-building-line"></i>
                                <span class="truncate">École : {{ $currentSchool->name }}</span>
                            </div>
                        @endif

                        <a href="{{ route('chat.index') }}" class="relative">
                            <div class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-50 rounded-full">
                                <i class="ri-notification-line"  ></i>
                            </div>
                            @php
                                $totalUnread = \App\Http\Controllers\ChatRoomController::getTotalUnreadMessages(auth()->id());
                            @endphp
                            <span class="absolute top-1 right-1 min-w-[18px] h-5 bg-red-500 rounded-full flex items-center justify-center text-white text-xs font-bold px-1">
                                {{ $totalUnread > 0 ? $totalUnread : '' }}
                            </span>
                        </a>
                        <div class="relative">
                            <button type="button" id="user-menu-button" class="flex items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=7F9CF5&background=EBF4FF" class="w-10 h-10 rounded-full object-cover" alt="Avatar de {{ auth()->user()->name }}">
                                <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                                @if(auth()->user()->isAdmin())
                                    <span class="px-2 py-0.5 text-xs rounded-full bg-indigo-100 text-indigo-700">Admin global</span>
                                @endif
                                <i class="ri-arrow-down-s-line"></i>
                            </button>
                            <div id="user-menu" class="hidden absolute right-0 mt-2 w-52 bg-white rounded-md shadow-lg py-1 z-30 overflow-hidden">
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="ri-user-line text-gray-500"></i>
                                    <span>Mon profil</span>
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-gray-100 text-left">
                                        <i class="ri-logout-box-r-line"></i>
                                        <span>Déconnexion</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
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
        });
    </script>
    @stack('scripts')
    @yield('scripts')
</body>
</html>