<x-ticket-layout>
  <main>
    <!-- <div class="address-bar">
          <p>Store Id Store Name</p>
        </div> -->
    <section class="container-xl py-3">
      <form class="service-form" method="post" action="{{ route('tickets.store') }}">
        @csrf
        <div class="row service-form">
          <div class="col-md-4 client-div">
            <div class="form-header">
              <h5 class="">{{ __('Customer') }}</h5>
            </div>
            <div class="py-2">
              <div class="row">
                <label for="contact" class="col form-label">{{ __('Contact') }}</label>
                <button class="col btn btn-warning" id="search" onclick="event.preventDefault()">{{ __('Search') }}</button>
              </div>
              <input type="number" class="form-control" id="contact" name="contact" placeholder="{{ __('Contact') }}" required>
            </div>
            <div class="py-2">
              <label for="client_name" class="form-label">{{ __('Name') }}</label>
              <input type="text" class="form-control" id="client_name" name="client_name" placeholder="{{ __('Name') }}">
            </div>
            <div class="py-2">
              <label for="n_i_f" class="form-label">N.I.F.</label>
              <input type="text" class="form-control" id="n_i_f" name="n_i_f" placeholder="N.I.F.">
            </div>
            <div class="py-2">
              <label for="email" class="form-label">{{ __('Email') }}</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('Name') }}">
            </div>
            <div class="py-2">
              <label for="city" class="form-label">{{ __('City') }}</label>
              <input type="text" class="form-control" id="city" name="city" placeholder="{{ __('City') }}">
            </div>
            <div class="py-2">
              <label for="address" class="form-label">{{ __('Address') }}</label>
              <textarea name="address" id="address" cols="30" rows="3" class="form-control"></textarea>
            </div>
          </div>
          <div class="col-md-4 device-div">
            <div class="form-header">
              <h5 class="">{{ __('Device Details') }}</h5>
            </div>
            <div class="py-2">
              <label for="type" class="form-label">{{ __('Type') }}</label>
              <select id="type" name="type" class="form-select">
                <option value="{{ __('Mobile') }}">{{ __('Mobile') }}</option>
                <option value="{{ __('Tablet') }}">{{ __('Tablet') }}</option>
                <option value="{{ __('Laptop') }}">{{ __('Laptop') }}</option>
              </select>
            </div>
            <div class="py-2">
              <label for="mark" class="form-label">{{ __('Mark') }}</label>
              <input type="text" class="form-control" id="mark" name="mark" id="mark" placeholder="{{ __('Mark') }}">
            </div>
            <div class="py-2">
              <label for="model" class="form-label">{{ __('Model') }}</label>
              <input type="text" class="form-control" name="model" id="model" placeholder="{{ __('Model') }}">
            </div>
            <div class="py-2">
              <label for="imei_no" class="form-label me-1">IMEI NO.</label>
              <input type="number" class="form-control" name="imei_no" id="imei_no" placeholder="IMEI NO.">
            </div>
            <div class="py-2">
              <label for="warranty" class="form-label">{{ __('Warranty') }}</label>
              <select name="warranty" id="warranty" class="form-select">
                <option value="" selected></option>
                <option value="{{ __('Warranty') }}">{{ __('Warranty') }}</option>
                <option value="{{ __('No Warranty') }}">{{ __('No Warranty') }}</option>
              </select>
            </div>
            <div class="py-2">
              <label for="comments" class="form-label">{{ __('Comments') }}</label>
              <textarea name="comments" id="comments" rows="3" class="form-control"></textarea>
            </div>
          </div>
          <div class="col-md-4 breakdown-div">
            <div class="form-header">
              <h5 class="">{{ __('Breakdown') }}</h5>
            </div>
            <div class="px-2">
              <label for="repair" class="form-label">{{ __('Repair') }}</label>
              <input type="text" class="form-control" name="repair" id="repair" placeholder="{{ __('Repair') }}">
            </div>
            <div class="px-2">
              <label for="observ_of_damag" class="form-label">{{ __('Observation of Damages') }}</label>
              <input type="text" class="form-control" name="observ_of_damag" id="observ_of_damag" placeholder="{{ __('Observation of Damages') }}">
            </div>
            <div class="px-2">
              <label for="technician" class="form-label">{{ __('Technician') }}</label>
              <input type="text" class="form-control" name="technician" id="technician" placeholder="{{ __('Technician') }}">
            </div>
            <div class="px-2">
              <label for="deliver_date" class="form-label">{{ __('Delivery Date') }}</label>
              <input type="date" class="form-control" name="deliver_date" id="deliver_date" placeholder="{{ __('Delivery Date') }}">
            </div>
            <label for="payment" class="form-label">{{ __('Payment') }}</label>
            <div class="row pt-2 px-4">
              <div class="col-6 form-check">
                <input type="radio" class="form-check-input" id="payment-cash" name="payment" value="{{ __('Cash') }}" checked>{{ __('Cash') }}
                <label class="form-check-label" for="payment-cash"></label>
              </div>
              <div class="col-6 form-check">
                <input type="radio" class="form-check-input" id="paymentmultibank" name="payment" value="{{ __('MultiBank') }}">{{ __('MultiBank') }}
                <label class="form-check-label" for="paymentmultibank"></label>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <label for="total" class="form-label">{{ __('Total') }}</label>
                <input type="number" class="calc form-control" name="total" id="total" placeholder="{{ __('Total') }}">
              </div>
              <div class="col-4">
                <label for="received" class="form-label">{{ __('Received') }}</label>
                <input type="number" class="calc form-control" name="received" id="received" placeholder="{{ __('Received') }}">
              </div>
              <div class="col-4">
                <label for="balance" class="form-label">{{ __('Balance') }}</label>
                <input type="number" class="form-control" name="balance" id="balance" placeholder="{{ __('Balance') }}">
              </div>
            </div>
            <div class="row py-3">
              <div class="col-6 px-3">
                <input type="submit" value="{{ __('Save') }}" name="submit" class="btn btn-lg btn-success">
              </div>
              <div class="col-6 px-3">
                @can('tickets.index')
                <a type="button" class="btn btn-dark btn-lg" href="{{ route('tickets.index') }}">{{ __('History') }}</a>
                @endcan

              </div>
            </div>
          </div>
        </div>
      </form>
    </section>
  </main>

</x-ticket-layout>