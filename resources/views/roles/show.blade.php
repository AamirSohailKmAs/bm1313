<x-admin-layout>
  <section class="content">
    <div class="card">
      <!-- /.card-header -->
      <!-- form start -->
      <div class="card-header">
        <div class="flex justify-center">
          <div>
            Role Name
            <br>
            {{ $role->name }}
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="custom-control custom-checkbox mb-5">
          <input class="custom-control-input multi_permissions" type="checkbox" id="multi_permissions" value=".permissions">
          <label for="multi_permissions" class="custom-control-label">Select ALL Permissions</label>
        </div>
        @foreach($groupPermissions as $group => $permissions)
        <div class="flex items-center my-2 border-b border-black">
          <div class="sm:w-1/4">
            <input class="multi_permissions" type="checkbox" id="{{ $group }}" value=".{{ $group }}">
            <label for="{{ $group }}" class="">{{ ucfirst($group) }} Permissions</label>
          </div>
          <div class="sm:w-3/4 flex flex-wrap">
            @foreach ($permissions as $key => $permission)
            <div class="sm:w-1/4  items-center @if (!$permission->is_visible) {{ 'hidden' }} @else flex @endif">
              <input class="permissions {{ $permission->uses }}" type="checkbox" name="permission[{{ $permission->name }}]" value="{{ $permission->name }}" id="{{ $permission->name }}" data-po-uses="{{ $permission->uses }}" data-po-short=".{{ $permission->short }}" checked disabled>
              <label for="{{ $permission->name }}" class="px-2">
                {{ ucwords(str_replace('.', " ", $permission->name)) }}
              </label>
            </div>
            @endforeach
          </div>
        </div>
        @endforeach
      </div>
      <!-- /.card-body -->
      <div class="card-footer m-3">
        <a class="text-white font-semibold px-3 m-3 py-2 rounded-md hover:text-white cursor-pointer bg-blue-700 hover:bg-blue-500" href="{{ route('roles.edit', $role) }}">
          Edit
        </a>
        <a href="{{ route('roles.index') }}" class="btn btn-default">Back</a>
      </div>
    </div>
  </section>
  <!-- /.content -->
</x-admin-layout>