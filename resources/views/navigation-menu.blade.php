<nav x-data="{ open: false }" class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-4 lg:px-4">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <div>
                        <a href="{{ route('index') }}">
                            <div>
                                <span class="font-bold text-sm">Logizar Community</span>
                            </div>
                            @if(false)
                                @guest
                                    <div>
                                        <span class="text-xs">Rejoingnez la Bizar Community</span>
                                    </div>
                                @endguest
                            @endif
                        </a>
                    </div>
                    <div class="hidden sm:block ml-4">
                        <x-search.simple-search-box></x-search.simple-search-box>
                    </div>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">

                    <x-jet-nav-link href="{{ route('index') }}" :active="request()->routeIs('index')">
                        {{ __('Projets') }}
                    </x-jet-nav-link>

                    @auth
                        <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            {{ __('Tabeau de bord') }}
                        </x-jet-nav-link>

                        @if(Auth::user()->role == "admin")
                            <x-jet-nav-link href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">
                                {{ __('Administration') }}
                            </x-jet-nav-link>
                        @endif
                    @endauth
                    
                </div>
            </div>

            <div class="flex">
                @auth
                    <div class="hidden space-x-8 sm:-my-px sm:flex">
                        <x-jet-nav-link href="{{ route('project.create') }}" :active="request()->routeIs('project.create')">
                            <i class="fa-solid fa-plus"></i>  &nbsp;&nbsp;{{ __('Nouveau projet') }}
                        </x-jet-nav-link>
                    </div>

                    <div class="hidden sm:flex sm:items-center">

                        <!-- Settings Dropdown -->
                        <div class="ml-3 relative">
                            <x-jet-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        </button>
                                    @else
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                               {{ Auth::user()->name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Mon compte') }}
                                    </div>

                                    <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profil') }}
                                    </x-jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-jet-dropdown-link href="{{ route('logout') }}"
                                                @click.prevent="$root.submit();">
                                            {{ __('Déconnexion') }}
                                        </x-jet-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-jet-dropdown>
                        </div>
                    </div>
                @else
                    <div class="hidden space-x-8 sm:-my-px sm:flex">
                        <x-jet-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                            {{ __('Connexion') }}
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                            {{ __('Inscription') }}
                        </x-jet-nav-link>
                    </div>
                @endauth
            </div>
        
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    @auth
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div>
                <x-search.simple-search-box class="rounded-none w-full border-x-0"></x-search.simple-search-box>
            </div>
            <div class="pt-2 pb-3 space-y-1">
                <x-jet-responsive-nav-link href="{{ route('index') }}" :active="request()->routeIs('index')">
                    {{ __('Projets') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Tableau de bord') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('project.create') }}" :active="request()->routeIs('project.create')">
                    {{ __('Nouveau projet') }}
                </x-jet-responsive-nav-link>
                @if(Auth::user()->role == "admin")
                    <x-jet-responsive-nav-link href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">
                        {{ __('Administration') }}
                    </x-jet-responsive-nav-link>
                @endif
            </div>
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 mr-3">
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif

                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profil') }}
                    </x-jet-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                    @click.prevent="$root.submit();">
                            {{ __('Déconnexion') }}
                        </x-jet-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div>
                <x-search.simple-search-box class="rounded-none w-full border-x-0"></x-search.simple-search-box>
            </div>
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="space-y-1">
                    <div class="pt-2 pb-3 space-y-1">
                        <x-jet-responsive-nav-link href="{{ route('index') }}" :active="request()->routeIs('index')">
                            {{ __('Projets') }}
                        </x-jet-responsive-nav-link>
                        <x-jet-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                            {{ __('Connexion') }}
                        </x-jet-responsive-nav-link>
                        <x-jet-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                            {{ __('Inscription') }}
                        </x-jet-responsive-nav-link>
                    </div>
                </div>
            </div>
        </div>   
    @endauth
</nav>
