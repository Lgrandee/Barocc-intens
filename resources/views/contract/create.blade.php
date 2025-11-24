<x-layouts.app :title="'New contract'">
  <main class="p-6 max-w-4xl mx-auto">
    <header class="mb-6">
      <h1 class="text-2xl font-semibold">Create new contract</h1>
      <p class="text-sm text-gray-500">Create a new contract for an existing customer and product</p>
    </header>

    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
      <div class="p-6">
        <form id="contract-form" action="{{ route('contracts.store') }}" method="POST" class="space-y-6">
          @csrf

          @livewire('customer-search', ['initialId' => old('name_company_id')])

          <div>
            @livewire('product-multi-select', ['initialSelected' => old('product_ids', [])])
            @error('product_ids')
              <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
              <label for="start_date" class="font-semibold text-gray-700">Start date</label>
              <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
              @error('start_date')
                <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
              @enderror
              <input type="hidden" id="end_date" name="end_date" value="{{ old('end_date') }}" />
              <div id="end-date-display" class="mt-2 text-sm text-gray-600"></div>
            </div>
          </div>
          <script>
            document.addEventListener('DOMContentLoaded', function() {
              const startInput = document.getElementById('start_date');
              const endInput = document.getElementById('end_date');
              const endDisplay = document.getElementById('end-date-display');
              function setEndDate() {
                if (startInput.value) {
                  const start = new Date(startInput.value);
                  const end = new Date(start);
                  end.setFullYear(end.getFullYear() + 2);
                  // Format as yyyy-mm-dd
                  const yyyy = end.getFullYear();
                  const mm = String(end.getMonth() + 1).padStart(2, '0');
                  const dd = String(end.getDate()).padStart(2, '0');
                  const endDateStr = `${yyyy}-${mm}-${dd}`;
                  endInput.value = endDateStr;
                  // Format for display: dd-mm-yyyy
                  endDisplay.textContent = `End date: ${dd}-${mm}-${yyyy}`;
                } else {
                  endInput.value = '';
                  endDisplay.textContent = '';
                }
              }
              startInput.addEventListener('change', setEndDate);
              setEndDate();
            });
          </script>

          <div>
            <label class="font-semibold text-gray-700">Status</label>
            <div class="mt-1 inline-flex items-center gap-2">
              <span class="inline-flex items-center px-2 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">pending</span>
              <span class="text-sm text-gray-500">The status is automatically set to <strong>pending</strong> on creation.</span>
            </div>
          </div>

          <div class="flex justify-between items-center pt-4">
            <a href="{{ route('contracts.index') }}" class="text-sm text-gray-600 hover:text-gray-800 hover:underline">Cancel</a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md font-medium transition-colors">
              Create contract
            </button>
          </div>
        </form>
      </div>
    </div>

    <div class="mt-6 text-center">
      <p class="text-sm text-gray-500">Manage new contracts via finance — be careful when filling in contract data</p>
    </div>
  </main>
</x-layouts.app>
