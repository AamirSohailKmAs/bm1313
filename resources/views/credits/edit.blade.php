<x-app-layout>
  <x-slot:header>
    <header class="bg-brandSecondary kmas fixed top-0 w-full border-black px-3 text-center font-bold text-white">
      <x-nav />
      <div class="header-after"></div>
    </header>
  </x-slot:header>
  <main class="p-3">
    <form class="border rounded-lg bg-slate-300 mt-4 p-2 max-w-2xl mx-auto" action="{{ route('credits.update', $credit) }}" method="post">
      @csrf
      @method('PUT')
      <div class="text-gray-700 text-center">
        Update Credit
      </div>
      <div class="flex mx-3">
        <div class="mb-4 w-full">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="remark">Remarks</label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="remark" name="remark" type="text" value="{{ $credit->remark }}" placeholder="Remark">
        </div>

      </div>
      <div class="flex mx-3">
        <div class="mb-4 w-full">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="amount">
            {{ __('Credit Amount') }}
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="amount" name="amount" type="number" step="0.01" min="0" value="{{ $credit->amount }}" placeholder="{{ __('Credit Amount') }}" required>
        </div>
        <div class="ml-3 mt-3 flex items-center justify-between">
          <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Update
          </button>
        </div>
      </div>
    </form>
  </main>
</x-app-layout>