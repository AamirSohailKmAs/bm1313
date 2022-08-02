<x-app-layout>
    <x-slot:header>
        <header class="bg-brandSecondary kmas fixed top-0 w-full border-black px-3 text-center font-bold text-white">
            <x-nav>
                <x-slot:posActive>
                    bg-violet-700
                </x-slot:posActive>
            </x-nav>
            <section class="top-header flex justify-around h-24">
                <div class="bg-brandPrimary flex justify-around top-left-header w-full">
                    <div class="flex flex-col w-full">
                        <div class="cell cell-header border-x-2 border-t-2 border-black px-5 py-2">Cash Drawer</div>
                        <div class="cell cell-body border-2 border-black bg-green-700 py-4">
                            <span>&euro;</span>
                            <span id="cash-drawer">{{ ($sale) ? $sale->cash_drawer : '0.00'; }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col w-full">
                        <div class="cell cell-header border-x-2 border-t-2 border-black px-5 py-2">Cash Sale</div>
                        <div class="cell cell-body border-2 border-black py-4">
                            <span>&euro;</span>
                            <span id="cash-sale">{{ ($sale) ? $sale->cash : '0.00'; }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col w-full">
                        <div class="cell cell-header border-x-2 border-t-2 border-black px-5 py-2">MB Sale</div>
                        <div class="cell cell-body border-2 border-black py-4">
                            <span>&euro;</span>
                            <span id="mb-sale">{{ ($sale) ? $sale->mb : '0.00'; }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col w-full">
                        <div class="cell cell-header border-x-2 border-t-2 border-black px-5 py-2">Total Sale</div>
                        <div class="cell cell-body border-2 border-black py-4">
                            <span>&euro;</span>
                            <span id="total-sale">{{ ($sale) ? $sale->total : '0.00'; }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col w-full">
                        <div class="cell cell-header border-x-2 border-t-2 border-black px-5 py-2">Profit</div>
                        <div class="cell cell-body border-2 border-black py-4">
                            <span>&euro;</span>
                            <span id="profit">{{ ($sale) ? $sale->profit : '0.00'; }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col w-full">
                        <div class="cell cell-header border-x-2 border-t-2 border-black px-5 py-2">Expense</div>
                        <div class="cell cell-body border-2 border-black py-4">
                            <span>&euro;</span>
                            <span id="expense">{{ ($sale) ? $sale->expense : '0.00'; }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col bg-yellow-700">
                        <div class="cell cell-header border-x-2 border-t-2 border-black px-5 py-2">WithDraw</div>
                        <div class="cell cell-body border-2 border-black py-4">
                            <span>&euro;</span>
                            <span id="withdrawn">{{ ($sale) ? $sale->cash_withdraw : '0.00'; }}</span>
                        </div>
                    </div>
                </div>
                <!-- <div class="top-right-header flex flex-col">
                    <div class="input-cells">
                        <form class="flex" action="{{-- route('withdraws.store') --}}" method="post">
                            @csrf
                            <div class="input-cell">
                                <div class="cell bg-brandPrimary border-2 border-black">Paid Outs</div>
                                <input class="withdraw-input border-2 border-black bg-gray-400 text-black" type="number" name="paid" required />
                            </div>
                            <div class="input-cell">
                                <div class="cell bg-brandPrimary border-2 border-black">Details</div>
                                <input class="withdraw-input border-2 border-black bg-gray-400 text-black" type="text" name="withdraw_details" />
                            </div>
                            <div class="input-cell m-2">
                                <div class=""></div>
                                <input type="submit" class="withdraw-input rounded-xl bg-yellow-700 px-3 py-2 font-semibold cursor-pointer hover:bg-blue-900" value="withdraw" />
                            </div>
                        </form>
                    </div>
                </div> -->
            </section>
            <section class="main-header flex">
                @can('orders.store')
                <x-sale-inputs :activations="$activations" :products="$products" route="orders.store" value="Save" />
                @endcan
                @can('expenses.store')
                <x-expense-inputs :movements="$movements" route="expenses.store" value="Save" />
                @endcan
            </section>
            <div class="header-after"></div>
        </header>
    </x-slot:header>
    <main class="tableFixHead flex px-3">
        <table class="sales-table pr-1">
            <thead>
                <tr>
                    <th class="border-2 border-black bg-blue-700 text-white text-center" colspan="10">{{ __('Sales') }}</th>
                </tr>
                <tr>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center qty">{{ __('Qty') }}</th>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center activations">{{ __('Activations') }}</th>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center vendas">{{ __('Vendas') }}</th>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center details">{{ __('Details') }}</th>
                    <th class="border-2 border-black bg-blue-700 text-white text-center cash">{{ 'Cash' }}</th>
                    <th class="border-2 border-black bg-pink-700 text-white text-center mb">{{ __('Mb') }}</th>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center unit-cost">{{ __('Unit Cost') }}</th>
                    <!-- <th class="border-2 border-black bg-brandPrimary text-white text-center submit">{{ __('Date') }}</th> -->
                    <th class="border-2 border-black bg-brandPrimary text-white text-center output-total-cell">{{ __('PAYMENT') }}</th>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center output-total-cell">{{ __('T. COST') }}</th>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center output-total-cell">{{ __('T. PROFIT') }}</th>
                </tr>
            </thead>
            @forelse ($orders as $order)
            <tr class="{{ ($loop->even) ? 'bg-blue-300' : ''; }}">
                <td class="qty border-2 border-black">{{ $order->qty }}</td>
                <td class="activations border-2 border-black">{{ ($order->activation) ? $order->activation->name : "" }}</td>
                <td class="vendas border-2 border-black">{{ ($order->product) ? $order->product->name : "" }}</td>

                <td class="details border-2 border-black">{{ $order->details }}</td>
                <td class="bg-blue-700 text-white cash border-2 border-black">
                    @if ($order->cash)
                    <span>&euro;</span>
                    <span>{{ $order->cash }}</span>
                    @endif
                </td>
                <td class="bg-pink-700 text-white mb border-2 border-black">
                    @if ($order->mb)
                    <span>&euro;</span>
                    <span>{{ $order->mb }}</span>
                    @endif

                </td>
                <td class="unit-cost border-2 border-black">
                    @if ($order->unit_cost)
                    <span>&euro;</span>
                    <span>{{ $order->unit_cost }}</span>
                    @endif
                </td>
                <!-- <td class="submit border-2 border-black">{{-- $order->created_at->diffForHumans() --}}</td> -->
                <td class="output-total-cell border-2 border-black bg-gray-600 text-white">
                    @if ($order->payment)
                    <span>&euro;</span>
                    <span>{{ $order->payment }}</span>
                    @endif
                </td>
                <td class="output-total-cell border-2 border-black bg-gray-600 text-white">
                    @if ($order->t_cost)
                    <span>&euro;</span>
                    <span>{{ $order->t_cost }}</span>
                    @endif
                </td>
                <td class="output-total-cell border-2 border-black bg-gray-600 text-white">
                    @if ($order->t_profit)
                    <span>&euro;</span>
                    <span>{{ $order->t_profit }}</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr class="h-6">
                <td class="qty border-2 border-black"></td>
                <td class="activations border-2 border-black"></td>
                <td class="vendas border-2 border-black"></td>
                <td class="details border-2 border-black"> </td>
                <td class="bg-blue-700 text-white cash border-2 border-black">
                    <span></span>
                    <span></span>
                </td>
                <td class="mb bg-pink-700 text-white border-2 border-black"></td>
                <td class="unit-cost border-2 border-black">
                    <span></span>
                    <span></span>
                </td>
                <td class="output-total-cell border-2 border-black bg-gray-600 text-white"></td>
                <td class="output-total-cell border-2 border-black bg-gray-600 text-white"></td>
                <td class="output-total-cell border-2 border-black bg-gray-600 text-white"></td>
            </tr>
            @endforelse
        </table>
        <table class="expenses-table">
            <thead>
                <tr>
                    <th class="border-2 border-black bg-blue-700 text-white text-center" colspan="5">{{ __('Expenses') }}</th>
                </tr>
                <tr>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center qty">{{ __('Qty') }}</th>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center activations">{{ __('Name') }}</th>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center vendas">{{ __('Unit Price') }}</th>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center details">{{ __('Total') }}</th>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center details">{{ __('Remarks') }}</th>
                </tr>
            </thead>
            @forelse ($expenses as $expense)
            <tr class="{{ $loop->even ? 'bg-blue-300' : '' ; }}">
                <td class="expense qty border-2 border-black">{{ $expense->qty}}</td>
                <td class="expense item border-2 border-black">{{ $expense->movement->name }}</td>
                <td class="expense price border-2 border-black">
                    <span>&euro;</span>
                    <span>{{ $expense->unit_price }}</span>
                </td>
                <td class="expense submit border-2 border-black">
                    <span>&euro;</span>
                    <span>{{ $expense->total }}</span>
                </td>
                <td class="remarks submit border-2 border-black">
                    <span>{{ $expense->remarks }}</span>
                </td>
            </tr>
            @empty
            <tr>
                <td class="expense h-6 border-2 border-black qty"></td>
                <td class="expense h-6 border-2 border-black item"></td>
                <td class="expense h-6 border-2 border-black price"></td>
                <td class="expense h-6 border-2 border-black remarks"></td>
                <td class="expense h-6 border-2 border-black submit"></td>
            </tr>
            @endforelse

        </table>
    </main>

    <x-slot:extraScript>
        <script>
            function validateForm() {
                let mb = document.getElementById('mb').value;
                let cash = document.getElementById('cash').value;
                let product = document.getElementById('product').value;
                let activation = document.getElementById('activation').value;
                if ((activation == "" && product == "") || (activation != "" && product != "")) {
                    alert('Select "Activation" or "Vendas"');
                    return false;
                }

                if (cash == "" && mb == "") {
                    alert('Select "Cash" or "Multi Bank"');
                    return false;
                }
                return true;
            }
        </script>
    </x-slot:extraScript>
</x-app-layout>