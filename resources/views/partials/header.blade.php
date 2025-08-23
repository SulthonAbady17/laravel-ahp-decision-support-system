<nav aria-label="Main navigation"
    class="bg-surface-alt border-outline dark:border-outline-dark dark:bg-surface-dark w-full border-b px-6 py-4"
    x-data="{ mobileMenuIsOpen: false }" x-on:click.away="mobileMenuIsOpen = false">
    <div class="mx-auto flex max-w-7xl items-center justify-between">
        <!-- Brand Logo -->
        <a class="text-on-surface-strong dark:text-on-surface-dark-strong text-2xl font-bold"
            href="{{ route('dashboard') }}">
            <span>SPK <span class="text-primary dark:text-primary-dark">PSM</span></span>
        </a>

        <!-- Desktop Menu -->
        <ul class="hidden items-center gap-6 sm:flex">
            @auth
                <li><x-link :route="'dashboard'">Dashboard</x-link></li>

                {{-- Tampilkan link ini hanya untuk Admin --}}
                @if (Auth::user()->role === 'admin')
                    <li><x-link :route="'admin.periods.index'">Periode</x-link></li>
                    <li><x-link :route="'admin.criteria.index'">Kriteria</x-link></li>
                @endif

                {{-- Dropdown Pengguna --}}
                <li>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="rounded-radius text-on-surface dark:text-on-surface-dark inline-flex items-center gap-2 whitespace-nowrap text-sm font-medium tracking-wide"
                                type="button">
                                <div>{{ Auth::user()->name }}</div>
                                <svg aria-hidden="true" class="h-4 w-4" fill="none" stroke-width="2"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.5 8.25l-7.5 7.5-7.5-7.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :route="'profile.edit'">Profile</x-dropdown-link>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <x-dropdown-link :route="'logout'"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </li>
            @else
                <li><x-button-link :route="'login'" variant="outline">Login</x-link></li>
                <li><x-button-link :route="'register'">Register</x-button-link></li>
            @endauth
        </ul>

        <!-- Mobile Menu Button -->
        <button aria-controls="mobileMenu" aria-label="mobile menu"
            class="text-on-surface dark:text-on-surface-dark flex sm:hidden" type="button"
            x-bind:aria-expanded="mobileMenuIsOpen" x-on:click="mobileMenuIsOpen = !mobileMenuIsOpen">
            <svg aria-hidden="true" class="size-6" fill="none" stroke-width="2" stroke="currentColor"
                viewBox="0 0 24 24" x-cloak x-show="!mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <svg aria-hidden="true" class="fixed right-6 top-6 z-20 size-6" fill="none" stroke-width="2"
                stroke="currentColor" viewBox="0 0 24 24" x-cloak x-show="mobileMenuIsOpen"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>

        <!-- Mobile Menu -->
        <ul class="divide-outline rounded-b-radius border-outline bg-surface-alt dark:divide-outline-dark dark:border-outline-dark dark:bg-surface-dark fixed inset-x-0 top-0 z-10 flex max-h-svh flex-col divide-y overflow-y-auto border-b px-6 pb-6 pt-20 sm:hidden"
            id="mobileMenu" x-cloak x-show="mobileMenuIsOpen" x-transition>
            @auth
                <li class="py-4"><a
                        class="text-on-surface dark:text-on-surface-dark w-full text-lg font-medium focus:underline"
                        href="{{ route('dashboard') }}">Dashboard</a></li>
                @if (Auth::user()->role === 'admin')
                    <li class="py-4"><a
                            class="text-on-surface dark:text-on-surface-dark w-full text-lg font-medium focus:underline"
                            href="{{ route('admin.periods.index') }}">Periode</a></li>
                    <li class="py-4"><a
                            class="text-on-surface dark:text-on-surface-dark w-full text-lg font-medium focus:underline"
                            href="{{ route('admin.criteria.index') }}">Kriteria</a></li>
                @endif
                <li class="py-4"><a
                        class="text-on-surface dark:text-on-surface-dark w-full text-lg font-medium focus:underline"
                        href="{{ route('profile.edit') }}">Profile</a></li>
                <li class="mt-4 w-full border-none">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button
                            class="rounded-radius border-primary bg-primary text-on-primary w-full border px-4 py-2 text-center font-medium tracking-wide"
                            type="submit">Log Out</button>
                    </form>
                </li>
            @else
                <li class="py-4"><a
                        class="text-on-surface dark:text-on-surface-dark w-full text-lg font-medium focus:underline"
                        href="{{ route('login') }}">Login</a></li>
                <li class="mt-4 w-full border-none"><a
                        class="rounded-radius border-primary bg-primary text-on-primary block border px-4 py-2 text-center font-medium tracking-wide"
                        href="{{ route('register') }}">Register</a></li>
            @endauth
        </ul>
    </div>
</nav>
