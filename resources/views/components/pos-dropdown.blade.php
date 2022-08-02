<div class="border border-gray-400 rounded-lg overflow-hidden h-fit flex flex-col sm:w-1/3 mx-1 my-4">
    <form class="p-5 bg-slate-300" action="{{ $route }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="" id="{{ $attributes['name'] }}-id">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $attributes['name'] }}-name">
                {{ $attributes['name'] }}
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="{{ $attributes['name'] }}-name" name="name" type="text" placeholder="Text input" required>

        </div>
        <div class="flex items-center justify-between">
            <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                {{ __('Submit') }}
            </button>
        </div>
    </form>
    <table class="mt-4 overflow-hidden">
        <thead>
            <tr>
                <th class="py-2 bg-brandPrimary text-white border border-black">Sr.</th>
                <th class="py-2 bg-brandPrimary text-white border border-black">Name</th>
                <th class="py-2 bg-brandPrimary text-white border border-black">Action</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @forelse ($items as $item)
            <tr>
                <td class="py-2 border border-black">{{ $item->id }}</td>
                <td class="py-2 border border-black">{{ __($item->name) }}</td>
                <td class="py-2 border border-black"><button class="edit bg-brandYellow font-semibold px-3 rounded-md hover:bg-yellow-700 hover:text-white" data-target="{{ $attributes['name'] }}">{{ __('Edit') }}</button></td>
            </tr>
            @empty
            <td colspan="3" class="py-2 border border-black">{{ __('No Record Found') }}</td>
            @endforelse
        </tbody>
    </table>
</div>