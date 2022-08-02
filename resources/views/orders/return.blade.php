<x-app-layout>
    <x-slot:bodyClass>
        return
    </x-slot:bodyClass>
    <x-slot:header>
        <header class="bg-brandSecondary fixed top-0 w-full border-black px-3 text-center font-bold text-white">
            <x-nav>
                <x-slot:returnActive>
                    bg-yellow-700
                </x-slot:returnActive>
            </x-nav>
            @can('return.store')
            <section class="container py-2">
                <form class="flex justify-around" action="{{ route('return.store') }}" method="post">
                    @csrf
                    <input class="rounded-md border-2 border-gray-500 bg-yellow-900 py-1 px-4" type="date" name="fromDate" id="fromDate" value="{{ ($fromDate) ?: '' }}" required />
                    <input class="rounded-md border-2 border-gray-500 bg-yellow-900 py-1 px-4" type="date" name="toDate" id="toDate" value="{{ ($toDate) ?: '' }}" required />
                    <input class="nav-link inline-block rounded-xl bg-yellow-900 px-4 py-1 font-semibold active:bg-yellow-700" type="submit" value="Search" id="filter" />
                </form>
            </section>
            @endcan
            <div class="header-after"></div>
        </header>
    </x-slot:header>
    <main class="tableFixHead flex px-3">
        <table class="sales-table w-full text-center">
            <thead>
                <tr>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center qty">{{ __('Qty') }}</th>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center activations">{{ __('Activations') }}</th>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center vendas">{{ __('Vendas') }}</th>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center details">{{ __('Details') }}</th>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center cash">{{ 'Cash' }}</th>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center mb">{{ __('Mb') }}</th>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center unit-cost">{{ __('Unit Cost') }}</th>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center output-total-cell">{{ __('Return Date') }}</th>
                    <th class="border-2 border-black bg-brandPrimary text-white text-center output-total-cell">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                <tr class="{{ ($loop->even) ? 'bg-blue-300' : '' ; }}">
                    <td class="qty border-2 border-black">{{ $order->qty }}</td>
                    <td class="activations border-2 border-black">
                        {{ ($order->activation) ? $order->activation->name : "" }}
                    </td>
                    <td class="vendas border-2 border-black">
                        {{ ($order->product) ? $order->product->name : "" }}
                    </td>
                    <td class="details border-2 border-black">
                        {{ $order->details }}
                    </td>
                    <td class="cash border-2 border-black">
                        @if ($order->cash)
                        <span>&euro;</span>
                        <span>{{ $order->cash }}</span>
                        @endif
                    </td>
                    <td class="mb border-2 border-black">
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
                    <td class="return-date border-2 border-black">
                        {{ $order->created_at->toFormattedDateString() }}
                    </td>
                    <td class="output-total-cell border-2 border-black text-center text-white">
                        @if (!$order->returned_at)
                        @can('return.update')
                        <form action="{{ route('return.update', $order->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <button class="btn inline-block rounded bg-yellow-600 px-4 py-1 shadow-md">Return</button>
                        </form>
                        @endcan
                        @endif
                    </td>
                </tr>
                @empty

                @endforelse
            </tbody>
        </table>
    </main>
    <script>
        document.getElementById('filter').addEventListener('click', () => {
            const d1 = document.getElementById('fromDate').value;
            const d2 = document.getElementById('toDate').value;
            const fromDate = new Date(d1.trim());
            const toDate = new Date(d2.trim());
            if (fromDate <= toDate) {
                console.log("true");
            } else if (fromDate > toDate) {
                alert('Please Check Your Date');
                event.preventDefault();
            } else {
                alert('Please Select Your Date Range')
                event.preventDefault();
            }
        });
    </script>
</x-app-layout>