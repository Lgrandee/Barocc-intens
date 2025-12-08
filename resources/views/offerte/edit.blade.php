<x-layouts.app :title="'Offerte Bewerken'">
  <main class="p-6 max-w-4xl mx-auto">
    <header class="mb-6">
      <h1 class="text-2xl font-semibold">Offerte Bewerken</h1>
      <p class="text-sm text-gray-500">Bewerk offerte OFF-{{ date('Y', strtotime($offerte->created_at)) }}-{{ str_pad($offerte->id, 3, '0', STR_PAD_LEFT) }}</p>
    </header>

    <a href="{{ route('offertes.show', $offerte->id) }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 text-sm font-medium mb-6">
      ← Terug naar goedkeuren
    </a>

    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
      <div class="p-6">
        <form id="offerte-form" action="{{ route('offertes.update', $offerte->id) }}" method="POST" class="space-y-6">
          @csrf
          @method('PUT')

          @livewire('customer-search', ['initialId' => $offerte->name_company_id])

          <div>
            @livewire('product-multi-select', [
              'initialSelected' => $offerte->products->pluck('id')->toArray(),
              'initialQuantities' => $offerte->products->pluck('pivot.quantity', 'id')->toArray()
            ])
            @error('product_ids')
              <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div>
            <label for="status" class="font-semibold text-gray-700">Status</label>
            <select id="status" name="status" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
              <option value="pending" {{ $offerte->status == 'pending' ? 'selected' : '' }}>Verstuurd (pending)</option>
              <option value="accepted" {{ $offerte->status == 'accepted' ? 'selected' : '' }}>Goedgekeurd (accepted)</option>
              <option value="rejected" {{ $offerte->status == 'rejected' ? 'selected' : '' }}>Verlopen (rejected)</option>
            </select>
            @error('status')
              <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="flex justify-between items-center pt-4">
            <a href="{{ route('offertes.show', $offerte->id) }}" class="text-sm text-gray-600 hover:text-gray-800 hover:underline">Annuleren</a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md font-medium transition-colors">
              Opslaan
            </button>
          </div>
        </form>
      </div>
    </div>
  </main>
</x-layouts.app>
