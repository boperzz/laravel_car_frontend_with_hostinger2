<nav x-data="{ open: false }" class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200/50 dark:border-slate-700/50 shadow-sm sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center group">
                        <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl p-2 mr-3 group-hover:scale-110 transition-transform">
                            <i class="fas fa-car text-white text-xl"></i>
                        </div>
                        <span class="text-xl font-bold gradient-text">Car Maintenance</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <!-- Admin Links -->
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')">
                                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                            </x-nav-link>
                            <x-nav-link :href="route('admin.staff.index')" :active="request()->routeIs('admin.staff.*')">
                                <i class="fas fa-users mr-2"></i> Staff
                            </x-nav-link>
                            <x-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')">
                                <i class="fas fa-wrench mr-2"></i> Services
                            </x-nav-link>
                            <x-nav-link :href="route('admin.appointments.index')" :active="request()->routeIs('admin.appointments.*')">
                                <i class="fas fa-calendar-alt mr-2"></i> Appointments
                            </x-nav-link>
                            <x-nav-link :href="route('admin.schedule.index')" :active="request()->routeIs('admin.schedule.*')">
                                <i class="fas fa-calendar-times mr-2"></i> Schedule
                            </x-nav-link>
                        @elseif(auth()->user()->isStaff())
                            <!-- Staff Links -->
                            <x-nav-link :href="route('staff.dashboard')" :active="request()->routeIs('staff.dashboard')">
                                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                            </x-nav-link>
                            <x-nav-link :href="route('staff.appointments.index')" :active="request()->routeIs('staff.appointments.*')">
                                <i class="fas fa-calendar-check mr-2"></i> My Appointments
                            </x-nav-link>
                        @else
                            <!-- Customer Links -->
                            <x-nav-link :href="route('customer.dashboard')" :active="request()->routeIs('customer.dashboard')">
                                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                            </x-nav-link>
                            <x-nav-link :href="route('customer.vehicles.index')" :active="request()->routeIs('customer.vehicles.*')">
                                <i class="fas fa-car mr-2"></i> My Vehicles
                            </x-nav-link>
                            <x-nav-link :href="route('customer.appointments.index')" :active="request()->routeIs('customer.appointments.*')">
                                <i class="fas fa-calendar mr-2"></i> Appointments
                            </x-nav-link>
                        @endif
                    @else
                        @if (Route::has('login'))
                            <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                                <i class="fas fa-sign-in-alt mr-2"></i> Log in
                            </x-nav-link>
                        @endif
                        @if (Route::has('register'))
                            <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                                <i class="fas fa-user-plus mr-2"></i> Register
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            @auth
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-slate-700 dark:text-slate-300 bg-white/50 dark:bg-slate-800/50 hover:bg-white dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white focus:outline-none transition ease-in-out duration-150 shadow-sm hover:shadow-md">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-full flex items-center justify-center mr-2">
                                        <i class="fas fa-user text-white text-sm"></i>
                                    </div>
                                    <span>{{ Auth::user()->name }}</span>
                                </div>
                                <div class="ms-2">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                <i class="fas fa-user-edit mr-2"></i> {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endauth

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none focus:bg-slate-100 dark:focus:bg-slate-800 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white dark:bg-slate-800 border-t border-slate-200 dark:border-slate-700">
        <div class="pt-2 pb-3 space-y-1 px-4">
            @auth
                @if(auth()->user()->isAdmin())
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.staff.index')" :active="request()->routeIs('admin.staff.*')">
                        <i class="fas fa-users mr-2"></i> Staff
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')">
                        <i class="fas fa-wrench mr-2"></i> Services
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.appointments.index')" :active="request()->routeIs('admin.appointments.*')">
                        <i class="fas fa-calendar-alt mr-2"></i> Appointments
                    </x-responsive-nav-link>
                @elseif(auth()->user()->isStaff())
                    <x-responsive-nav-link :href="route('staff.dashboard')" :active="request()->routeIs('staff.dashboard')">
                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('staff.appointments.index')" :active="request()->routeIs('staff.appointments.*')">
                        <i class="fas fa-calendar-check mr-2"></i> My Appointments
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('customer.dashboard')" :active="request()->routeIs('customer.dashboard')">
                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('customer.vehicles.index')" :active="request()->routeIs('customer.vehicles.*')">
                        <i class="fas fa-car mr-2"></i> My Vehicles
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('customer.appointments.index')" :active="request()->routeIs('customer.appointments.*')">
                        <i class="fas fa-calendar mr-2"></i> Appointments
                    </x-responsive-nav-link>
                @endif
            @else
                @if (Route::has('login'))
                    <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        <i class="fas fa-sign-in-alt mr-2"></i> Log in
                    </x-responsive-nav-link>
                @endif
                @if (Route::has('register'))
                    <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        <i class="fas fa-user-plus mr-2"></i> Register
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-slate-200 dark:border-slate-700">
                <div class="px-4">
                    <div class="font-medium text-base text-slate-800 dark:text-slate-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-slate-500 dark:text-slate-400">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        <i class="fas fa-user-edit mr-2"></i> {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
