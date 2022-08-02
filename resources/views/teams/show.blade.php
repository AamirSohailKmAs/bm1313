<x-admin-layout>
  <div class="p-5 border bg-slate-300 rounded-lg mb-2 border-gray-400 w-full">
    <div class="flex flex-col sm:flex-row">
      <div class="sm:w-1/2 p-2 border rounded-lg">
        <div class="text-base font-semibold p-1">{{ __('Team Name') }}</div>
        <div class="text-base font-semibold p-1">{{ $team->name }}</div>
      </div>
      <div class="sm:w-1/2 p-2 border rounded-lg">
        <div class="text-base font-semibold p-1">{{ __('Team Owner') }}</div>
        <div class="text-base font-semibold p-1">{{ $team->owner->name }}</div>
      </div>
    </div>
    <div class="my-3">
      <h2 class="text-base font-semibold p-1">Team Members</h2>
      @forelse ($members as $member)
      <div class="items-center">
        <label for="{{ $member->username }}" class="px-2">
          {{ $member->name }}
        </label>
      </div>
      @empty
      @endforelse
    </div>
    <x-anchor.button class="text-black" value="Back" href="{{ route('teams.index') }}" />
  </div>
</x-admin-layout>