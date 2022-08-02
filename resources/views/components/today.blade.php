@props([
'orders',
'expenses',
])
<main class="flex px-3">
    <table class="sales-table">
        @forelse ($orders as $order)
        <tr>
            <td class="qty border-2 border-black">{{ $order->qty }}</td>
            <td class="activations border-2 border-black">{{ ($order->activation) ? $order->activation->name : "" }}</td>
            <td class="vendas border-2 border-black">{{ ($order->product) ? $order->product->name : "" }}</td>
            <td class="details border-2 border-black">{{ $order->details }}</td>
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

            <td class="output-total-cell border-2 border-black text-center text-white">
                @if (!$order->returned_at)
                @can('orders.update')
                <a href="{{ route('orders.edit', $order->id) }}" class="btn inline-block rounded bg-indigo-700 px-4 py-1 shadow-md">Edit</a>
                @endcan
                @endif
            </td>
            <td class="output-total-cell border-2 border-black text-center text-white">
                @if (!$order->returned_at)
                @can('return.update')
                <form action="{{ route('return.update', $order->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <button class="btn inline-block font-bold rounded bg-yellow-600 px-4 py-1 shadow-md">Return</button>
                </form>
                @endcan
                @endif
            </td>
            <td class="output-total-cell border-2 border-black text-center text-white">
                @can('orders.destroy')
                <form action="{{ route('orders.destroy', $order->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn inline-block rounded bg-red-700 px-4 py-1 shadow-md">Delete</button>
                </form>
                @endcan
            </td>

        </tr>
        @empty

        @endforelse


    </table>
    <table class="expenses-table">
        @forelse ($expenses as $expense)
        <tr>
            <td class="expense min-w-[30px] border-2 border-black">{{ $expense->qty }}</td>
            <td class="expense item border-2 border-black">{{ $expense->movement->name }}</td>
            <td class="expense item border-2 border-black">{{ $expense->remarks }}</td>
            <td class="expense price border-2 border-black">
                <span>Total </span>
                <span>&euro;</span>
                <span>{{ $expense->total }}</span>
            </td>
            <td class="expense border-2 border-black">
                @can('expenses.update')
                <a href="{{ route('expenses.edit', $expense->id) }}" class="btn mx-1 inline-block rounded bg-indigo-700 px-3 py-1 text-white shadow-md">Edit</a>
                @endcan
            </td>
            <td class="expense border-2 border-black">
                @can('expenses.destroy')
                <form action="{{ route('expenses.destroy', $expense->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn mx-1 inline-block rounded bg-red-700 px-2 py-1 text-white shadow-md">Delete</button>
                </form>
                @endcan
            </td>
        </tr>
        @empty

        @endforelse


    </table>
</main>