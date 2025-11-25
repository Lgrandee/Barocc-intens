<x-layouts.app :title="'Offerte Aanmaken'">
  <main class="p-4 max-w-2xl mx-auto">
    <header class="mb-6">
      <a href="{{ route('offertes.index') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium mb-2 inline-block">← Terug naar Index</a>
      <h1 class="text-2xl font-semibold">Offerte Aanmaken</h1>
      <p class="text-sm text-gray-500">Maak een nieuwe offerte aan voor een klant</p>
    </header>

    <form action="{{ route('offertes.store') }}" method="POST" class="space-y-6" id="offerte-form">
      @csrf
      <input type="hidden" name="status" id="status-input" value="pending">

      <!-- Klantgegevens Section -->
      <div class="bg-white border border-gray-200 rounded-lg p-4">
        <h2 class="text-lg font-medium mb-4 flex items-center gap-2">
          <span class="text-purple-600">👤</span> Klantgegevens
        </h2>

        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Klant</label>
            @livewire('customer-search', ['initialId' => old('name_company_id')])
            @error('name_company_id')
              <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>

      <!-- Producten Section -->
      <div class="bg-white border border-gray-200 rounded-lg p-4">
        <h2 class="text-lg font-medium mb-4 flex items-center gap-2">
          <span class="text-red-600">📦</span> Producten
        </h2>

        <div>
          @livewire('product-multi-select', ['initialSelected' => old('product_ids', [])])
          @error('product_ids')
            <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <!-- Voorwaarden & Details Section -->
      <div class="bg-white border border-gray-200 rounded-lg p-4">
        <h2 class="text-lg font-medium mb-4 flex items-center gap-2">
          <span class="text-gray-600">📋</span> Voorwaarden & Details
        </h2>

        <div class="space-y-4">
          <div>
            <label for="valid_until" class="block text-sm font-medium text-gray-700 mb-1">
              Offerte geldigheid
            </label>
            <input
              type="date"
              id="valid_until"
              name="valid_until"
              value="{{ old('valid_until', now()->addDays(30)->format('Y-m-d')) }}"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
            />
            @error('valid_until')
              <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div>
            <label for="delivery_time_weeks" class="block text-sm font-medium text-gray-700 mb-1">
              Levertijd
            </label>
            <select
              id="delivery_time_weeks"
              name="delivery_time_weeks"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
              <option value="2" {{ old('delivery_time_weeks') == '2' ? 'selected' : '' }}>2-3 weken</option>
              <option value="4" {{ old('delivery_time_weeks') == '4' ? 'selected' : '' }}>4-6 weken</option>
              <option value="8" {{ old('delivery_time_weeks') == '8' ? 'selected' : '' }}>8-12 weken</option>
            </select>
            @error('delivery_time_weeks')
              <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div>
            <label for="payment_terms_days" class="block text-sm font-medium text-gray-700 mb-1">
              Betalingsvoorwaarden
            </label>
            <select
              id="payment_terms_days"
              name="payment_terms_days"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
              <option value="14" {{ old('payment_terms_days') == '14' ? 'selected' : '' }}>14 dagen</option>
              <option value="30" {{ old('payment_terms_days') == '30' ? 'selected' : '' }}>30 dagen</option>
              <option value="60" {{ old('payment_terms_days') == '60' ? 'selected' : '' }}>60 dagen</option>
            </select>
            @error('payment_terms_days')
              <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div>
            <label for="custom_terms" class="block text-sm font-medium text-gray-700 mb-1">
              Aanvullende voorwaarden
            </label>
            <textarea
              id="custom_terms"
              name="custom_terms"
              rows="4"
              placeholder="Voeg hier eventuele aanvullende voorwaarden of opmerkingen toe..."
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >{{ old('custom_terms') }}</textarea>
            @error('custom_terms')
              <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="flex items-center justify-between pt-4 border-t border-gray-200">
        <p class="text-xs text-gray-500">Laatste wijziging: {{ now()->format('d M Y H:i') }}</p>
        <div class="flex gap-3">
          <button type="button" onclick="saveDraft()" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 font-medium">
            📝 Opslaan als concept
          </button>
          <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 font-medium">
            ✓ Offerte aanmaken
          </button>
        </div>
      </div>
    </form>

    <script>
      function saveDraft() {
        document.getElementById('status-input').value = 'draft';
        document.getElementById('offerte-form').submit();
      }
    </script>
  </main>
</x-layouts.app>
