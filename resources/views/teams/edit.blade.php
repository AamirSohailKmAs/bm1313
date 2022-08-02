<x-admin-layout>
  <form class="p-5 border bg-slate-300 rounded-lg mb-2 border-gray-400 w-full" action="{{ route('teams.update', $team) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="flex flex-col md:flex-row">
      <div class="m-3 sm:w-1/2">
        <x-label.default for="name" value="{{ __('Team Name') }}" />
        <x-input.default id="name" name="name" value="{{ $team->name }}" placeholder="{{ __('Enter Name') }}" required />
      </div>
    </div>
    <div class="card-body">
      <div class="">{{ __("Team Members") }}</div>
      @forelse ($members as $member)
      <div class="sm:w-1/4  items-center">
        <input class="users" type="checkbox" name="user[{{ $member->id }}]" value="{{ $member->name }}" id="{{ $member->username }}" checked>
        <label for="{{ $member->username }}" class="px-2">
          {{ $member->name }}
        </label>
      </div>
      @empty
      {{ __('No Team Member Found') }}
      @endforelse
      <div class="">{{ __("Available Users") }}</div>

      @forelse ($users as $user)
      <div class="sm:w-1/4  items-center">
        <input class="users" type="checkbox" name="user[{{ $user->id }}]" value="{{ $user->name }}" id="{{ $user->username }}">
        <label for="{{ $user->username }}" class="px-2">
          {{ $user->name }}
        </label>
      </div>
      @empty

      @endforelse
    </div>
    <div class="flex items-center justify-between">
      <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
        Update
      </button>
    </div>
  </form>
</x-admin-layout>