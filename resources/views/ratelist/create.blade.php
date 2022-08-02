<x-admin-layout>
  <x-slot:rateList>
    active
    </x-slot>
    <div class="flex flex-col">
      @include('ratelist._forms')
      <livewire:brand-series-search />
    </div>
    <script>
      // let brandSelect = document.getElementById('brandSelect');
      // var series = document.getElementById('series');

      // brandSelect.addEventListener('change', showSeries);

      // let nameInput = document.getElementById('name');







      // function showSeries() {
      //   const xhttp = new XMLHttpRequest();
      //   xhttp.onload = function() {
      //     document.getElementById("series").innerHTML =
      //       this.responseText;
      //   }
      //   xhttp.open("POST", "{{-- route('categories.series') --}}");
      //   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      //   xhttp.send('category=' + this.value + '&_token={{csrf_token()}}');

      // }




      document.querySelectorAll("button.edit").forEach(function(button, key, parent) {
        button.addEventListener('click', function(event) {
          let target = button.getAttribute('data-target');
          let idInput = document.getElementById('id');
          let nameInput = document.getElementById('name');
          let parentNode = button.parentNode.parentNode;
          let id = parentNode.firstElementChild.textContent;
          let brand = parentNode.firstElementChild.nextElementSibling.textContent;
          let series = button.parentElement.previousElementSibling.textContent;
          idInput.value = id;

          if (target == 'brand') {
            if (isSeries.checked) {
              isSeries.checked = false;
              openDivs();
            }
            nameInput.value = brand;
          } else if (target == 'series') {
            nameInput.value = series;
            isSeries.checked = true;
            openDivs();
          }



          console.log(brand);
          // idInput.value = id;
          // nameInput.value = name;
        });

      });

      function edit(params) {

      }
    </script>
</x-admin-layout>