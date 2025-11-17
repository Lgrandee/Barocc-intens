<x-layouts.app :title="$title ?? 'Admin Dashboard'">
  <main class="p-6">
    <header class="mb-6">
      <h1 class="text-2xl font-semibold">Admin Dashboard</h1>
      <p class="text-sm text-gray-500">Volledige systeemstatus en beheer van alle modules</p>
    </header>

    <nav class="mb-6">
      <ul>
        <li>
          <a href="{{ url()->previous() }}" class="text-sm text-indigo-600 hover:underline">&larr; Terug</a>
        </li>
      </ul>
    </nav>

    {{-- Welcome header (default content; child views can override) --}}
    @section('welcome')
    <div class="bg-gradient-to-br from-indigo-800 to-indigo-900 text-white rounded-xl p-6 mb-6">
      <h1 class="text-xl font-semibold mb-1">Welkom, Administrator 👋</h1>
      <p class="text-sm opacity-90 mb-4">Beheer alle systeemmodules en monitor de prestaties</p>
      <div class="flex flex-wrap gap-3">
        <button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded">👥 Gebruikers Beheren</button>
        <button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded">🔐 Rollen Configureren</button>
        <button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded">📊 Systeemrapporten</button>
        <button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded">⚙️ Instellingen</button>
      </div>
    </div>
    @show

    {{-- Stats grid (default content) --}}
    @section('stats')
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-6">
      <div class="bg-white border border-gray-200 rounded-lg p-4">
        <div class="flex justify-between items-start">
          <h3 class="text-sm text-gray-500">Actieve Gebruikers</h3>
          <div class="w-8 h-8 flex items-center justify-center bg-blue-100 text-blue-700 rounded">👥</div>
        </div>
        <p class="text-2xl font-semibold mt-3">24</p>
        <div class="flex items-center gap-2 text-sm text-green-600 mt-2">↑ 2 <span class="text-gray-400">deze week</span></div>
      </div>

      <div class="bg-white border border-gray-200 rounded-lg p-4">
        <div class="flex justify-between items-start">
          <h3 class="text-sm text-gray-500">Systeembelasting</h3>
          <div class="w-8 h-8 flex items-center justify-center bg-blue-100 text-blue-700 rounded">📊</div>
        </div>
        <p class="text-2xl font-semibold mt-3">32%</p>
        <div class="flex items-center gap-2 text-sm text-red-600 mt-2">↓ 5% <span class="text-gray-400">vs piek</span></div>
      </div>

      <div class="bg-white border border-gray-200 rounded-lg p-4">
        <div class="flex justify-between items-start">
          <h3 class="text-sm text-gray-500">API Requests</h3>
          <div class="w-8 h-8 flex items-center justify-center bg-blue-100 text-blue-700 rounded">🔄</div>
        </div>
        <p class="text-2xl font-semibold mt-3">2.4k</p>
        <div class="flex items-center gap-2 text-sm text-green-600 mt-2">↑ 12% <span class="text-gray-400">vandaag</span></div>
      </div>

      <div class="bg-white border border-gray-200 rounded-lg p-4">
        <div class="flex justify-between items-start">
          <h3 class="text-sm text-gray-500">Response Tijd</h3>
          <div class="w-8 h-8 flex items-center justify-center bg-blue-100 text-blue-700 rounded">⚡</div>
        </div>
        <p class="text-2xl font-semibold mt-3">238ms</p>
        <div class="flex items-center gap-2 text-sm text-green-600 mt-2">↓ 15ms <span class="text-gray-400">gemiddeld</span></div>
      </div>
    </div>
    @show

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <div class="lg:col-span-2 space-y-6">
        {{-- Alerts list (default) --}}
        @section('alerts')
        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
          <div class="flex items-center justify-between p-4 border-b border-gray-100">
            <h2 class="text-lg font-medium">Systeem Alerts</h2>
            <button class="text-sm text-gray-600">Alle Alerts</button>
          </div>
          <div class="p-4 divide-y divide-gray-100">
            <div class="flex gap-4 py-3">
              <div class="w-8 h-8 flex items-center justify-center rounded-full bg-red-100 text-red-700">⚠️</div>
              <div>
                <h4 class="font-medium">API Rate Limit Bereikt</h4>
                <p class="text-sm text-gray-500">Klant API heeft tijdelijk verhoogde activiteit</p>
              </div>
            </div>
            <div class="flex gap-4 py-3">
              <div class="w-8 h-8 flex items-center justify-center rounded-full bg-yellow-100 text-yellow-800">⚠️</div>
              <div>
                <h4 class="font-medium">Backup Vertraagd</h4>
                <p class="text-sm text-gray-500">Laatste backup 6 uur geleden uitgevoerd</p>
              </div>
            </div>
          </div>
        </div>
        @show

        {{-- Module grid (default) --}}
        @section('modules')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="bg-white border border-gray-200 rounded-lg p-4">
            <div class="flex justify-between items-start mb-3">
              <h3 class="font-medium">Sales Module</h3>
              <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-50 text-green-700">Actief</span>
            </div>
            <div class="flex gap-4">
              <div class="flex-1">
                <div class="text-sm text-gray-500">Actieve Offertes</div>
                <div class="text-xl font-semibold">45</div>
              </div>
              <div class="flex-1">
                <div class="text-sm text-gray-500">Conversie</div>
                <div class="text-xl font-semibold">68%</div>
              </div>
            </div>
          </div>

          <div class="bg-white border border-gray-200 rounded-lg p-4">
            <div class="flex justify-between items-start mb-3">
              <h3 class="font-medium">Finance Module</h3>
              <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-yellow-50 text-yellow-800">Actief</span>
            </div>
            <div class="flex gap-4">
              <div class="flex-1">
                <div class="text-sm text-gray-500">Open Facturen</div>
                <div class="text-xl font-semibold">28</div>
              </div>
              <div class="flex-1">
                <div class="text-sm text-gray-500">Te Ontvangen</div>
                <div class="text-xl font-semibold">€45k</div>
              </div>
            </div>
          </div>

          <div class="bg-white border border-gray-200 rounded-lg p-4">
            <div class="flex justify-between items-start mb-3">
              <h3 class="font-medium">Service Module</h3>
              <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-pink-50 text-pink-700">Actief</span>
            </div>
            <div class="flex gap-4">
              <div class="flex-1">
                <div class="text-sm text-gray-500">Open Tickets</div>
                <div class="text-xl font-semibold">12</div>
              </div>
              <div class="flex-1">
                <div class="text-sm text-gray-500">Gem. Responstijd</div>
                <div class="text-xl font-semibold">2.4u</div>
              </div>
            </div>
          </div>

          <div class="bg-white border border-gray-200 rounded-lg p-4">
            <div class="flex justify-between items-start mb-3">
              <h3 class="font-medium">Systeem Status</h3>
              <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-50 text-blue-700">Optimaal</span>
            </div>
            <div class="flex gap-4">
              <div class="flex-1">
                <div class="text-sm text-gray-500">CPU Gebruik</div>
                <div class="text-xl font-semibold">28%</div>
              </div>
              <div class="flex-1">
                <div class="text-sm text-gray-500">Geheugen</div>
                <div class="text-xl font-semibold">42%</div>
              </div>
            </div>
          </div>
        </div>
        @show
      </div>

      {{-- Activity sidebar (default) --}}
      <div>
        @section('activity')
        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
          <div class="flex items-center justify-between p-4 border-b border-gray-100">
            <h2 class="text-lg font-medium">Recente Activiteit</h2>
            <button class="text-sm text-gray-600">Filter</button>
          </div>
          <div class="p-4 divide-y divide-gray-100">
            <div class="py-3">
              <div class="flex justify-between items-start">
                <div>
                  <div class="font-medium">Nieuwe Gebruiker</div>
                  <div class="text-sm text-gray-500">Peter Jansen toegevoegd aan Sales team</div>
                </div>
                <div class="text-sm text-gray-400">14:25</div>
              </div>
            </div>
            <div class="py-3">
              <div class="flex justify-between items-start">
                <div>
                  <div class="font-medium">Rol Gewijzigd</div>
                  <div class="text-sm text-gray-500">Finance rol permissies bijgewerkt</div>
                </div>
                <div class="text-sm text-gray-400">13:15</div>
              </div>
            </div>
            <div class="py-3">
              <div class="flex justify-between items-start">
                <div>
                  <div class="font-medium">Systeem Update</div>
                  <div class="text-sm text-gray-500">Database backup voltooid</div>
                </div>
                <div class="text-sm text-gray-400">12:00</div>
              </div>
            </div>
            <div class="py-3">
              <div class="flex justify-between items-start">
                <div>
                  <div class="font-medium">Module Status</div>
                  <div class="text-sm text-gray-500">Facturatie module geoptimaliseerd</div>
                </div>
                <div class="text-sm text-gray-400">11:30</div>
              </div>
            </div>
            <div class="py-3">
              <div class="flex justify-between items-start">
                <div>
                  <div class="font-medium">Beveiliging</div>
                  <div class="text-sm text-gray-500">2-Factor authenticatie ingeschakeld</div>
                </div>
                <div class="text-sm text-gray-400">10:15</div>
              </div>
            </div>
            <div class="py-3">
              <div class="flex justify-between items-start">
                <div>
                  <div class="font-medium">API</div>
                  <div class="text-sm text-gray-500">Nieuwe API sleutels gegenereerd</div>
                </div>
                <div class="text-sm text-gray-400">09:45</div>
              </div>
            </div>
          </div>
        </div>
        @show
      </div>
    </div>
  </main>
</x-layouts.app>
