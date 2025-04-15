<nav x-data="{ open: false }" class="bg-gray-900 shadow-xl">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <!-- Left: Logo & Desktop Nav -->
            <div class="flex items-center flex-1">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <span class="text-xl font-light text-white tracking-tight hidden lg:inline">Pengaduan</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:ml-6 md:flex md:items-center md:space-x-4">
                    @if (Auth::user()->role === 'user')
                        <x-nav-link :href="route('dashboard.user')"
                                  :active="request()->routeIs('dashboard.user')"
                                  class="text-white hover:text-white hover:border-b-2 hover:border-white-300">
                            Overview
                        </x-nav-link>
                    @elseif (Auth::user()->role === 'staff')
                        <x-nav-link :href="route('dashboard.staff')"
                                  :active="request()->routeIs('dashboard.staff')"
                                  class="text-white hover:text-white hover:border-b-2 hover:border-white-300">
                            Cases
                        </x-nav-link>
                    @elseif (Auth::user()->role === 'head_staff')
                        <x-nav-link :href="route('dashboard.head')"
                                  :active="request()->routeIs('dashboard.head')"
                                  class="text-white hover:text-white hover:border-b-2 hover:border-white-300">
                            Dashboard
                        </x-nav-link>
                        <x-nav-link :href="route('headstaff.staff.index')"
                                  :active="request()->routeIs('headstaff.staff.*')"
                                  class="text-white hover:text-white hover:border-b-2 hover:border-white-300">
                            Team
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Right: User Controls -->
            <div class="absolute right-0 flex items-center space-x-4">
                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center focus:outline-none">
                            <div class="flex items-center space-x-2">
                                <span class="text-sm font-light text-gray-300">{{ Auth::user()->name }}</span>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="py-1 bg-white rounded-lg shadow-xl ">
                            <div class="px-4 py-3">
                                <p class="text-sm text-gray font-medium">{{ Auth::user()->name }}</p>
                            </div>
                            <x-dropdown-link :href="route('profile.edit')"
                                           class="px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>Data Akun</span>
                                </div>
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                               onclick="event.preventDefault(); this.closest('form').submit();"
                                               class="px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        <span>Keluar</span>
                                    </div>
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>

                <!-- Mobile Menu Button -->
                <button @click="open = !open" class="md:hidden p-2 rounded-lg hover:bg-gray-800">
                    <svg class="h-6 w-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

</nav>
