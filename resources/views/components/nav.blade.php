<nav class="navbar bg-brandPrimary flex items-center justify-around py-1">
    <h1 class="brand text-2xl">{{ auth()->user()->name }}</h1>
    <div class="date-time">
        <div class="font-bold text-xl text-white" id="clock"></div>
        <div class="font-bold text-white" id="daten"></div>
    </div>
    @can('sales.index')
    <a href="{{ route('sales.index', auth()->id()) }}" class="text-white no-underline inline-block rounded-xl {{ $summaryActive ?? 'bg-green-700' }} px-4 py-1 font-semibold active:bg-cyan-700">Summary</a>
    @endcan
    @can('credits.store')
    <a href="{{ route('credits.create') }}" class="text-white no-underline inline-block rounded-xl bg-blue-700 px-4 py-1 font-semibold ">Credit</a>
    @endcan
    @can('tickets.store')
    <a href="{{ route('tickets.create') }}" class="text-white no-underline inline-block rounded-xl bg-yellow-700 px-4 py-1 font-semibold ">Ticket</a>
    @endcan
    @can('orders.store')
    <a href="{{ route('orders.create') }}" class="text-white no-underline inline-block rounded-xl {{ $posActive ?? 'bg-green-700' }} px-4 py-1 font-semibold ">POS</a>
    @endcan
    @can('ratelist.index')
    <a href="{{ route('ratelist.index') }}" class="text-white no-underline inline-block rounded-xl {{ $listActive ?? 'bg-pink-600' }} px-4 py-1 font-semibold ">List</a>
    @endcan
    @can('return.store')
    <a href="{{ route('return.create') }}" class="text-white no-underline inline-block rounded-xl  {{ $returnActive ?? 'bg-green-700' }} px-4 py-1 font-semibold ">Return</a>
    @endcan
    @can('orders.index')
    <a href="{{ route('orders.index') }}" class="text-white no-underline inline-block rounded-xl {{ $todayActive ?? 'bg-green-700' }} px-4 py-1 font-semibold ">End of Day</a>
    @endcan
    @can('logout')
    <a href="{{ route('logout') }}" class="text-white no-underline inline-block rounded-xl bg-red-700 px-4 py-1 font-semibold">Logout</a>
    @endcan
</nav>