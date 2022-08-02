<x-ticket-layout>
  <section class="container-fluid">
    <div class="row py-2">
      @can('tickets.history')
      <form class="row col-sm-8" method="post" id="kmashistory" action="{{ route('tickets.history') }}">
        @csrf
        <div class="col-sm-3">
          <label for="contact" class="form-label">{{ __('Search') }}</label>
        </div>
        <div class="col-sm-9">
          <input type="text" class="form-control search" name="contact" id="contact" placeholder="{{ __('Search') }}" value="{{ ($contact)?: '' }}">
        </div>
        <div class="col-sm-2">
          <label for="fromDate" class="form-label">From</label>
        </div>
        <div class="col-sm-4">
          <input type="date" class="form-control" name="fromDate" id="fromDate" value="{{ ($fromDate)?: '' }}">
        </div>
        <div class="col-sm-2">
          <label for="toDate" class="form-label">To</label>
        </div>
        <div class="col-sm-4">
          <input type="date" class="form-control" name="toDate" id="toDate" value="{{ ($toDate)?: '' }}">
        </div>
      </form>
      @endcan
      <div class="col-sm-2">
        <input type="submit" id="search" name="search" class="btn btn-success" value="{{ __('Search') }}">
      </div>
      <div class="col-sm-2">
        <button class="btn btn-danger">{{ __('Delete') }}</button>
      </div>
    </div>
    <br>
    <br>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="bg-primary text-white">
          <tr>
            <th>{{ __('Receipt No') }}</th>
            <th>{{ __('Date') }}</th>
            <th>{{ __('Entry Time') }}</th>
            <th>{{ __('Entry By') }}</th>
            <th>{{ __('Comments') }}</th>
            <th>{{ __('Total') }}</th>
            <th>{{ __('Received') }}</th>
            <th>{{ __('Balance') }}</th>
            <th>{{ __('Model') }}</th>
            <th colspan="3">{{ __('Actions') }}</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($tickets as $ticket)
          <tr>
            <td>{{ $ticket->ticket_id }}</td>
            <td>{{ $ticket->created_at->toDateString() }}</td>
            <td>{{ $ticket->created_at->toTimeString() }}</td>
            <td>{{ auth()->user()->name }}</td>
            <td>{{ $ticket->comments }}</td>
            <td>{{ $ticket->total }} EUR</td>
            <td>{{ $ticket->received }} EUR</td>
            <td>{{ $ticket->balance }} EUR</td>
            <td>{{ $ticket->model }}</td>
            <td>
              @can('tickets.show')
              <a class="btn btn-sm btn-primary" href="{{ route('tickets.show', $ticket) }}">{{ __('Print') }}</a>
              @endcan
            </td>
            @if ($ticket->created_at->toDateString() == date('Y-m-d'))
            <td>
              @can('tickets.destroy')
              <form class="inline-form" action="{{ route('tickets.destroy', $ticket) }}" method="post">
                @method('DELETE')
                @csrf
                <button class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
              </form>
              @endcan
            </td>
            @endif

          </tr>
          @empty
          <tr>
            <td colspan="12">{{ __('No Record Found') }}</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </section>
</x-ticket-layout>