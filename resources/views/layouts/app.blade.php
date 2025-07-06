<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Formation')</title>
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
            <nav class="mt-8">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('dashboard') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                    <i class="ri-dashboard-line w-5 h-5 mr-3"></i><span>Tableau de bord</span>
                </a>
                @if(auth()->user()->hasAnyRole(['admin', 'secretary']))
                    <a href="{{ route('students.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('students.*') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="ri-user-line w-5 h-5 mr-3"></i><span>Élèves</span>
                    </a>
                @endif
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('teachers.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('teachers.*') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="ri-team-line w-5 h-5 mr-3"></i><span>Enseignants</span>
                    </a>
                    <a href="{{ route('courses.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('courses.*') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="ri-book-open-line w-5 h-5 mr-3"></i><span>Cours</span>
                    </a>
                @endif
                @if(auth()->user()->hasAnyRole(['admin', 'secretary']))
                    <a href="{{ route('reports.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('reports.*') ? 'text-primary bg-indigo-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="ri-file-chart-line w-5 h-5 mr-3"></i><span>Rapports</span>
                    </a>
                @endif

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
                    <div class="flex items-center gap-4 ml-4" x-data="{ open: false }">
                        <button class="relative">
                            <div class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-50 rounded-full">
                                <i class="ri-notification-line"></i>
                            </div>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        <div class="relative">
                            <button @click="open = !open" class="flex items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=7F9CF5&background=EBF4FF" class="w-10 h-10 rounded-full object-cover" alt="Avatar de {{ auth()->user()->name }}">
                                <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                                <i class="ri-arrow-down-s-line"></i>
                            </button>
                            <div x-show="open" @click.away="open = true" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10" style="display: none;" x-transition>
                                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"></a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/cdn@3.x.x/dist/cdn.min.js" defer></script>
    @stack('scripts')
</body>
</html>