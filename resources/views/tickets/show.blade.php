<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print</title>
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/ticket.css">
</head>

<body class="print">
  <div class="container">
    <div class="d-print-none btn-group d-flex">
      <button class="btn btn-success" onclick="print();">Print</button>
      @can('tickets.store')
      <a class="btn btn-danger" href="{{ route('tickets.create') }}">Close</a>
      @endcan

      <button class="btn btn-warning" id="printpdf">PDF</button>
    </div>
  </div>
  <div class="container" id="invoice">
    <?php
    for ($i = 0; $i < 2; $i++) { ?>
      <div class="card border-dark mb-1 p-1">
        <div class="row">
          <div class="col-5">
            <p class="mb-0 fw-bolder">{{ __('Store') }} {{ auth()->user()->store_id }}</p>
            <p class="mb-0 fw-bolder">{{ auth()->user()->store_name }}</p>
            <p class="mb-0 fw-bolder">{{ auth()->user()->store_address }}</p>
            <p class="mb-0 fw-bolder">Tel: {{ auth()->user()->contact }}</p>
          </div>
          <div class="align-self-center col-4">
            <p class="fw-bolder py-1">{{ __('Service Receipt') }}</p>
          </div>
          <div class="col-3 py-1">
            <p class="fw-bolder small">{{ __('Receipt No') }}: <small>{{ $ticket->ticket_id }}</small></p>
            <!-- <img class="barcode-print pt-2" src="{{ asset('storage/img/'.auth()->user()->store_barcode)  }}" alt="Bar Code of {{ auth()->user()->store_name }}"> -->
            <p>{{ __('Write Opinions') }}</p>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <div class="card-header fw-bolder ">
              <span>{{ __('Device Details') }}</span>
            </div>
            <div class="card-body">
              @if ($ticket->type)
              <div class="row">
                <div class="col label-col ms-2">
                  <span class="fw-bolder small label">
                    {{ __('Type') }}
                  </span>
                </div>
                <div class="col valu-col">
                  <span class="print_valu">
                    {{ $ticket->type }}
                  </span>
                </div>
              </div>
              @endif

              @if ($ticket->mark)
              <div class="row">
                <div class="col label-col ms-2">
                  <span class="fw-bolder small label">
                    {{ __('Mark') }}
                  </span>
                </div>
                <div class="col valu-col">
                  <span class="print_valu">
                    {{ $ticket->mark }}
                  </span>
                </div>
              </div>
              @endif

              @if ($ticket->model)
              <div class="row">
                <div class="col label-col ms-2">
                  <span class="fw-bolder small label">
                    {{ __('Model') }}
                  </span>
                </div>
                <div class="col valu-col">
                  <span class="print_valu">
                    {{ $ticket->model }}
                  </span>
                </div>
              </div>
              @endif

              @if ($ticket->imei_no)
              <div class="row">
                <div class="col label-col ms-2">
                  <span class="fw-bolder small label">
                    {{ __('IMEI No.') }}
                  </span>
                </div>
                <div class="col valu-col">
                  <span class="print_valu">
                    {{ $ticket->imei_no }}
                  </span>
                </div>
              </div>
              @endif

              @if ($ticket->warranty)
              <div class="row">
                <div class="col label-col ms-2">
                  <span class="fw-bolder small label">
                    {{ __('Warranty') }}
                  </span>
                </div>
                <div class="col valu-col">
                  <span class="print_valu">
                    {{ $ticket->warranty }}
                  </span>
                </div>
              </div>
              @endif

              @if ($ticket->repair)
              <div class="row">
                <div class="col label-col ms-2">
                  <span class="fw-bolder small label">
                    {{ __('Repair') }}
                  </span>
                </div>
                <div class="col valu-col">
                  <span class="print_valu">
                    {{ $ticket->repair }}
                  </span>
                </div>
              </div>
              @endif

              @if ($ticket->observ_of_damag)
              <div class="row">
                <div class="col label-col ms-2">
                  <span class="fw-bolder small label">
                    {{ __('Observation of Damages') }}
                  </span>
                </div>
                <div class="col valu-col">
                  <span class="print_valu">
                    {{ $ticket->observ_of_damag }}
                  </span>
                </div>
              </div>
              @endif

              @if ($ticket->technician)
              <div class="row">
                <div class="col label-col ms-2">
                  <span class="fw-bolder small label">
                    {{ __('Technician') }}
                  </span>
                </div>
                <div class="col valu-col">
                  <span class="print_valu">
                    {{ $ticket->technician }}
                  </span>
                </div>
              </div>
              @endif

            </div>
          </div>
          <div class="col-4">
            <div class="card-header fw-bolder">
              <span>{{ __('Customer Details') }}</span>
            </div>
            <div class="card-body">

              @if ($ticket->client_name)
              <div class="row">
                <div class="col label-col">
                  <span class="fw-bolder small label">
                    {{ __('Name') }}
                  </span>
                </div>
                <div class="col valu-col">
                  <span class="print_valu">
                    {{ $ticket->client_name }}
                  </span>
                </div>
              </div>
              @endif

              @if ($ticket->contact)
              <div class="row">
                <div class="col label-col">
                  <span class="fw-bolder small label">
                    {{ __('Contact') }}
                  </span>
                </div>
                <div class="col valu-col">
                  <span class="print_valu">
                    {{ $ticket->contact }}
                  </span>
                </div>
              </div>
              @endif

              @if ($ticket->n_i_f)
              <div class="row">
                <div class="col label-col">
                  <span class="fw-bolder small label">
                    {{ __('N.I.F') }}
                  </span>
                </div>
                <div class="col valu-col">
                  <span class="print_valu">
                    {{ $ticket->n_i_f }}
                  </span>
                </div>
              </div>
              @endif


              @if ($ticket->email)
              <div class="row">
                <div class="col label-col">
                  <span class="fw-bolder small label">
                    {{ __('Email') }}
                  </span>
                </div>
                <div class="col valu-col">
                  <span class="print_valu">
                    {{ $ticket->email }}
                  </span>
                </div>
              </div>
              @endif

              @if ($ticket->city)
              <div class="row">
                <div class="col label-col">
                  <span class="fw-bolder small label">
                    {{ __('City') }}
                  </span>
                </div>
                <div class="col valu-col">
                  <span class="print_valu">
                    {{ $ticket->city }}
                  </span>
                </div>
              </div>
              @endif

              @if ($ticket->address)
              <div class="row">
                <div class="col label-col">
                  <span class="fw-bolder small label">
                    {{ __('Address') }}
                  </span>
                </div>
                <div class="col valu-col">
                  <span class="print_valu">
                    {{ $ticket->address }}
                  </span>
                </div>
              </div>
              @endif

              @if ($ticket->comments)
              <div class="row">
                <div class="col label-col">
                  <span class="fw-bolder small label">
                    {{ __('Comments') }}
                  </span>
                </div>
                <div class="col valu-col">
                  <span class="print_valu">
                    {{ $ticket->comments }}
                  </span>
                </div>
              </div>
              @endif

            </div>
          </div>
          <div class="col-4">
            <div class="card-header fw-bolder">
              <span>{{ __('Payment Details') }}</span>
            </div>
            <div class="card-body">

              @if ($ticket->payment)
              <div class="row">
                <div class="col label-col">
                  <span class="fw-bolder small label">
                    {{ __('Payment') }}
                  </span>
                </div>
                <div class="col me-2 valu-col">
                  <span class="print_valu">
                    {{ $ticket->payment }}
                  </span>
                </div>
              </div>
              @endif

              @if ($ticket->total)
              <div class="row">
                <div class="col label-col">
                  <span class="fw-bolder small label">
                    {{ __('Total') }}
                  </span>
                </div>
                <div class="col me-2 valu-col">
                  <span class="print_valu">
                    {{ $ticket->total }} EUR
                  </span>
                </div>
              </div>
              @endif

              @if ($ticket->received)
              <div class="row">
                <div class="col label-col">
                  <span class="fw-bolder small label">
                    {{ __('Received') }}
                  </span>
                </div>
                <div class="col me-2 valu-col">
                  <span class="print_valu">
                    {{ $ticket->received }} EUR
                  </span>
                </div>
              </div>
              @endif

              @if ($ticket->balance)
              <div class="row">
                <div class="col label-col">
                  <span class="fw-bolder small label">
                    {{ __('Balance') }}
                  </span>
                </div>
                <div class="col me-2 valu-col">
                  <span class="print_valu">
                    {{ $ticket->balance }} EUR
                  </span>
                </div>
              </div>
              @endif

              @if ($ticket->deliver_date)
              <div class="row">
                <div class="col label-col">
                  <span class="fw-bolder small label">
                    {{ __('Delivery Date') }}
                  </span>
                </div>
                <div class="col me-2 valu-col">
                  <span class="print_valu">
                    {{ $ticket->deliver_date }} EUR
                  </span>
                </div>
              </div>
              @endif
            </div>
          </div>
        </div>
        <p class="text-center small">{{ __('Note') }}</p>
        <div class="dashed"></div>
        <p class="text-center fw-bolder">{{ __('Client') }}<br><br></br>
          <span>{{ $ticket->created_at->isoFormat('Y-MM-D h:mm a'); }}</span>
        </p>

      </div>
      <div class="dashed"></div>
    <?php
    }
    ?>

  </div>
  <script src="/js/jquery-3.6.0.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
  <script>
    window.onload = function() {
      document.getElementById("printpdf")
        .addEventListener("click", () => {
          const invoice = this.document.getElementById("invoice");
          console.log(invoice);
          console.log(window);
          var opt = {
            margin: 0.5,
            filename: 'store-<?php echo auth()->user()->store_id ?>-ticket-<?php echo $ticket->ticket_id ?>.pdf',
            image: {
              type: 'jpeg',
              quality: 0.98
            },
            html2canvas: {
              scale: 1
            },
            jsPDF: {
              unit: 'in',
              format: 'A4',
              orientation: 'portrait'
            }
          };
          html2pdf().from(invoice).set(opt).save();
        })
    }
  </script>
</body>

</html>