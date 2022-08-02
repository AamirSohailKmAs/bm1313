<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? __('Admin Panel') }}</title>
  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="/css/style.css">
  <livewire:styles />
</head>

<body>
  <div class="relative min-h-screen md:flex" data-dev-hint="container">
    <input type="checkbox" id="menu-open" class="hidden" />

    <label for="menu-open" class="fixed right-2 bottom-2 shadow-lg rounded-full p-2 bg-gray-100 text-gray-600 md:hidden" data-dev-hint="floating action button">
      <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </label>

    <header class="bg-brandPrimary text-gray-100 flex justify-between md:hidden" data-dev-hint="mobile menu bar">
      <a href="#" class="block p-4 text-white font-bold whitespace-nowrap truncate">
        {{ env('APP_NAME') }}
      </a>

      <label for="menu-open" id="mobile-menu-button" class="m-2 p-2 focus:outline-none hover:text-white hover:bg-gray-700 rounded-md">
        <svg id="menu-open-icon" class="h-6 w-6 transition duration-200 ease-in-out" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg id="menu-close-icon" class="h-6 w-6 transition duration-200 ease-in-out" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </label>
    </header>

    <aside id="sidebar" class="bg-brandPrimary text-gray-100 md:w-64 w-3/4 space-y-6 px-0 absolute inset-y-0 left-0 transform md:relative md:translate-x-0 transition duration-200 ease-in-out z-50 md:flex md:flex-col md:justify-between overflow-y-auto" data-dev-hint="sidebar; px-0 for frameless; px-2 for visually inset the navigation">
      <div class="flex flex-col " data-dev-hint="optional div for having an extra footer navigation">
        <a href="#" class="bg-brandSecondary text-white flex items-center space-x-2 p-4" title="{{ env('APP_NAME') }}">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
          </svg>
          <span class="text-2xl font-extrabold whitespace-nowrap truncate">{{ env('APP_NAME') }}</span>
        </a>

        <ul class="menu-tree font-bold" id="menuTree" data-dev-hint="main navigation">
          @can('dashboard')
          <x-sidebar-li route="{{ route('dashboard') }}" value="{{ __('Dashboard') }}" :class="(request()->segment(1) == 'dashboard') ? 'active':''" />
          @endcan
          @can('users.index')
          <x-sidebar-li route="{{ route('users.index') }}" value="{{ __('Manage Users') }}" :class="(request()->segment(1) == 'users') ? 'active':''" />
          @endcan
          @can('roles.index')
          <x-sidebar-li route="{{ route('roles.index') }}" value="{{ __('Manage Roles') }}" :class="(request()->segment(1) == 'roles') ? 'active':''" />
          @endcan
          @can('teams.index')
          <x-sidebar-li route="{{ route('teams.index') }}" value="{{ __('Manage Teams') }}" :class="(request()->segment(1) == 'teams') ? 'active':''" />
          @endcan
          @can('pos.dropdown')
          <x-sidebar-li route="{{ route('pos.dropdown') }}" value="{{ __('POS Dropdown') }}" :class="(request()->segment(1) == 'pos-dropdown') ? 'active':''" />
          @endcan
          @can('categories.store')
          <x-sidebar-li route="{{ route('categories.create') }}" value="{{ __('Manage Brand/Series') }}" :class="(request()->segment(1) == 'categories') ? 'active':''" />
          @endcan
          @can('ratelist.store')
          <x-sidebar-li route="{{ route('ratelist.create') }}" value="{{ __('Manage Rate List') }}" :class="(request()->segment(1) == 'ratelist') ? 'active':''" />
          @endcan
          @can('logout')
          <x-sidebar-li route="{{ route('logout') }}" value="{{ __('Logout') }}" :class="'bg-red-600'" />
          @endcan
        </ul>
      </div>

      <!-- <nav data-dev-hint="second-main-navigation or footer navigation">
                <a href="#" class="block py-2 px-4 transition duration-200 hover:bg-gray-700 hover:text-white">
                    asd
                </a>
                <a href="#" class="block py-2 px-4 transition duration-200 hover:bg-gray-700 hover:text-white">
                    asd
                </a>
                <a href="#" class="block py-2 px-4 transition duration-200 hover:bg-gray-700 hover:text-white">
                    asd
                </a>
            </nav> -->
    </aside>

    <section class="bg-slate-100 flex-1 overflow-auto p-3 lg:px-4">
      <x-alert-message />
      {{ $slot }}
    </section>
  </div>
  <script src="/js/vanilla.js"></script>
  {{ $scripts??'' }}
  <livewire:scripts />
</body>

</html>