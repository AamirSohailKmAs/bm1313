<x-app-layout>
    <x-slot:bodyClass>
        today
    </x-slot:bodyClass>
    <x-slot:header>
        <header class="bg-brandSecondary fixed top-0 w-full px-3 text-center font-bold text-white">
            <x-nav>
                <x-slot:todayActive>
                    bg-blue-700
                </x-slot:todayActive>
            </x-nav>
            <section class="main-header flex">
                @can('orders.store')
                <x-sale-inputs :activations="$activations" :products="$products" />
                @endcan
                @can('expenses.update')
                <x-expense-inputs :movements="$movements" route="expenses.update" param="{{ $expense->id }}" value="Update" :expense="$expense" method="patch" />
                @endcan
            </section>
            <div class="header-after"></div>
        </header>
    </x-slot:header>
    <x-today :orders="$orders" :expenses="$expenses" />
    <x-slot:extraScript>
        <script>
            function validateForm() {
                let activation = document.getElementById('activation').value;
                let product = document.getElementById('product').value;
                let cash = document.getElementById('cash').value;
                let mb = document.getElementById('mb').value;
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