@props([
'activations',
'products',
'route' => 'orders.store',
'param' => '',
'method' => 'post',
'order' => '',
])

<div class="sale-header">
    <div class="cell bg-brandPrimary cells-header border-2 border-black">Sales</div>
    <form id="order-create-form" class="input-cells flex" action="{{ route($route, $param) }}" method="post" onsubmit="return validateForm()">
        @csrf
        @method($method)
        <div class="qty">
            <div class="cell label bg-brandPrimary border-x-2 border-black">QTY</div>
            <input class="cell w-full border-2 border-black bg-gray-400 text-black" name="qty" type="number" min="1" value="{{ ($order) ? $order->qty : '1' ; }}" required />
        </div>
        <div class="">
            <div class="cell label bg-brandPrimary activations border-r-2 border-black">Activations</div>
            <select class="cell activations border-2 border-l-0 border-black bg-gray-400 text-black" name="activation" id="activation">
                <option value=""></option>
                @forelse ($activations as $activation)
                <option value="{{ $activation->id }}" {{ ($order && $order->activation_id == $activation->id) ? 'selected' : '' ; }}>{{ $activation->name }}</option>
                @empty

                @endforelse
            </select>
        </div>
        <div class="">
            <div class="cell label bg-brandPrimary vendas border-r-2 border-black">Vendas</div>
            <select class="cell vendas border-2 border-l-0 border-black bg-gray-400 text-black" name="product" id="product">
                <option value=""></option>
                @forelse ($products as $product)
                <option value="{{ $product->id }}" {{ ($order && $order->product_id == $product->id) ? 'selected' : '' ; }}>{{ $product->name }}</option>
                @empty

                @endforelse
            </select>
        </div>
        <div class="details">
            <div class="cell label bg-brandPrimary border-r-2 border-black">Details</div>
            <input class="cell w-full border-2 border-l-0 border-black bg-gray-400 text-black" name="details" value="{{ ($order) ? $order->details : '' ; }}" type="text" />
        </div>
        <div class="cash">
            <div class="cell label bg-blue-700 border-r-2 border-black">Cash</div>
            <input class="cell w-full bg-blue-700 border-2 border-l-0 border-black" name="cash" value="{{ ($order) ? $order->cash : '' ; }}" id="cash" min="0.00" step="0.01" type="number" />
        </div>
        <div class="mb">
            <div class="cell label bg-pink-700 border-r-2 border-black">MB</div>
            <input class="cell w-full bg-pink-700 border-2 border-l-0 border-black" name="mb" value="{{ ($order) ? $order->mb : '' ; }}" id="mb" min="0.00" step="0.01" type="number" />
        </div>
        <div class="unit-cost">
            <div class="cell label bg-brandPrimary border-r-2 border-black">Unit Cost</div>
            <input class="cell w-full border-2 border-l-0 border-black bg-gray-400 text-black" name="unit_cost" value="{{ ($order) ? $order->unit_cost : '' ; }}" min="0.00" step="0.01" type="number" />
        </div>
        <div class="submit m-2">
            <div class="label"></div>
            <input class="rounded-xl bg-blue-700 px-4 py-1 font-semibold cursor-pointer hover:bg-blue-900" type="submit" {{ $attributes->merge(['value' => "Save"])}} />
        </div>
    </form>
</div>