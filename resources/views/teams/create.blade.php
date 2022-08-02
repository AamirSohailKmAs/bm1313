<x-admin-layout>
  <form class="p-5 border bg-slate-300 rounded-lg mb-2 border-gray-400 w-full" action="{{ route('teams.store') }}" method="POST">
    @csrf
    <div class="flex flex-col md:flex-row">
      <div class="m-3 sm:w-1/2">
        <x-label.default for="name">{{ __('Team Name') }}</x-label.default>
        <x-input.default id="name" name="name" value="{{ old('name') }}" placeholder="{{ __('Enter Name') }}" required />
      </div>
      <div class="m-3 sm:w-1/2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="team_owner">
          {{ __('Choose Team Owner') }}
        </label>
        <div class="relative">
          <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="team_owner" id="team_owner" required>
            @forelse ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
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
    <div class="card-body">
      @forelse ($users as $user)
      <div class="sm:w-1/4  items-center">
        <input class="users" type="checkbox" name="user[{{ $user->id }}]" value="{{ $user->name }}" id="{{ $user->username }}">
        <label for="{{ $user->username }}" class="px-2">
          {{ $user->name }}
        </label>
      </div>
      @empty
      {{ __('No User Left') }}
      @endforelse
    </div>
    <div class="flex items-center justify-between">
      <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
        Submit
      </button>
    </div>
  </form>
</x-admin-layout>