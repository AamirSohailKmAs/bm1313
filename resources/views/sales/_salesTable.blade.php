<main class="font-bold">
  <section class="container py-2">
    <form class="flex justify-around" action="{{ route('sales.index', $user) }}" method="post" id="summarySearch">
      @csrf
      <input class="rounded-md border-2 border-gray-500 bg-yellow-700 py-1 px-4" type="date" name="startDate" id="startDate" value="{{ ($startDate)?: '' }}">
      <input class="rounded-md border-2 border-gray-500 bg-yellow-700 py-1 px-4" type="date" name="endDate" id="endDate" value="{{ ($endDate)?: '' }}">

      <input class="nav-link inline-block rounded-xl bg-yellow-700 px-4 py-1 font-semibold cursor-pointer" type="submit" value="Search" />
      @can('return.details')
      <a class="nav-link inline-block rounded-xl bg-blue-700 text-white px-4 py-1 font-semibold cursor-pointer" type="button" href="{{ route('return.details', $user) }}">Details</a>
      @endcan

    </form>
  </section>
  <section class="flex flex-col lg:flex-row">
    <div class="sales px-1 w-full">
      <div class="activations-header">
        <div class="table-head text-center bg-green-700 text-white font-bold">
          Sales
        </div>
        <div class="flex bg-brandPrimary text-white font-bold">
          <div class="w-full text-center border-2 border-black">Date</div>
          <div class="w-full text-center border-2 border-black">Cash</div>
          <div class="w-full text-center border-2 border-black">MB</div>
          <div class="w-full text-center border-2 border-black">Total</div>
          <div class="w-full text-center border-2 border-black">Profit</div>
          <div class="w-full text-center border-2 border-black">Expense</div>
          <div class="w-full text-center border-2 border-black">Customer</div>
        </div>
      </div>
      <div class="table-body">
        @forelse ($sales as $sale)
        <div class="row flex {{ ($loop->even) ? 'bg-blue-300' : '' ; }} ">
          <div class="w-full text-center border-2 border-black">
            {{ $sale->created_at->toDateString() }}
          </div>
          <div class="w-full text-center border-2 border-black">
            <span>&euro; </span><span> {{ $sale->cash }}</span>
          </div>
          <div class="w-full text-center border-2 border-black">
            <span>&euro; </span><span> {{ $sale->mb }}</span>
          </div>
          <div class="w-full text-center border-2 border-black">
            <span>&euro; </span><span> {{ $sale->total }}</span>
          </div>
          <div class="w-full text-center border-2 border-black">
            <span>&euro; </span><span> {{ $sale->profit }}</span>
          </div>
          <div class="w-full text-center border-2 border-black">
            <span>&euro; </span><span> {{ $sale->expense }}</span>
          </div>
          <div class="w-full text-center border-2 border-black">
            <span>{{ $sale->customers }}</span>
          </div>
        </div>
        @empty
        @endforelse
        <div class="row flex mt-4 bg-blue-900 text-white">
          <div class="w-full text-center border-2 border-black">
            {{ __('Total') }}
          </div>
          <div class="w-full text-center border-2 border-black">
            <span>&euro; </span><span> {{ $report['cash'] }}</span>
          </div>
          <div class="w-full text-center border-2 border-black">
            <span>&euro; </span><span> {{ $report['mb'] }}</span>
          </div>
          <div class="w-full text-center border-2 border-black">
            <span>&euro; </span><span> {{ $report['total'] }}</span>
          </div>
          <div class="w-full text-center border-2 border-black">
            <span>&euro; </span><span> {{ $report['profit'] }}</span>
          </div>
          <div class="w-full text-center border-2 border-black">
            <span>&euro; </span><span> {{ $report['expense'] }}</span>
          </div>
          <div class="w-full text-center border-2 border-black">
            <span> {{ $report['customers'] }}</span>
          </div>
        </div>
      </div>
      <div class="withdraw-table">
        <div class="row flex mt-4 bg-brandYellow">
          <div class="w-full text-center border-2 border-black">{{ __('WithDraws') }}</div>
        </div>
        <div class="row flex bg-brandPrimary text-white">
          <div class="w-full text-center border-2 border-black">{{ 'Date' }}</div>
          <div class="w-full text-center border-2 border-black">{{ 'Remarks' }}</div>
          <div class="w-full text-center border-2 border-black">{{ __('Withdraw') }}</div>
          <div class="w-full text-center border-2 border-black">{{ __('Left') }}</div>

          <div class="w-full text-center border-2 border-black">{{ __('Actions') }}</div>

        </div>
        @forelse ($withdraws as $withdraw)
        <div class="row flex ">
          <div class="w-full text-center border-2 border-black">
            {{ $withdraw->created_at->toDateString() }}
          </div>
          <div class="w-full text-center border-2 border-black">{{ $withdraw->details }}</div>
          <div class="w-full text-center border-2 border-black">{{ $withdraw->withdraw }}</div>
          <div class="w-full text-center border-2 border-black">{{ $withdraw->left }}</div>
          <div class="w-full text-center border-2 border-black">
            @can('withdraws.destroy')
            <form action="{{ route('withdraws.destroy', $withdraw) }}" method="post">
              @method('DELETE')
              @csrf
              <input class="bg-red-600 text-white font-semibold px-3 rounded-md hover:bg-red-900 cursor-pointer" type="submit" value="Delete">
            </form>
            @endcan
          </div>
        </div>
        @empty
        <div class="row flex ">
          <div class="w-full h-6 text-center border-2 border-black"></div>
          <div class="w-full h-6 text-center border-2 border-black"></div>
          <div class="w-full h-6 text-center border-2 border-black"></div>
          <div class="w-full h-6 text-center border-2 border-black"></div>

          <div class="w-full text-center border-2 border-black"></div>

        </div>
        @endforelse
      </div>
      <div class="credit-table">
        <div class="row flex mt-4 bg-sky-500">
          <div class="w-full text-center border-2 border-black">{{ __('Credits') }}</div>
        </div>
        <div class="row flex bg-brandPrimary text-white">
          <div class="w-full text-center border-2 border-black">{{ 'Date' }}</div>
          <div class="w-full text-center border-2 border-black">{{ 'Remarks' }}</div>
          <div class="w-full text-center border-2 border-black">{{ __('Amount') }}</div>
          <div class="w-full text-center border-2 border-black">{{ __('Actions') }}</div>
        </div>
        @forelse ($credits as $credit)
        <div class="row flex">
          <div class="w-full text-center border-2 border-black">
            {{ $credit->created_at->toDateString() }}
          </div>
          <div class="w-full text-center border-2 border-black">{{ $credit->remark }}</div>
          <div class="w-full text-center border-2 border-black">{{ $credit->amount }}</div>
          <div class="w-full text-center border-2 border-black flex justify-evenly py-1 items-center">
            @if ($credit->created_at > $report['last_withdraw_at'])
            @can('credits.update')
            <a class="edit bg-brandYellow font-semibold px-3 rounded-md hover:bg-yellow-700 hover:text-white" href="{{ route('credits.edit', $credit) }}">Edit</a>
            @endcan
            @can('credits.destroy')
            <form action="{{ route('credits.destroy', $credit) }}" method="post">
              @method('DELETE')
              @csrf
              <input class="bg-red-600 text-white font-semibold px-3 rounded-md hover:bg-red-900 cursor-pointer" type="submit" value="Delete">
            </form>
            @endcan
            @endif
          </div>
        </div>
        @empty
        <div class="row flex ">
          <div class="w-full h-6 text-center border-2 border-black"></div>
          <div class="w-full h-6 text-center border-2 border-black"></div>
          <div class="w-full h-6 text-center border-2 border-black"></div>
          <div class="w-full h-6 text-center border-2 border-black"></div>
        </div>
        @endforelse
        <div class="row flex mt-4 bg-violet-700 text-slate-100">
          <div class="w-full text-center border-2 border-black">{{ __('Calculation') }}</div>
        </div>
        <div class="font-bold text-lg flex justify-center">
          <div class="w-full px-2 border-2 border-black">{{ __("Total Sale's Cash") }}</div>
          <div class="w-full text-center border-2 border-black">{{ $report['cash'] }}</div>
        </div>
        <div class="font-bold text-lg flex justify-center">
          <div class="w-full px-2 border-2 border-black">{{ __('Total Credit') }}</div>
          <div class="w-full text-center border-2 border-black">{{ $report['credit'] }}</div>
        </div>
        <div class="font-bold text-lg flex justify-center">
          <div class="w-full px-2 border-2 border-black">{{ __('Total Expense') }}</div>
          <div class="w-full text-center border-2 border-black">{{ $report['expense'] }}</div>
        </div>
        <div class="font-bold text-lg flex justify-center">
          <div class="w-full px-2 border-2 border-black">{{ __('Total Withdraw') }}</div>
          <div class="w-full text-center border-2 border-black">{{ $report['withdrawn'] }}</div>
        </div>
        <div class="font-bold text-lg flex justify-center">
          <div class="w-full px-2 border-2 border-black">{{ __('Due Amount') }}</div>
          <div class="w-full text-center border-2 border-black">{{ $report['due'] }}</div>
        </div>
      </div>
      @if ($startDate >= date('Y-m-01'))
      @can('withdraws.store')
      <form class="border rounded-lg bg-slate-300 mt-4 p-2" action="{{ route('withdraws.store') }}" method="post">
        @csrf
        <input type="hidden" name="due" value="{{ $report['due'] }}">
        <input type="hidden" name="user_id" value="{{ $user }}">
        <div class="text-gray-700 text-center">
          Withdraw Amount
        </div>
        <div class="flex mx-3">
          <div class="mb-4 w-full">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="remarks">Remarks</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="remarks" name="remarks" type="text" placeholder="Remarks">
          </div>

        </div>
        <div class="flex mx-3">
          <div class="mb-4 w-full">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="withdraw">
              {{ __('Withdraw Amount') }}
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="withdraw" name="withdraw" type="number" step="0.01" min="0" max="{{ $report['due'] }}" placeholder="{{ __('Enter Withdraw Amount') }}" required>
          </div>
          <div class="ml-3 mt-3 flex items-center justify-between">
            <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
              Submit
            </button>
          </div>
        </div>
      </form>
      @endcan
      @endif
    </div>
    <div class="category px-1 w-full">
      <div class="table-header">
        <div class="table-head text-center bg-green-700 text-white font-bold">
          Products
        </div>
        <div class="flex bg-brandPrimary text-white font-bold">
          <div class="min-w-[100px] text-center border-2 border-black">Name</div>
          <div class="w-full text-center border-2 border-black">Units</div>
          <div class="w-full text-center border-2 border-black">Purchase</div>
          <div class="w-full text-center border-2 border-black">Sale</div>
          <div class="w-full text-center border-2 border-black">Profit</div>
        </div>
      </div>
      <div class="activations-body pb-5">
        @forelse ($products as $product)
        <div class="row flex {{ ($loop->even) ? 'bg-blue-300' : '' ; }}">
          <div class="min-w-[100px] text-center border-2 border-black">{{ __($product->name) }}</div>
          <div class="w-full text-center border-2 border-black">{{ ($product->qty) ?: '' }}</div>
          <div class="w-full text-center border-2 border-black">
            @if ($product->t_cost)
            <span>&euro; </span><span>{{ $product->t_cost }}</span>
            @endif
          </div>
          <div class="w-full text-center border-2 border-black">
            @if ($product->payment)
            <span>&euro; </span><span> {{ $product->payment }}</span>
            @endif
          </div>
          <div class="w-full text-center border-2 border-black">
            @if ($product->t_profit)
            <span>&euro; </span><span> {{ $product->t_profit }}</span>
            @endif
          </div>
        </div>
        @empty
        <div class="row flex">
          <div class="min-w-[100px] text-center border-2 border-black"></div>
          <div class="w-full text-center border-2 border-black"></div>
          <div class="w-full text-center border-2 border-black"></div>
          <div class="w-full text-center border-2 border-black"></div>
          <div class="w-full text-center border-2 border-black"></div>
          <div class="w-full text-center border-2 border-black"></div>
        </div>
        @endforelse
      </div>
      <div class="expenses-header">
        <div class="table-head text-center bg-green-700 text-white font-bold">
          ACTIVATIONS
        </div>
        <div class="flex bg-brandPrimary text-white font-bold">
          <div class="min-w-[100px] text-center border-2 border-black">Name</div>
          <div class="w-full text-center border-2 border-black">Units</div>
          <div class="w-full text-center border-2 border-black">Purchase</div>
          <div class="w-full text-center border-2 border-black">Sale</div>
          <div class="w-full text-center border-2 border-black">Profit</div>
        </div>
      </div>
      <div class="expenses-body pb-5">
        @forelse ($activations as $activation)
        <div class="row flex {{ ($loop->even) ? 'bg-blue-300' : '' ; }}">
          <div class="min-w-[100px] text-center border-2 border-black">{{ __($activation->name) }}</div>
          <div class="w-full text-center border-2 border-black">{{ ($activation->qty) ?: '' }}</div>
          <div class="w-full text-center border-2 border-black">
            @if ($activation->t_cost)
            <span>&euro; </span><span>{{ $activation->t_cost }}</span>
            @endif
          </div>
          <div class="w-full text-center border-2 border-black">
            @if ($activation->payment)
            <span>&euro; </span><span> {{ $activation->payment }}</span>
            @endif
          </div>
          <div class="w-full text-center border-2 border-black">
            @if ($activation->t_profit)
            <span>&euro; </span><span> {{ $activation->t_profit }}</span>
            @endif
          </div>
        </div>
        @empty
        <div class="row flex">
          <div class="min-w-[100px] text-center border-2 border-black"></div>
          <div class="w-full text-center border-2 border-black"></div>
          <div class="w-full text-center border-2 border-black"></div>
          <div class="w-full text-center border-2 border-black"></div>
          <div class="w-full text-center border-2 border-black"></div>
          <div class="w-full text-center border-2 border-black"></div>
        </div>
        @endforelse
      </div>
      <div class="table-header">
        <div class="table-head text-center bg-green-700 text-white font-bold">
          Expenses / Movimentos
        </div>
        <div class="flex bg-brandPrimary text-white font-bold">
          <div class="w-full text-center border-2 border-black">Name</div>
          <div class="w-full text-center border-2 border-black">Items</div>
          <div class="w-full text-center border-2 border-black">Amounts</div>
        </div>
      </div>
      <div class="expenses-body pb-5">
        @forelse ($movements as $movement)
        <div class="row flex {{ ($loop->even) ? 'bg-blue-300' : '' ; }}">
          <div class="w-full text-center border-2 border-black">{{ __($movement->name) }}</div>
          <div class="w-full text-center border-2 border-black">{{ ($movement->qty) ?: '' }}</div>
          <div class="w-full text-center border-2 border-black">
            @if ($movement->total)
            <span>&euro; </span><span> {{ $movement->total }}</span>
            @endif
          </div>
        </div>
        @empty
        <div class="row flex">
          <div class="w-full text-center border-2 border-black"></div>
          <div class="w-full text-center border-2 border-black"></div>
          <div class="w-full text-center border-2 border-black"></div>
        </div>
        @endforelse
      </div>
    </div>
  </section>
</main>
<script>
  document.getElementById('summarySearch').addEventListener('submit', (e) => {
    e.preventDefault();
    const d1 = document.getElementById("startDate").value;
    const d2 = document.getElementById("endDate").value;
    if (d1 != "" && d2 != "") {
      const startDate = new Date(d1.trim());
      const endDate = new Date(d2.trim());
      if (startDate > endDate) {
        alert("Please Check Your Date");
        return;
      }
      if (startDate <= endDate) {
        document.getElementById('summarySearch').submit();
      }
    }
  });
</script>