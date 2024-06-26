{{--Navigation--}}
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 sticky right-0 left-0 top-0 z-10">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800"/>
                    </a>
                </div>

                {{--Home--}}
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        <i class="fas fa-home mr-1"></i>
                        {{ __('Home') }}
                    </x-nav-link>
                </div>

                {{--Scheduler--}}
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('scheduler.index')" :active="request()->routeIs('scheduler.index')">
                        <i class="fas fa-calendar-alt mr-1"></i>
                        {{ __('Scheduler') }}
                    </x-nav-link>
                </div>

                {{--Messages--}}
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('messages.index')" :active="request()->routeIs('messages.index')">
                        <i class="fas fa-envelope mr-1"></i>
                        {{ __('Messages') }}
                    </x-nav-link>
                </div>

                {{--Rooms--}}
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex d-none">
                    <x-nav-link :href="route('room.index')" :active="request()->routeIs('room.index')">
                        <i class="fas fa-door-open mr-1"></i>
                        {{ __('Rooms') }}
                    </x-nav-link>
                </div>

                {{--todo - handle showing these better on tablets--}}
                {{--Attendance--}}
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex d-none">
                    <x-nav-link :href="route('attendance.index')" :active="request()->routeIs('attendance.index')">
                        <i class="fas fa-book mr-1"></i>
                        {{ __('Attendance') }}
                    </x-nav-link>
                </div>

                {{--Admin Only--}}
                @auth()
                    @if( auth()->user()->isAdmin() )

                        {{--Admin--}}
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex d-none">
                            <x-nav-link :href="route('admin.dashboard')"
                                        :active="request()->routeIs('admin.dashboard')">
                                <i class="fas fa-user-shield mr-1"></i>
                                {{ __('Admin') }}
                            </x-nav-link>
                        </div>

                    @endif
                @endauth
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center   w-fit ml-auto">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <i class="fas fa-user-circle mr-1"></i>
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="border-t border-gray-100 my-2"></div>

                        {{-- Profile --}}
                        <x-dropdown-link :href="route('profile.edit')"
                                         class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                            <i class="fas fa-user mr-1"></i>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        {{--Settings--}}
                        <x-dropdown-link :href="route('settings.index')"
                                         class="{{ request()->routeIs('settings.index') ? 'active' : '' }}">
                            <i class="fas fa-cog mr-1"></i>
                            {{ __('Settings') }}
                        </x-dropdown-link>

                        {{--Admin Only--}}
                        @auth()
                            @if( auth()->user()->isAdmin() )
                                {{--Admin Only--}}
                                <div class="border-t border-gray-100 my-2"></div>
                                <div class="text-center">
                                    <i class="fa-solid fa-user-secret"></i>
                                </div>

                                {{--Dashboard--}}
                                <x-dropdown-link :href="route('admin.dashboard')"
                                                 class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                    <i class="fas fa-gauge mr-1"></i>
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>

                                {{--Lessons--}}
                                <x-dropdown-link :href="route('admin.lessons.index')"
                                                 class="{{ request()->routeIs('admin.lessons.index') ? 'active' : '' }}">
                                    <i class="fas fa-person-chalkboard mr-1"></i>
                                    {{ __('Lessons') }}
                                </x-dropdown-link>

                                {{--Invoices--}}
                                <x-dropdown-link :href="route('admin.invoices.index')"
                                                 class="{{ request()->routeIs('admin.invoices.index') ? 'active' : '' }}">
                                    <i class="fas fa-file-invoice-dollar mr-1"></i>
                                    {{ __('Invoices') }}
                                </x-dropdown-link>

                                {{--Instruments--}}
                                <x-dropdown-link :href="route('admin.instruments.index')"
                                                 class="{{ request()->routeIs('admin.instruments.index') ? 'active' : '' }}">
                                    <i class="fas fa-drum mr-1"></i>
                                    {{ __('Instruments') }}
                                </x-dropdown-link>

                                {{--Database--}}
                                <x-dropdown-link :href="route('admin.database')"
                                                 class="{{ request()->routeIs('admin.database') ? 'active' : '' }}">
                                    <i class="fas fa-database mr-1"></i>
                                    {{ __('Database') }}
                                </x-dropdown-link>

                                {{-- Users --}}
                                <x-dropdown-link :href="route('admin.users.index')"
                                                 class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                                    <i class="fas fa-users mr-1"></i>
                                    {{ __('Users') }}
                                </x-dropdown-link>

                                {{-- Teachers --}}
                                <x-dropdown-link :href="route('admin.teachers.index')"
                                                 :class="request()->routeIs('admin.teachers.index') ? 'active' : ''">
                                    <i class="fas fa-chalkboard-teacher mr-1"></i>
                                    {{ __('Teachers') }}
                                </x-dropdown-link>

                                {{-- Parents --}}
                                <x-dropdown-link :href="route('admin.parents.index')"
                                                 class="{{ request()->routeIs('admin.parents.index') ? 'active' : '' }}">
                                    <i class="fas fa-user-friends mr-1"></i>
                                    {{ __('Parents') }}
                                </x-dropdown-link>

                                {{-- Students --}}
                                <x-dropdown-link :href="route('admin.students.index')"
                                                 class="{{ request()->routeIs('admin.students.index') ? 'active' : '' }}">
                                    <i class="fas fa-user-graduate mr-1"></i>
                                    {{ __('Students') }}
                                </x-dropdown-link>

                                <div class="border-t border-gray-100 my-2"></div>
                            @endif
                        @endauth

                        {{-- Logout --}}
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                  this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>

                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">

            {{--Home--}}
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                <i class="fas fa-home mr-1"></i>
                {{ __('Home') }}
            </x-responsive-nav-link>

            {{--Scheduler--}}
            <x-responsive-nav-link :href="route('scheduler.index')" :active="request()->routeIs('scheduler.index')">
                <i class="fas fa-calendar-alt mr-1"></i>
                {{ __('Scheduler') }}
            </x-responsive-nav-link>

            {{--Messages--}}
            <x-responsive-nav-link :href="route('messages.index')" :active="request()->routeIs('messages.index')">
                <i class="fas fa-envelope mr-1"></i>
                {{ __('Messages') }}
            </x-responsive-nav-link>

            {{--Rooms--}}
            <x-responsive-nav-link :href="route('room.index')" :active="request()->routeIs('room.index')">
                <i class="fas fa-door-open mr-1"></i>
                {{ __('Rooms') }}
            </x-responsive-nav-link>

            {{--Attendance--}}
            <x-responsive-nav-link :href="route('attendance.index')" :active="request()->routeIs('attendance.index')">
                <i class="fas fa-book mr-1"></i>
                {{ __('Attendance') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">
                    <i class="fas fa-user-circle mr-1"></i>
                    {{ Auth::user()->name }}
                </div>
                <div class="font-medium text-sm text-gray-500">
                    <i class="fas fa-envelope mr-1"></i>
                    {{ Auth::user()->email }}
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <div class="border-t border-gray-100 my-2"></div>

                {{-- Profile --}}
                <x-responsive-nav-link
                    :href="route('profile.edit')"
                    :active="request()->routeIs('profile.edit')"
                    :class="request()->routeIs('profile.edit') ? 'active' : ''">
                    <i class="fas fa-user mr-1"></i>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                {{--Settings--}}
                <x-responsive-nav-link
                    :href="route('settings.index')"
                    :active="request()->routeIs('settings.index')"
                    :class="request()->routeIs('settings.index') ? 'active' : ''">
                    <i class="fas fa-gears mr-1"></i>
                    {{ __('Settings') }}
                </x-responsive-nav-link>

                {{--Admin Only--}}
                @auth()
                    @if( auth()->user()->isAdmin() )
                        <div class="border-t border-gray-100 my-2"></div>
                        {{--Dashboard--}}
                        <x-responsive-nav-link
                            :href="route('admin.dashboard')"
                            :active="request()->routeIs('admin.dashboard')"
                            :class="request()->routeIs('admin.dashboard') ? 'active' : ''">
                            <i class="fas fa-gauge mr-1"></i>
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>

                        {{--Lessons--}}
                        <x-responsive-nav-link
                            :href="route('admin.lessons.index')"
                            :active="request()->routeIs('admin.lessons.index')"
                            :class="request()->routeIs('admin.lessons.index') ? 'active' : ''">
                            <i class="fas fa-person-chalkboard mr-1"></i>
                            {{ __('Lessons') }}
                        </x-responsive-nav-link>

                        {{--Invoices--}}
                        <x-responsive-nav-link
                            :href="route('admin.invoices.index')"
                            :active="request()->routeIs('admin.invoices.index')"
                            :class="request()->routeIs('admin.invoices.index') ? 'active' : ''">
                            <i class="fas fa-file-invoice-dollar mr-1"></i>
                            {{ __('Invoices') }}
                        </x-responsive-nav-link>

                        {{--Instruments--}}
                        <x-responsive-nav-link
                            :href="route('admin.instruments.index')"
                            :active="request()->routeIs('admin.instruments.index')"
                            :class="request()->routeIs('admin.instruments.index') ? 'active' : ''">
                            <i class="fas fa-drum mr-1"></i>
                            {{ __('Instruments') }}
                        </x-responsive-nav-link>

                        {{--Database--}}
                        <x-responsive-nav-link
                            :href="route('admin.database')"
                            :active="request()->routeIs('admin.database')"
                            :class="request()->routeIs('admin.database') ? 'active' : ''">
                            <i class="fas fa-database mr-1"></i>
                            {{ __('Database') }}
                        </x-responsive-nav-link>

                        {{--Users--}}
                        <x-responsive-nav-link
                            :href="route('admin.users.index')"
                            :active="request()->routeIs('admin.users.index')"
                            :class="request()->routeIs('admin.users.index') ? 'active' : ''">
                            <i class="fas fa-users mr-1"></i>
                            {{ __('Users') }}
                        </x-responsive-nav-link>

                        {{-- Teachers --}}
                        <x-responsive-nav-link
                            :href="route('admin.teachers.index')"
                            :active="request()->routeIs('admin.teachers.index')"
                            :class="request()->routeIs('admin.teachers.index') ? 'active' : ''">
                            <i class="fas fa-chalkboard-teacher mr-1"></i>
                            {{ __('Teachers') }}
                        </x-responsive-nav-link>

                        {{-- Parents --}}
                        <x-responsive-nav-link
                            :href="route('admin.parents.index')"
                            :active="request()->routeIs('admin.parents.index')"
                            :class="request()->routeIs('admin.parents.index') ? 'active' : ''">
                            <i class="fas fa-user-friends mr-1"></i>
                            {{ __('Parents') }}
                        </x-responsive-nav-link>

                        {{-- Students --}}
                        <x-responsive-nav-link
                            :href="route('admin.students.index')"
                            :active="request()->routeIs('admin.students.index')"
                            :class="request()->routeIs('admin.students.index') ? 'active' : ''">
                            <i class="fas fa-user-graduate mr-1"></i>
                            {{ __('Students') }}
                        </x-responsive-nav-link>
                    @endif
                @endauth

                <div class="border-t border-gray-100 my-2"></div>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
