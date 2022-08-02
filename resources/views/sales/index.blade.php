<x-app-layout>
    <x-slot:bodyClass>
        summary
        </x-slot>
        <x-slot:header>
            <header class="bg-brandSecondary fixed top-0 w-full border-black px-3 text-center font-bold text-white">
                <x-nav>
                    <x-slot:todayActive>
                        bg-blue-700
                        </x-slot>
                </x-nav>
                <div class="header-after"></div>
            </header>
            </x-slot>
            @include('sales._salesTable')
</x-app-layout>