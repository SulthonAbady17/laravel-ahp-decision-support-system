<nav aria-label="Main navigation"
    class="bg-surface-alt border-outline dark:border-outline-dark dark:bg-surface-dark w-full border-b px-6 py-4"
    x-data="{ mobileMenuIsOpen: false }" x-on:click.away="mobileMenuIsOpen = false">
    <div class="mx-auto flex max-w-7xl items-center justify-between">
        <a class="text-on-surface-strong dark:text-on-surface-dark-strong text-2xl font-bold" href="{{ url('/') }}">
            <span>SPK <span class="text-primary dark:text-primary-dark">PSM</span></span>
        </a>

        <ul class="hidden items-center gap-6 sm:flex">
            @auth
                <li><x-link :route="'dashboard'">Dashboard</x-link></li>

                @if (Auth::user()->role === 'admin')
                    <li><x-link :route="'admin.periods.index'">Periode</x-link></li>
                @endif

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
                                <x-dropdown-link href="#"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </li>
            @else
                <li><x-link :route="'login'">Login</x-link></li>
                <li><x-button-link :route="'register'">Register</x-button-link></li>
            @endauth
        </ul>

        {{-- ... Tombol dan Menu Mobile ... --}}
    </div>
</nav>
