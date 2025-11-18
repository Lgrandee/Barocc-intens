<x-layouts.app :title="'Contract Overview'">
  <main class="p-6">
    <header class="mb-6">
      <h1 class="text-2xl font-semibold">Contract Overview</h1>
      <p class="text-sm text-gray-500">View active, expired and upcoming expiring contracts</p>
    </header>

    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
      <!-- Header with New contract button -->
      <div class="flex items-center justify-between p-4 border-b border-gray-100">
        <h2 class="text-lg font-medium">Contracts</h2>
        <a href="{{ route('contracts.create') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">New contract</a>
      </div>

      @livewire('contract-table')
    </div>

    <!-- Footer text -->
    <div class="mt-6 text-center">
      <p class="text-sm text-gray-500">Contract overview — management and actions</p>
    </div>
  </main>
</x-layouts.app>
