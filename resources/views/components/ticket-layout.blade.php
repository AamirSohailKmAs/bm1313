<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ticket</title>
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/ticket.css">
  {{ $extraStyle ?? "" }}
</head>

<body class="{{ $bodyClass ?? ''}}">
  <x-error-message />
  <nav class="navbar bg-brandPrimary d-flex align-items-center justify-content-around py-1">
    <h3 class="brand text-white">{{ auth()->user()->name }}</h3>
    <div class="date-time">
      <div class="fw-bold lead text-white" id="clock"></div>
      <div class="fw-bold text-white" id="daten"></div>
    </div>
    @can('sales.index')
    <a href="{{ route('sales.index', auth()->id()) }}" class="text-white text-decoration-none inline-block rounded-pill {{ $summaryActive ?? 'bg-green-700' }} px-3 py-1 fw-boldactive:bg-cyan-700">Summary</a>
    @endcan
    @can('credits.store')
    <a href="{{ route('credits.create') }}" class="text-white text-decoration-none inline-block rounded-pill bg-blue-700 px-3 py-1 fw-bold">Credit</a>
    @endcan
    @can('tickets.store')
    <a href="{{ route('tickets.create') }}" class="text-white text-decoration-none inline-block rounded-pill bg-yellow-700 px-3 py-1 fw-bold">Ticket</a>
    @endcan

    <!-- <a href="{{-- route('tickets.cdtho') --}}" class="text-white text-decoration-none inline-block rounded-pill bg-primary px-3 py-1 fw-bold">CDTHO</a> -->
    @can('orders.store')
    <a href="{{ route('orders.create') }}" class="text-white text-decoration-none inline-block rounded-pill {{ $posActive ?? 'bg-green-700' }} px-3 py-1 fw-bold">POS</a>
    @endcan
    @can('ratelist.index')
    <a href="{{ route('ratelist.index') }}" class="text-white text-decoration-none inline-block rounded-pill {{ $listActive ?? 'bg-pink-600' }} px-3 py-1 fw-bold">List</a>
    @endcan
    @can('return.store')
    <a href="{{ route('return.create') }}" class="text-white text-decoration-none inline-block rounded-pill  {{ $returnActive ?? 'bg-green-700' }} px-3 py-1 fw-bold">Return</a>
    @endcan
    @can('orders.index')
    <a href="{{ route('orders.index') }}" class="text-white text-decoration-none inline-block rounded-pill {{ $todayActive ?? 'bg-green-700' }} px-3 py-1 fw-bold">End of Day</a>
    @endcan
    @can('logout')
    <a href="{{ route('logout') }}" class="text-white text-decoration-none inline-block rounded-pill bg-red-700 px-3 py-1 fw-bold">Logout</a>
    @endcan
  </nav>

  {{ $slot }}
  <!-- <script src=" /js/bootstrap.min.js"></script> -->
  <script src="/js/jquery-3.6.0.min.js"></script>
  <script src="/js/ticket.js"></script>
  {{ $extraScript ?? "" }}
</body>

</html>