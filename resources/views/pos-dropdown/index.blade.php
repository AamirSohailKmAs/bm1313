<x-admin-layout>
  <x-slot:posDropdown>
    active
    </x-slot>
    <div class="container flex flex-col sm:flex-row">
      @can('products.store')
      <x-pos-dropdown route="{{ route('products.store') }}" :items="$products" name="{{ __('Products')}}" />
      @endcan
      @can('activations.store')
      <x-pos-dropdown route="{{ route('activations.store') }}" :items="$activations" name="{{ __('Activations')}}" />
      @endcan
      @can('movements.store')
      <x-pos-dropdown route="{{ route('movements.store') }}" :items=" $movements" name="{{ __('Movements')}}" />
      @endcan
    </div>
    <script>
      document.querySelectorAll("button.edit").forEach(function(button, key, parent) {
        button.addEventListener('click', function(event) {
          let id = button.parentElement.previousElementSibling.previousElementSibling.textContent;
          let name = button.parentElement.previousElementSibling.textContent;
          let target = button.getAttribute('data-target');
          let idInput = document.getElementById(target + '-id');
          let nameInput = document.getElementById(target + '-name');
          idInput.value = id;
          nameInput.value = name;
        });

      });
    </script>
</x-admin-layout>