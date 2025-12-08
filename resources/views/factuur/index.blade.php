<x-layouts.app :title="'Factuur Overzicht'">
  <main class="p-6">
    <header class="mb-6">
      <a href="{{ route('finance.dashboard') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium mb-2 inline-block">← Terug naar Index</a>
      <h1 class="text-2xl font-semibold">Factuur Overzicht</h1>
      <p class="text-sm text-gray-500">Beheer en monitor alle facturen</p>
    </header>

    @if (session('success'))
      <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-md">
        {{ session('success') }}
      </div>
    @endif

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
      @php
        $facturen = \App\Models\Factuur::with('products')->get();
        $totalAmount = $facturen->sum(function($f) { return $f->total_amount; });
        $openstaand = $facturen->whereIn('status', ['verzonden', 'concept'])->sum(function($f) { return $f->total_amount; });
        $verlopen = $facturen->where('status', 'verlopen')->sum(function($f) { return $f->total_amount; });

        // Calculate average overdue days
        $verlopenFacturen = \App\Models\Factuur::where('status', 'verlopen')
          ->where('due_date', '<', now())
          ->get();
        $overdueDays = $verlopenFacturen->count() > 0
          ? $verlopenFacturen->avg(function($f) {
              return \Carbon\Carbon::parse($f->due_date)->diffInDays(now());
            })
          : 0;
      @endphp

      <div class="bg-white border border-gray-200 rounded-lg p-4">
        <div class="text-sm text-gray-500 mb-1">Totaal Facturen</div>
        <div class="text-2xl font-semibold text-gray-900">€{{ number_format($totalAmount, 0, ',', '.') }}</div>
        <div class="text-xs text-gray-500 mt-1">{{ \App\Models\Factuur::count() }} facturen deze maand</div>
      </div>

      <div class="bg-white border border-gray-200 rounded-lg p-4">
        <div class="text-sm text-gray-500 mb-1">Openstaand</div>
        <div class="text-2xl font-semibold text-gray-900">€{{ number_format($openstaand, 0, ',', '.') }}</div>
        <div class="text-xs text-gray-500 mt-1">{{ \App\Models\Factuur::whereIn('status', ['verzonden', 'concept'])->count() }} facturen te betalen</div>
      </div>

      <div class="bg-white border border-gray-200 rounded-lg p-4">
        <div class="text-sm text-gray-500 mb-1">Verlopen</div>
        <div class="text-2xl font-semibold text-red-600">€{{ number_format($verlopen, 0, ',', '.') }}</div>
        <div class="text-xs text-gray-500 mt-1">{{ \App\Models\Factuur::where('status', 'verlopen')->count() }} facturen > 30 dagen</div>
      </div>

      <div class="bg-white border border-gray-200 rounded-lg p-4">
        <div class="text-sm text-gray-500 mb-1">Gemiddelde Betaaltijd</div>
        <div class="text-2xl font-semibold text-gray-900">{{ number_format($overdueDays ?? 0, 1) }}</div>
        <div class="text-xs text-gray-500 mt-1">dagen in november</div>
      </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
      <!-- Header with New factuur button -->
      <div class="flex items-center justify-between p-4 border-b border-gray-100">
        <div class="flex items-center gap-4">
          <h2 class="text-lg font-medium">📄 Facturen</h2>
          <div class="flex gap-2">
            <button class="text-sm text-gray-600 hover:text-gray-900">📤 Verzenden</button>
            <button class="text-sm text-gray-600 hover:text-gray-900">🗑️ Verwijderen</button>
            <button class="text-sm text-gray-600 hover:text-gray-900">👤 Exporteren</button>
          </div>
        </div>
        <a href="{{ route('facturen.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
          + Nieuwe Factuur
        </a>
      </div>

      @livewire('factuur-table')
    </div>
  </main>
</x-layouts.app>
