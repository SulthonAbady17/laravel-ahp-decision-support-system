<div class="rounded-radius border-outline dark:border-outline-dark w-full overflow-hidden overflow-x-auto border">
    <table class="text-on-surface dark:text-on-surface-dark w-full text-left text-sm">

        {{-- Slot untuk Header Tabel --}}
        <thead
            class="border-outline bg-surface-alt text-on-surface-strong dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark-strong border-b text-sm">
            <tr>
                {{ $head }}
            </tr>
        </thead>

        {{-- Slot untuk Body Tabel --}}
        <tbody class="divide-outline dark:divide-outline-dark divide-y">
            {{ $body }}
        </tbody>

    </table>
</div>
