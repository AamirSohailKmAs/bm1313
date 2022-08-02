@props([
'movements',
'route' => 'expenses.store',
'param' => '',
'method' => 'post',
'expense' => '',
])
<div class="expenses">
    <div class="cell bg-brandPrimary cells-header border-2 border-black">Expenses / Movimentos</div>
    <form class="flex" action="{{ route($route, $param) }}" method="post">
        @csrf
        @method($method)
        <div class="expense">
            <div class="cell bg-brandPrimary border-x-2 border-black">QTY</div>
            <input class="cell w-8 border-2 border-black bg-gray-400 text-black" name="expense_qty" type="number" value="{{ ($expense) ? $expense->qty : '1' ; }}" required />
        </div>
        <div class="expense">
            <div class="cell bg-brandPrimary border-r-2 border-black">ITEM</div>
            <select class="w-24 cell border-2 border-l-0 border-black bg-gray-400 text-black" name="expense_item" id="" required>
                <option value=""></option>
                @forelse ($movements as $movement)
                <option value="{{ $movement->id }}" {{ ($expense && $expense->movement_id == $movement->id) ? 'selected' : '' ; }}>{{ $movement->name }}</option>
                @empty

                @endforelse
            </select>
        </div>
        <div class="expense">
            <div class="cell bg-brandPrimary border-r-2 border-black">Price</div>
            <input class="cell w-12 border-2 border-l-0 border-black bg-gray-400 text-black" name="expense_price" min="0.00" step="0.01" type="number" value="{{ ($expense) ? $expense->unit_price : '' ; }}" required />
        </div>
        <div class="expense remarks">
            <div class="cell bg-brandPrimary border-r-2 border-black">Remarks</div>
            <input class="cell w-full border-2 border-l-0 border-black bg-gray-400 text-black" name="expense_remarks" type="text" value="{{ ($expense) ? $expense->remarks : '' ; }}" />
        </div>
        <div class="expense submit">
            <input class="m-2 rounded-xl bg-blue-700 px-4 py-1 font-semibold cursor-pointer hover:bg-blue-900" type="submit" {{ $attributes->merge(['value' => "Save"])}} />
        </div>
    </form>
</div>