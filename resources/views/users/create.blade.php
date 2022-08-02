<x-admin-layout>
  <form class="p-5 border bg-slate-300 rounded-lg mb-2 border-gray-400 w-full" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="flex flex-col md:flex-row">
      <div class="mb-4 w-full">
        <x-label.default for="name">{{ __('Name') }}</x-label.default>
        <x-input.default id="name" name="name" value="{{ old('name') }}" placeholder="{{ __('Enter Name') }}" required />
      </div>

      <div class="mb-4 mx-2 w-full">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
          {{ __('Username') }}
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" name="username" type="text" value="{{ old('username') }}" placeholder="{{ __('Enter Username') }}" required>
      </div>

      <div class="mb-4 mx-2 w-full">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
          {{ __('Password') }}
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" type="text" placeholder="{{ __('Enter Password') }}" required>
      </div>

    </div>


    <div class="flex flex-col md:flex-row">
      <div class="mb-4 w-full">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="contact">
          {{ __('Contact') }}
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="contact" name="contact" type="text" value="{{ old('contact') }}" placeholder="{{ __('Enter Contact') }}">
      </div>

      <div class="mb-4 mx-2 w-full">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="store_id">
          {{ __('Store ID') }}
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="store_id" name="store_id" type="number" min="1" value="{{ old('store_id') }}" placeholder="{{ __('Enter Store ID') }}">
      </div>

      <div class="mb-4 mx-2 w-full">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="store_name">
          {{ __('Store Name') }}
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="store_name" name="store_name" type="text" value="{{ old('store_name') }}" placeholder="{{ __('Enter Store Name') }}">
      </div>

      <div class="mb-4 mx-2 w-full">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="store_address">
          {{ __('Store Address') }}
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="store_address" name="store_address" type="text" value="{{ old('store_address') }}" placeholder="{{ __('Enter Store Address') }}">
      </div>

    </div>



    <div class="flex flex-col justify-between sm:flex-row">

      <div class="mb-4 mx-2 ">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="store_barcode">
          {{ __('Store Barcode') }}
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="store_barcode" name="store_barcode" type="file">
      </div>

      <div class="mb-4">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="role">
          {{ __('Choose Role') }}
        </label>
        <div class="relative">
          <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="role" id="role">
            @forelse ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
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

      <div class="mb-4">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="language">
          {{ __('Choose Language') }}
        </label>
        <div class="relative">
          <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="language" id="language">
            @forelse (config('app.languages') as $langLocale => $langName)
            <option value="{{ $langLocale }}">{{ $langName }}</option>
            @empty
            <option value="pt">Portuguese</option>
            @endforelse
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
              <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
            </svg>
          </div>
        </div>
      </div>
      <label class="block p-4">
        <input class="mr-2 leading-tight" type="checkbox" name="active" id="active" checked>
        <span class="text-sm">
          {{ __('Active') }}
        </span>
      </label>
    </div>
    <div class="card-body">
      <div class="custom-control custom-checkbox mb-5">
        <input class="custom-control-input multi_permissions" type="checkbox" id="multi_permissions" value=".permissions">
        <label for="multi_permissions" class="custom-control-label">Select ALL Permissions</label>
      </div>
      @foreach($grouppermissions as $group => $permissions)
      <div class="flex items-center my-2 border-b border-black">
        <div class="sm:w-1/4">
          <input class="multi_permissions" type="checkbox" id="{{ $group }}" value=".{{ $group }}">
          <label for="{{ $group }}" class="">{{ ucfirst($group) }} Permissions</label>
        </div>
        <div class="sm:w-3/4 flex flex-wrap">
          @foreach ($permissions as $key => $permission)
          <div class="sm:w-1/4  items-center flex">
            <input class="permissions {{ $permission->uses }}" type="checkbox" name="permission[{{ $permission->name }}]" value="{{ $permission->name }}" id="{{ $permission->name }}" data-po-uses="{{ $permission->uses }}" data-po-short=".{{ $permission->short }}">
            <label for="{{ $permission->name }}" class="px-2">
              {{ ucwords(str_replace('.', " ", $permission->name)) }}
            </label>
          </div>
          @endforeach
        </div>
      </div>
      @endforeach
    </div>
    <div class="flex items-center justify-between">
      <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
        Submit
      </button>
    </div>
  </form>
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