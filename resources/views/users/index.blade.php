<x-admin-layout>
  @can('users.store')
  <div class="flex p-3 w-full justify-center">
    <x-anchor.button class="bg-blue-700 hover:bg-blue-500" value="Create New User" href="{{ route('users.create') }}" />
  </div>
  @endcan
  <table class="overflow-hidden shadow-md w-full">
    <thead>
      <tr>
        <th class="py-2 bg-brandPrimary text-white border border-black">{{ __('Name') }}</th>
        <th class="py-2 bg-brandPrimary text-white border border-black">{{ __('Username') }}</th>
        <th class="py-2 bg-brandPrimary text-white border border-black">{{ __('Role') }}</th>
        @can('users.update')
        <th class="py-2 bg-brandPrimary text-white border border-black" colspan="2">{{ __('Action') }}</th>
        @endcan
      </tr>
    </thead>
    <tbody class="text-center" id="searchTable">
      @forelse ($users as $user)
      <tr>
        <td class="py-2 border border-black">{{ $user->name }}</td>
        <td class="py-2 border border-black">{{ $user->username }}</td>
        <td class="py-2 border border-black">
          @forelse($user->roles as $role)
          <span class="badge bg-primary">{{ $role->name }}</span>
          @empty
          @endforelse
        </td>
        @can('users.update')
        <td class="py-2 border border-black"><a class="edit bg-brandYellow font-semibold px-3 rounded-md hover:bg-yellow-700 hover:text-white" href="{{ route('users.edit', $user) }}">{{ __('Edit') }}</a></td>
        @endcan
      </tr>
      @empty
      <tr>
        <td class="py-3" colspan="5">
          {{ __('No User Found') }}
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>
</x-admin-layout>