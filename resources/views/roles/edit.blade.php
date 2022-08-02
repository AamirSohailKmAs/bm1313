<x-admin-layout>
  <section class="content">
    <div class="card">
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('roles.update', $role) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-header">
          <div class="flex justify-center">
            <div>
              <x-label.default class="px-2" for="name" value="Role Name" />
              <x-input.default class="px-2" type="text" name="name" id="name" value="{{ $role->name }}" placeholder="Enter Role Name" required />
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input multi_permissions" type="checkbox" id="multi_permissions" value=".permissions">
            <label for="multi_permissions" class="custom-control-label">Select ALL Permissions</label>
          </div>
          @foreach($groupPermissions as $group => $permissions)
          <div class="flex items-center justify-between my-2 border-b border-black">
            <div class="sm:w-1/4 p-2">
              <input class="multi_permissions" type="checkbox" id="{{ $group }}" value=".{{ $group }}">
              <label for="{{ $group }}" class="">{{ ucfirst($group) }}</label>
            </div>
            <div class="sm:w-3/4 p-2 flex flex-wrap flex-col sm:flex-row">
              @foreach ($permissions as $key => $permission)
              <div class="sm:w-1/4 items-center flex">
                <input class="permissions {{ $permission->uses }}" type="checkbox" name="permission[{{ $permission->name }}]" value="{{ $permission->name }}" id="{{ $permission->name }}" data-po-uses="{{ $permission->uses }}" data-po-short=".{{ $permission->short }}" @checked(in_array($permission->name, $rolePermissions))>
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
        <div class="card-footer">
          <x-button.default class="bg-blue-700 hover:bg-blue-500" type="submit" value="Update Role" />
          <a href="{{ route('roles.index') }}" class="btn btn-default">Back</a>
        </div>
      </form>
    </div>
  </section>
  <!-- /.content -->
  <x-slot:scripts>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.multi_permissions').on('click', function() {
          let poTarget = this.value;
          console.log(poTarget);
          if ($(this).is(':checked')) {
            $.each($(poTarget), function() {
              $(this).prop('checked', true);
            });
          } else {
            $.each($(poTarget), function() {
              $(this).prop('checked', false);
            });
          }
        });
        $('.permissions').on('click', function() {
          console.log('clicked');
          let short = $(this).data('po-short');
          let uses = $(this).data('po-uses');
          if (short != ".") {
            let poTarget = document.getElementById(uses + short);
            console.log(uses + short);
            if ($(this).is(':checked')) {
              $(poTarget).prop('checked', true);
            } else {
              $(poTarget).prop('checked', false);
            }
          }
          // if ($(this).is(':checked')) {
          //   $.each($(), function() {
          //     $(this).prop('checked', true);
          //   });
          // } else {
          //   $.each($(poTarget), function() {
          //     $(this).prop('checked', );
          //   });
          // }
        });
      });
    </script>
  </x-slot:scripts>
</x-admin-layout>