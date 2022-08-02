<x-admin-layout>
  @can('teams.store')
  <div class="flex p-3 w-full justify-center">
    <x-anchor.button class="bg-blue-700 hover:bg-blue-500" value="Create New Team" href="{{ route('teams.create') }}" />
  </div>
  @endcan
  <table class="overflow-hidden shadow-md w-full">
    <thead>
      <tr>
        <th class="py-2 bg-brandPrimary text-white border border-black">{{ __('Team Name') }}</th>
        <th class="py-2 bg-brandPrimary text-white border border-black">{{ __('Team Owner') }}</th>
        <th class="py-2 bg-brandPrimary text-white border border-black" colspan="2">{{ __('Action') }}</th>
      </tr>
    </thead>
    <tbody class="text-center" id="searchTable">
      @forelse ($teams as $team)
      <tr>
        <td class="py-2 border border-black">{{ $team->name }}</td>
        <td class="py-2 border border-black">{{ $team->owner->name }}</td>
        <td class="py-2 border border-black">
          @can('teams.show')
          <x-anchor.button class="bg-blue-700 hover:bg-blue-500" value="{{ __('Show') }}" href="{{ route('teams.show', $team) }}" />
          @endcan
        </td>
        <td class="py-2 border border-black">
          @can('teams.update')
          <x-anchor.button class="bg-brandYellow text-black hover:bg-yellow-700" value="{{ __('Edit') }}" href="{{ route('teams.edit', $team) }}" />
          @endcan
        </td>
      </tr>
      @empty
      <tr>
        <td class="text-center py-3" colspan="4">{{ __('No Team Found') }}</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</x-admin-layout>