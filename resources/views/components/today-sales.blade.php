@can('orders.store')
<div class="sale-header">
    <div class="cell bg-brandPrimary cells-header border-2 border-black">Sales</div>
    <form id="order-create-form" class="input-cells flex" action="{{ route('orders.store') }}" method="post" onsubmit="return validateForm()">
        @csrf
        <div class="qty">
            <div class="cell label bg-brandPrimary border-x-2 border-black">QTY</div>
            <input class="cell w-full border-2 border-black bg-gray-400 text-black" name="qty" type="number" value="1" min="1" required />
        </div>
        <div class="">
            <div class="cell label bg-brandPrimary activations border-r-2 border-black">Activations</div>
            <select class="cell activations border-2 border-l-0 border-black bg-gray-400 text-black" name="activation" id="activation">
                <option value=""></option>
                @forelse ($activations as $activation)
                <option value="{{ $activation->id }}">{{ $activation->name }}</option>
                @empty

                @endforelse
            </select>
        </div>
        <div class="">
            <div class="cell label bg-brandPrimary vendas border-r-2 border-black">Vendas</div>
            <select class="cell vendas border-2 border-l-0 border-black bg-gray-400 text-black" name="product" id="product">
                <option value=""></option>
                @forelse ($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
                @empty

                @endforelse
            </select>
        </div>
        <div class="details">
            <div class="cell label bg-brandPrimary border-r-2 border-black">Details</div>
            <input class="cell w-full border-2 border-l-0 border-black bg-gray-400 text-black" name="details" type="text" />
        </div>
        <div class="cash">
            <div class="cell label bg-brandPrimary border-r-2 border-black">Cash</div>
            <input class="cell w-full border-2 border-l-0 border-black bg-gray-400 text-black" name="cash" id="cash" min="0.00" step="0.01" type="number" />
        </div>
        <div class="mb">
            <div class="cell label bg-brandPrimary border-r-2 border-black">MB</div>
            <input class="cell w-full border-2 border-l-0 border-black bg-gray-400 text-black" name="mb" id="mb" min="0.00" step="0.01" type="number" />
        </div>
        <div class="unit-cost">
            <div class="cell label bg-brandPrimary border-r-2 border-black">Unit Cost</div>
            <input class="cell w-full border-2 border-l-0 border-black bg-gray-400 text-black" name="unit_cost" min="0.00" step="0.01" type="number" />
        </div>
        <div class="submit m-2">
            <div class="label"></div>
            <input class="rounded-xl bg-blue-700 px-4 py-1 font-semibold cursor-pointer hover:bg-blue-900" type="submit" value="Save" />
        </div>
    </form>
</div>
@endcan