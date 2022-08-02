<x-admin-layout>
  <div class="flex flex-col">
    <div class="forms flex flex-col sm:flex-row">
      @can('categories.store')
      <form class="p-5 border bg-slate-300 rounded-lg m-2 border-gray-400 w-full sm:w-1/2" action="{{ route('categories.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="" id="id">
        <div class="flex">
          <div class="mb-4 w-full">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
              {{ __('Brand Name') }}
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="Text input" required>
          </div>
          <div class="mb-4 mx-4 max-w-max min-w-max">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
              {{ __('Check If this is a Series.') }}
            </label>
            <label class="block mt-4">
              <input class="mr-2 leading-tight" type="checkbox" name="series" id="series">
              <span class="text-sm">
                {{ __('This is Series.') }}
              </span>
            </label>
          </div>
        </div>
        <div class="mb-4 hidden" id="brand">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
            {{ __('Choose Brand') }}
          </label>
          <div class="relative">
            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="brand" id="brandSelect">
              @forelse ($brands as $brand)
              <option value="{{ $brand->id }}">{{ $brand->name }}</option>
              @empty
              @endforelse
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
              </svg>
            </div>
          </div>
        </div>
        <div class="flex items-center justify-between">
          <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Submit
          </button>
        </div>
      </form>
      @endcan
      @can('categories.import')
      <form class="p-5 border bg-slate-300 rounded-lg m-2 border-gray-400 w-full sm:w-1/2" action="{{ route('categories.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4 relative">
          <a class="absolute right-0 top-0 underline" href="{{ asset('samples/category.xlsx') }}" download="Sample Brand Series">Download Sample</a>
          <label class="block text-gray-700 text-sm font-bold mb-2" for="category_import">
            {{ __('Category XLSX File') }}
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="category_import" name="category_import" type="file" placeholder="Text input" required>
        </div>
        <div class="flex items-center justify-between">
          <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Submit
          </button>
        </div>
      </form>
      @endcan
    </div>

    <table class="mt-4 overflow-hidden">
      <thead>
        <tr>
          <th class="py-2 bg-brandPrimary text-white border border-black">Id</th>
          <th class="py-2 bg-brandPrimary text-white border border-black">Brands</th>
          <th class="py-2 bg-brandPrimary text-white border border-black">Action</th>
        </tr>
      </thead>
      <tbody class="text-center">
        @forelse ($brands as $brand)
        <tr>
          <td class="py-2 border border-black">{{ $brand->id }}</td>
          <td class="py-2 border border-black">{{ __($brand->name) }}</td>
          <!-- <td class="py-2 border border-black"><button class="edit bg-brandYellow font-semibold px-3 rounded-md hover:bg-yellow-700 hover:text-white" data-target="brand">{{ __('Edit') }}</button></td> -->
          <td class="py-2 border border-black">
            @can('categories.destroy')
            <form action="{{ route('categories.destroy', $brand->id) }}" method="post">
              @method('DELETE')
              @csrf
              <button class="bg-red-600 text-white font-semibold px-3 rounded-md hover:bg-red-900" type="submit">{{ __('Delete') }}</button>
            </form>
            @endcan
          </td>
        </tr>
        @empty
        <td colspan="3" class="py-2 border border-black">{{ __('No Record Found') }}</td>
        @endforelse
      </tbody>
    </table>
    <table class="mt-4 overflow-hidden">
      <thead>
        <tr>
          <th class="py-2 bg-brandPrimary text-white border border-black">Id</th>
          <th class="py-2 bg-brandPrimary text-white border border-black">Brand</th>
          <th class="py-2 bg-brandPrimary text-white border border-black">Series</th>
          <th class="py-2 bg-brandPrimary text-white border border-black">Action</th>
        </tr>
      </thead>
      <tbody class="text-center">
        @forelse ($categoryGroup as $categories)
        @foreach ($categories as $category)
        <tr>
          <td class="py-2 border border-black">{{ $category->id }}</td>
          <td class="py-2 border border-black">{{ $category->parent->name }}</td>
          <td class="py-2 border border-black">{{ __($category->name) }}</td>
          <!-- <td class="py-2 border border-black"><button class="edit bg-brandYellow font-semibold px-3 rounded-md hover:bg-yellow-700 hover:text-white" data-target="series">{{ __('Edit') }}</button></td> -->
          <td class="py-2 border border-black">
            @can('categories.destroy')
            <form action="{{ route('categories.destroy', $category->id) }}" method="post">
              @method('DELETE')
              @csrf
              <button class="bg-red-600 text-white font-semibold px-3 rounded-md hover:bg-red-900" type="submit">{{ __('Delete') }}</button>
            </form>
            @endcan
          </td>
        </tr>
        @endforeach
        @empty
        <td colspan="4" class="py-2 border border-black">{{ __('No Record Found') }}</td>
        @endforelse
      </tbody>
    </table>
  </div>
  <script>
    var isSeries = document.getElementById('series');
    let brandSelect = document.getElementById('brandSelect');
    let brand = document.getElementById('brand');
    let nameInput = document.getElementById('name');

    isSeries.addEventListener("click", openDivs);

    function openDivs() {
      console.log(nameInput);
      brandSelect.setAttribute('required', 'required');
      brand.classList.toggle('hidden');
      if (!isSeries.checked) {
        brandSelect.removeAttribute('required');
      }
    }
    document.querySelectorAll("button.edit").forEach(function(button, key, parent) {
      button.addEventListener('click', function(event) {
        let target = button.getAttribute('data-target');
        let idInput = document.getElementById('id');
        let nameInput = document.getElementById('name');
        let parentNode = button.parentNode.parentNode;
        let id = parentNode.firstElementChild.textContent;
        let brand = parentNode.firstElementChild.nextElementSibling.textContent;
        let series = button.parentElement.previousElementSibling.textContent;
        idInput.value = id;

        if (target == 'brand') {
          if (isSeries.checked) {
            isSeries.checked = false;
            openDivs();
          }
          nameInput.value = brand;
        } else if (target == 'series') {
          nameInput.value = series;
          isSeries.checked = true;
          openDivs();
        }



        console.log(brand);
        // idInput.value = id;
        // nameInput.value = name;
      });

    });

    function edit(params) {

    }
  </script>
</x-admin-layout>