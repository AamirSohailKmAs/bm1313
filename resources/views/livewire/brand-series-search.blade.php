<div class="flex flex-col w-full">
    <div class="flex justify-end items-center">
        <select wire:model="brand" class="px-3 border bg-slate-300 rounded-lg m-2 border-gray-400" id="brand_select">
            @forelse ($brands as $brand)
            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @empty
            @endforelse
        </select>
        <select wire:model="serie" class="px-3 border bg-slate-300 rounded-lg m-2 border-gray-400">
            <!-- <option value="">All</option> -->
            @forelse ($series as $serie)
            <option value="{{ $serie->id }}">{{ $serie->name }}</option>
            @empty
            @endforelse
        </select>
        <label class="text-gray-700 text-sm font-bold mx-4" for="searchTableBtn">
            {{ __('Search From List') }}
        </label>
        <input wire:model="search" class="shadow appearance-none border rounded py-2 px-3 bg-slate-100 border-slate-400 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Text input">
    </div>
    <table class="overflow-hidden shadow-md">
        <thead>
            <tr>
                <th class="py-2 w-24 bg-brandPrimary text-white border border-black">{{ __('Brand') }}</th>
                <th class="py-2 w-24 bg-brandPrimary text-white border border-black">{{ __('Series') }}</th>
                <th class="py-2 w-24 bg-brandPrimary text-white border border-black">{{ __('Name') }}</th>
                <th class="py-2 w-24 bg-brandPrimary text-white border border-black">{{ __('Price') }}</th>
                <th class="py-2 w-24 bg-brandPrimary text-white border border-black">{{ __('Min Price') }}</th>
                @can('ratelist.destroy')
                <th class="py-2 w-24 bg-brandPrimary text-white border border-black" colspan="2">{{ __('Action') }}</th>
                @endcan
            </tr>
        </thead>
        <tbody class="text-center" id="searchTable">
            @forelse ($categories as $index => $category)
            <tr>
                <td class="py-2 w-24 border border-black">{{ $category->series->parent->name }}</td>
                <td class="py-2 w-24 border border-black">{{ $category->series->name }}</td>
                <td class="py-2 w-24 border border-black">
                    @if ($editedRatelistIndex === $index)
                    <input wire:model.defer="categories.{{$index}}.name" class="ring-1 rounded-lg px-3 py-1" type="text">
                    @else
                    {{ $category->name }}
                    @endif
                </td>
                <td class="py-2 w-24 border border-black">
                    @if ($editedRatelistIndex === $index)
                    <input wire:model.defer="categories.{{$index}}.price" class="ring-1 rounded-lg px-3 py-1" type="number">
                    @else
                    {{ $category->price }}
                    @endif
                </td>
                <td class="py-2 w-24 border border-black">
                    @if ($editedRatelistIndex === $index)
                    <input wire:model.defer="categories.{{$index}}.min_price" class="ring-1 rounded-lg px-3 py-1" type="number">
                    @else
                    {{ $category->min_price }}
                    @endif
                </td>
                @can('ratelist.update')
                <td class="py-2 w-24 border border-black">
                    @if ($editedRatelistIndex === $index)
                    <button wire:click="updateRatelist({{ $index }})" class="bg-green-500 font-semibold px-3 rounded-md hover:bg-green-700 hover:text-white">{{ __('Update') }}</button>
                    @else
                    <button wire:click="editRatelistIndex({{ $index }})" class="bg-brandYellow font-semibold px-3 rounded-md hover:bg-yellow-700 hover:text-white">{{ __('Edit') }}</button>
                    @endif

                </td>
                @endcan
                @can('ratelist.destroy')
                <td class="py-2 w-24 border border-black">
                    <form action="{{ route('ratelist.destroy', $category->id) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="bg-red-600 text-white font-semibold px-3 rounded-md hover:bg-red-900" type="submit">{{ __('Delete') }}</button>
                    </form>
                </td>
                @endcan
            </tr>
            @empty
            <td colspan="6" class="py-2 w-24 border border-black">{{ __('No Record Found') }}</td>
            @endforelse
        </tbody>
    </table>
</div>