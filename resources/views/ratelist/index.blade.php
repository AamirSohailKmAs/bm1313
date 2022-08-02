<x-app-layout>
  <x-slot:extraStyle>
    <livewire:styles />
    </x-slot>
    <x-slot:bodyClass>
      ratelist
      </x-slot>
      <x-slot:header>
        <header class="bg-brandSecondary fixed top-0 w-full border-black px-3 text-center font-bold text-white">
          <x-nav>
            <x-slot:rateActive>
              bg-pink-700
              </x-slot>
          </x-nav>


          <div class="header-after"></div>
        </header>
      </x-slot:header>
      <main class="tableFixHead flex px-3">
        <livewire:brand-series-search />
      </main>
      <x-slot:extraScript>
        <livewire:scripts />

        </x-slot>
</x-app-layout>