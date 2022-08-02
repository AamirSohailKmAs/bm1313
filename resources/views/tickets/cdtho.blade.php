<x-ticket-layout>
  <section class="container mt-3">
    <form class="row" method="post" action="{{ route('tickets.cdtho') }}">
      @csrf
      <div class="col-1">
        <label for="contact" class="form-label">{{ __('Search') }}</label>
      </div>
      <div class="col-9">
        <input type="text" class="form-control search" name="contact" id="contact" placeholder="{{ __('Search') }}" value="{{ $contact ?? '' }}" required>
      </div>
      <div class="col-2">
        <input type="submit" name="search" class="btn btn-success" value="{{ __('Search') }}">
      </div>
    </form>
    <br><br>
    <div class="row cdtho">
      <div class="col-2">
        <span class="btn btn-danger">{{ __('Customer Details') }}</span>
      </div>
      <div class="col-4">
        <h3 class="fw-bolder text-center">{{ ($ticket) ? $ticket->client_name : '' }}</h3>
      </div>
      <div class="col-1">
        <span class="btn btn-danger">{{ __('Balance') }}</span>
      </div>
      <div class="col-5">
        <h3 class="fw-bolder text-center">{{ ($ticket) ? $ticket->balance.'&nbsp; EUR' : '' }}</h3>
      </div>
    </div>
    <div class="row cdtho">
      <div class="col-4">
        <span class="btn btn-sm btn-secondary">{{ __('Contact') }}</span>
      </div>
      <div class="col-4">
        <span class="btn  btn-sm btn-secondary">{{ __('Total') }}</span>
      </div>
      <div class="col-4">
        <span class="btn  btn-sm btn-secondary">{{ __('Received') }}</span>
      </div>
    </div>
    @if (!$ticket && $contact)
    <div class="row cdtho">
      <div class="col-12 text-center">
        <span class="fw-bolder">{{ __('No Record Found') }}</span>
      </div>
    </div>
    @endif
    <div class="row cdtho">
      <div class="col-4 text-center">
        <span class="fw-bolder">{{ ($ticket) ? $ticket->contact : '' }}</span>
      </div>
      <div class="col-4 text-center">
        <span class="fw-bolder">{{ ($ticket) ? $ticket->total.'&nbsp; EUR' : '' }} </span>
      </div>
      <div class="col-4 text-center">
        <span class="fw-bolder">{{ ($ticket) ? $ticket->received.'&nbsp; EUR' : '' }} </span>
      </div>
    </div>
    </div>

  </section>
</x-ticket-layout>