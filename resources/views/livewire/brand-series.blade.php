<div class="flex">
    <div class="mb-4 mr-4 w-1/2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
            {{ __('Choose Brand') }}
        </label>
        <div class="relative">
            <select wire:model="brand" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="brand" id="brandSelect" required>
                <option value="">{{ __('Choose Brand') }}</option>
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
    <div class="mb-4 w-1/2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="series">
            {{ __('Choose Series') }}
        </label>
        <div class="relative">
            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="series" id="series" required>
                @forelse ($series as $serie)
                <option value="{{ $serie->id }}">{{ $serie->name }}</option>
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
</div>