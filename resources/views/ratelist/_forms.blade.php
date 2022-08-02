<div class="flex flex-col">
  <div class="forms flex flex-col sm:flex-row ">
    @can('ratelist.store')
    <form class="p-5 border bg-slate-300 rounded-lg m-2 border-gray-400 w-full sm:w-3/5" action="{{ route('ratelist.store') }}" method="POST">
      @csrf
      <div class="flex">
        <div class="mb-4 w-full">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
            {{ __('Name') }}
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="{{ __('Enter Name') }}" required>
        </div>

        <div class="mb-4 mx-2 w-full">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
            {{ __('Price') }}
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="price" name="price" type="number" step="0.01" min="0" placeholder="{{ __('Enter Price') }}" required>
        </div>

        <div class="mb-4 w-full">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
            {{ __('Min Price') }}
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="min_price" name="min_price" type="number" step="0.01" min="0" placeholder="{{ __('Enter Min Price') }}" required>
        </div>

      </div>

      <livewire:brand-series />
      <div class="flex items-center justify-between">
        <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          Submit
        </button>
      </div>
    </form>
    @endcan
    @can('ratelist.import')
    <form class="p-5 border bg-slate-300 rounded-lg m-2 border-gray-400 w-full sm:w-2/5" action="{{ route('ratelist.import') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-4 relative">
        <a class="absolute right-0 top-0 underline" href="{{ asset('samples/rate.xlsx') }}" download="Sample Rate List">Download Sample</a>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="ratelist_import">
          {{ __('RateList XLSX File') }}
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="ratelist_import" name="ratelist_import" type="file" placeholder="Text input" required>
      </div>
      <div class="flex items-center justify-between">
        <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          Submit
        </button>
      </div>
    </form>
    @endcan
  </div>
</div>