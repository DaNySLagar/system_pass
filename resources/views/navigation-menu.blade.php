<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 p-2">
    <!-- Primary Navigation Menu -->
    <div class="flex lg:place-content-around">
        

            <div class="flex flex-1 mr-2">

                @can('dashboard')
                    <div class="shrink-0 flex">
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('images/LOGO-GORE2.png') }}" class="h-12">
                        </a>
                    </div>
                @endcan

                <div class="hidden lg:flex flex-wrap items-center"> 
                    @can('users.index')
                        <div class="space-x-8 sm:-my-px sm:ml-10">
                            <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users')">
                                Usuarios
                            </x-nav-link>
                        </div>
                    @endcan

                    @can('passes.index')
                        <div class="space-x-8 sm:-my-px sm:ml-10">
                            <x-nav-link href="{{ route('passes.index') }}" :active="request()->routeIs('passes')">
                                Papeletas
                            </x-nav-link>
                        </div>
                    @endcan

                    @can('bosscheck.index')
                        <div class="space-x-8 sm:-my-px sm:ml-10">
                            <x-nav-link href="{{ route('bosscheck.index') }}" :active="request()->routeIs('passes')">
                                Firmados por Jefe
                            </x-nav-link>
                        </div>
                    @endcan

                    @can('rhcheck.index')
                        <div class="space-x-8 sm:-my-px sm:ml-10">
                            <x-nav-link href="{{ route('rhcheck.index') }}" :active="request()->routeIs('passes')">
                                Firmados por RRHH
                            </x-nav-link>
                        </div>
                    @endcan

                    @can('hours.index')
                        <div class="space-x-8 sm:-my-px sm:ml-10">
                            <x-nav-link href="{{ route('hours.index') }}" :active="request()->routeIs('passes')">
                                Marcar Hora
                            </x-nav-link>
                        </div>
                    @endcan

                    @can('passesadmin.index')
                        <div class="space-x-8 sm:-my-px sm:ml-10">
                            <x-nav-link href="{{ route('passesadmin.index') }}" :active="request()->routeIs('passes')">
                                Papeletas
                            </x-nav-link>
                        </div>
                    @endcan

                    @can('archived.index')
                        <div class="space-x-8 sm:-my-px sm:ml-10">
                            <x-nav-link href="{{ route('archived.index') }}" :active="request()->routeIs('passes')">
                                Archivados
                            </x-nav-link>
                        </div>
                    @endcan

                    @can('times.index')
                        <div class="space-x-8 sm:-my-px sm:ml-10">
                            <x-nav-link href="{{ route('times.index') }}" :active="request()->routeIs('times')">
                                Tiempos
                            </x-nav-link>
                        </div>
                    @endcan

                    @can('charges.index')
                    <div class="space-x-8 sm:-my-px sm:ml-10">
                        <x-nav-link href="{{ route('charges.index') }}" :active="request()->routeIs('charges')">
                            Cargos
                        </x-nav-link>
                    </div>
                    @endcan

                    @can('dependences.index')
                    <div class="space-x-8 sm:-my-px sm:ml-10">
                        <x-nav-link href="{{ route('dependences.index') }}" :active="request()->routeIs('dependences')">
                            Dependencias
                        </x-nav-link>
                    </div>
                    @endcan
                </div>
            </div>



           
            <!-- Settings Dropdown -->
            <div class="flex items-center">
                <x-dropdown align="right" width="48" class="bg-yellow-500">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        @else
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ Auth::user()->name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Administrar Cuenta') }}
                        </div>

                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-200"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-dropdown-link href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();">
                                {{ __('Cerrar Sesion') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            



            <!-- Hamburger -->
            <div class="flex lg:hidden ml-2">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
       
    </div>


    
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden">

        <div>
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        @can('users.index')
            <div>
                <x-responsive-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users')">
                    Usuarios
                </x-responsive-nav-link>
            </div>
        @endcan

        @can('passes.index')
            <div>
                <x-responsive-nav-link href="{{ route('passes.index') }}" :active="request()->routeIs('passes')">
                    Papeletas
                </x-responsive-nav-link>
            </div>
        @endcan


        @can('bosscheck.index')
            <div>
                <x-responsive-nav-link href="{{ route('bosscheck.index') }}" :active="request()->routeIs('passes')">
                    Firmados por Jefe
                </x-responsive-nav-link>
            </div>
        @endcan

        @can('rhcheck.index')
            <div>
                <x-responsive-nav-link href="{{ route('rhcheck.index') }}" :active="request()->routeIs('passes')">
                    Firmados por RRHH
                </x-responsive-nav-link>
            </div>
        @endcan

        @can('hours.index')
            <div>
                <x-responsive-nav-link href="{{ route('hours.index')}}" :active="request()->routeIs('passes')">
                    Marcar Hora
                </x-responsive-nav-link>
            </div>
        @endcan

        @can('passesadmin.index')
            <div>
                <x-responsive-nav-link href="{{ route('passesadmin.index')}}" :active="request()->routeIs('passes')">
                    Papeletas
                </x-responsive-nav-link>
            </div>
        @endcan

        @can('archived.index')
            <div>
                <x-responsive-nav-link href="{{ route('archived.index')}}" :active="request()->routeIs('passes')">
                    Archivados
                </x-responsive-nav-link>
            </div>
        @endcan

        @can('times.index')
            <div>
                <x-responsive-nav-link href="{{ route('times.index') }}" :active="request()->routeIs('times')">
                    Tiempos
                </x-responsive-nav-link>
            </div>
        @endcan

        @can('charges.index')
        <div>
            <x-responsive-nav-link href="{{ route('charges.index') }}" :active="request()->routeIs('charges')">
                Cargos
            </x-responsive-nav-link>
        </div>
        @endcan

        @can('dependences.index')
        <div>
            <x-responsive-nav-link href="{{ route('dependences.index') }}" :active="request()->routeIs('dependences')">
                Dependencias
            </x-responsive-nav-link>
        </div>
        @endcan

    </div>
</nav>