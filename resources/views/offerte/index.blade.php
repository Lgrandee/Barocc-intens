<x-layouts.app :title="'Offerte Overzicht'">
  <main class="p-6">
    <header class="mb-6">
      <h1 class="text-2xl font-semibold">Offerte Overzicht</h1>
      <p class="text-sm text-gray-500">Beheer en bekijk alle offertes</p>
    </header>

    @if (session('success'))
      <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-md">
        {{ session('success') }}
      </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
      <!-- Header with New offerte button -->
      <div class="flex items-center justify-between p-4 border-b border-gray-100">
        <h2 class="text-lg font-medium">Offertes</h2>
        <a href="{{ route('offertes.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
          + Nieuwe Offerte
        </a>
      </div>

      @livewire('offerte-table')
    </div>
  </main>
</x-layouts.app>
