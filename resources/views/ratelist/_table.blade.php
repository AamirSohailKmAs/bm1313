<div class="flex flex-col w-full">
  <div class="flex justify-end items-center">
    <select class="px-3 border bg-slate-300 rounded-lg m-2 border-gray-400" id="brand_select">
      <option value="">All</option>
      @forelse ($brands as $brand)
      <option value="{{ $brand->name }}">{{ $brand->name }}</option>
      @empty
      @endforelse
    </select>
    <label class="text-gray-700 text-sm font-bold mx-4" for="searchTableBtn">
      {{ __('Search From List') }}
    </label>
    <input class="shadow appearance-none border rounded py-2 px-3 bg-slate-100 border-slate-400 leading-tight focus:outline-none focus:shadow-outline" id="searchTableBtn" type="text" placeholder="Text input" required>
  </div>
  <table class="overflow-hidden shadow-md">
    <thead>
      <tr>
        <th class="py-2 bg-brandPrimary text-white border border-black">{{ __('Brand') }}</th>
        <th class="py-2 bg-brandPrimary text-white border border-black">{{ __('Series') }}</th>
        <th class="py-2 bg-brandPrimary text-white border border-black">{{ __('Name') }}</th>
        <th class="py-2 bg-brandPrimary text-white border border-black">{{ __('Price') }}</th>
        <th class="py-2 bg-brandPrimary text-white border border-black">{{ __('Min Price') }}</th>
        @can('ratelist.destroy')
        <th class="py-2 bg-brandPrimary text-white border border-black">{{ __('Action') }}</th>
        @endcan
      </tr>
    </thead>
    <tbody class="text-center" id="searchTable">
      @forelse ($categoryGroup as $categories)
      @foreach ($categories as $category)
      <tr>
        <td class="py-2 border border-black">{{ $category->series->parent->name }}</td>
        <td class="py-2 border border-black">{{ $category->series->name }}</td>
        <td class="py-2 border border-black">{{ $category->name }}</td>
        <td class="py-2 border border-black">{{ $category->price }}</td>
        <td class="py-2 border border-black">{{ $category->min_price }}</td>
        <!-- <td class="py-2 border border-black"><button class="edit bg-brandYellow font-semibold px-3 rounded-md hover:bg-yellow-700 hover:text-white" data-target="series">{{ __('Edit') }}</button></td> -->
        @can('ratelist.destroy')
        <td class="py-2 border border-black">
          <form action="{{ route('ratelist.destroy', $category->id) }}" method="post">
            @method('DELETE')
            @csrf
            <button class="bg-red-600 text-white font-semibold px-3 rounded-md hover:bg-red-900" type="submit">{{ __('Delete') }}</button>
          </form>
        </td>
        @endcan
      </tr>
      @endforeach
      @empty
      <td colspan="6" class="py-2 border border-black">{{ __('No Record Found') }}</td>
      @endforelse
    </tbody>
  </table>
</div>
<script>
  let select = document.getElementById('brand_select');
  select.addEventListener('change', tableFilter);

  let searchTableBtn = document.getElementById('searchTableBtn');
  searchTableBtn.addEventListener('keyup', tableFilter);

  function tableFilter(event) {
    let searchTable = document.getElementById('searchTable');
    let tr = searchTable.getElementsByTagName("tr");
    let filter = this.value.toLowerCase();
    for (let i = 0; i < tr.length; i++) {
      let txtValue = tr[i].textContent || tr[i].innerText;
      if (txtValue.toLowerCase().indexOf(filter) > -1) {
        tr[i].classList.remove("hidden");
      } else {
        tr[i].classList.add("hidden");
      }
    }
  }
</script>