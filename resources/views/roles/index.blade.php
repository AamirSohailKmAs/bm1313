<x-admin-layout>
  <div class="flex p-3 w-full justify-center">
    <a class="text-white font-semibold px-3 py-2 rounded-md hover:text-white cursor-pointer bg-blue-700 hover:bg-blue-500" href="{{ route('roles.create') }}">
      Create New Role
    </a>
  </div>
  <table class="overflow-hidden shadow-md w-full">
    <thead>
      <tr>
        <th class="py-2 bg-brandPrimary text-white border border-black">{{ __('Name') }}</th>
        <th class="py-2 bg-brandPrimary text-white border border-black" colspan="2">{{ __('Action') }}</th>
      </tr>
    </thead>
    <tbody class="text-center" id="searchTable">

      @forelse ($roles as $role)
      <tr>
        <td class="py-2 border border-black">{{ $role->name }}</td>
        <td class="py-2 border border-black"><a class="edit bg-brandYellow font-semibold px-4 py-1 rounded-md hover:bg-yellow-700 hover:text-white" href="{{ route('roles.edit', $role) }}">{{ __('Edit') }}</a></td>
      </tr>
      @empty
      <tr>
        <td class="py-3" colspan="3">
          {{ __('No Role Found') }}
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>
</x-admin-layout>