@php($title = 'Admin Dashboard - Hoofd Overzicht')

<x-layouts.app :title="$title">
  <main class="p-6">
    
    <!-- Admin Welcome Header -->
    <div class="bg-gradient-to-br from-red-600 to-red-800 text-white rounded-xl p-6 mb-6">
      <h1 class="text-2xl font-bold mb-2">🔧 Admin Controle Centrum</h1>
      <p class="text-sm opacity-90 mb-4">Volledige toegang tot alle afdelingen en systeembeheer</p>
      <div class="flex flex-wrap gap-2">
        <span class="bg-white/20 px-3 py-1 rounded-full text-xs">Volledig Toegang</span>
        <span class="bg-white/20 px-3 py-1 rounded-full text-xs">Alle Modules</span>
        <span class="bg-white/20 px-3 py-1 rounded-full text-xs">Systeembeheer</span>
      </div>
    </div>

    <!-- Department Access Grid -->
    <div class="mb-6">
      <h2 class="text-lg font-semibold mb-4">📊 Afdelings Dashboards</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        
        <!-- Sales Dashboard -->
        <a href="{{ route('sales.dashboard') }}" class="block bg-white border-2 border-blue-200 rounded-lg p-4 hover:border-blue-400 hover:shadow-md transition-all">
          <div class="flex items-center mb-2">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">💼</div>
            <div>
              <h3 class="font-semibold text-gray-900">Sales</h3>
              <p class="text-sm text-gray-500">Verkoop & Klanten</p>
            </div>
          </div>
          <div class="text-xs text-blue-600">→ Bekijk Sales Dashboard</div>
        </a>

        <!-- Finance Dashboard -->
        <a href="{{ route('finance.dashboard') }}" class="block bg-white border-2 border-green-200 rounded-lg p-4 hover:border-green-400 hover:shadow-md transition-all">
          <div class="flex items-center mb-2">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">💰</div>
            <div>
              <h3 class="font-semibold text-gray-900">Finance</h3>
              <p class="text-sm text-gray-500">Financiën & Facturatie</p>
            </div>
          </div>
          <div class="text-xs text-green-600">→ Bekijk Finance Dashboard</div>
        </a>

        <!-- Purchasing Dashboard -->
        <a href="{{ route('purchasing.dashboard') }}" class="block bg-white border-2 border-purple-200 rounded-lg p-4 hover:border-purple-400 hover:shadow-md transition-all">
          <div class="flex items-center mb-2">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">🛒</div>
            <div>
              <h3 class="font-semibold text-gray-900">Purchasing</h3>
              <p class="text-sm text-gray-500">Inkoop & Voorraad</p>
            </div>
          </div>
          <div class="text-xs text-purple-600">→ Bekijk Purchasing Dashboard</div>
        </a>

        <!-- Technician Dashboard -->
        <a href="{{ route('technician.dashboard') }}" class="block bg-white border-2 border-orange-200 rounded-lg p-4 hover:border-orange-400 hover:shadow-md transition-all">
          <div class="flex items-center mb-2">
            <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">🔧</div>
            <div>
              <h3 class="font-semibold text-gray-900">Technician</h3>
              <p class="text-sm text-gray-500">Techniek & Onderhoud</p>
            </div>
          </div>
          <div class="text-xs text-orange-600">→ Bekijk Technician Dashboard</div>
        </a>

        <!-- Planner Dashboard -->
        <a href="{{ route('planner.dashboard') }}" class="block bg-white border-2 border-indigo-200 rounded-lg p-4 hover:border-indigo-400 hover:shadow-md transition-all">
          <div class="flex items-center mb-2">
            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">📅</div>
            <div>
              <h3 class="font-semibold text-gray-900">Planner</h3>
              <p class="text-sm text-gray-500">Planning & Schema's</p>
            </div>
          </div>
          <div class="text-xs text-indigo-600">→ Bekijk Planner Dashboard</div>
        </a>

        <!-- General Dashboard -->
        <a href="{{ route('dashboard') }}" class="block bg-white border-2 border-gray-200 rounded-lg p-4 hover:border-gray-400 hover:shadow-md transition-all">
          <div class="flex items-center mb-2">
            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center mr-3">🏠</div>
            <div>
              <h3 class="font-semibold text-gray-900">General</h3>
              <p class="text-sm text-gray-500">Algemeen Dashboard</p>
            </div>
          </div>
          <div class="text-xs text-gray-600">→ Bekijk General Dashboard</div>
        </a>

      </div>
    </div>

    <!-- Admin System Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
      <div class="bg-red-50 border border-red-200 rounded-lg p-4">
        <h3 class="text-sm font-medium text-red-800">🚨 Systeem Status</h3>
        <div class="text-2xl font-bold text-red-900 mt-1">Actief</div>
        <div class="text-xs text-red-600 mt-1">Alle modules online</div>
      </div>
      <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
        <h3 class="text-sm font-medium text-blue-800">👥 Totaal Gebruikers</h3>
        <div class="text-2xl font-bold text-blue-900 mt-1">156</div>
        <div class="text-xs text-blue-600 mt-1">8 nieuwe deze week</div>
      </div>
      <div class="bg-green-50 border border-green-200 rounded-lg p-4">
        <h3 class="text-sm font-medium text-green-800">⚡ Prestaties</h3>
        <div class="text-2xl font-bold text-green-900 mt-1">98.5%</div>
        <div class="text-xs text-green-600 mt-1">Uptime percentage</div>
      </div>
      <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
        <h3 class="text-sm font-medium text-yellow-800">🔧 Onderhoud</h3>
        <div class="text-2xl font-bold text-yellow-900 mt-1">2</div>
        <div class="text-xs text-yellow-600 mt-1">Geplande taken</div>
      </div>
    </div>

    <!-- Admin Tools -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <div class="bg-white border border-gray-200 rounded-lg p-6">
        <h3 class="font-semibold mb-4">⚙️ Admin Tools</h3>
        <div class="space-y-3">
          <button class="w-full text-left p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
            <div class="font-medium">👥 Gebruikersbeheer</div>
            <div class="text-sm text-gray-500">Beheer alle gebruikers en rollen</div>
          </button>
          <button class="w-full text-left p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
            <div class="font-medium">🔒 Beveiligingsinstellingen</div>
            <div class="text-sm text-gray-500">Configureer security opties</div>
          </button>
          <button class="w-full text-left p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
            <div class="font-medium">📊 Systeem Rapporten</div>
            <div class="text-sm text-gray-500">Genereer uitgebreide rapporten</div>
          </button>
        </div>
      </div>

      <div class="bg-white border border-gray-200 rounded-lg p-6">
        <h3 class="font-semibold mb-4">📋 Recente Admin Activiteit</h3>
        <div class="space-y-3 text-sm">
          <div class="flex justify-between items-start">
            <div>
              <div class="font-medium">Gebruiker toegevoegd</div>
              <div class="text-gray-500">Jan de Vries → Sales team</div>
            </div>
            <div class="text-xs text-gray-400">14:30</div>
          </div>
          <div class="flex justify-between items-start">
            <div>
              <div class="font-medium">Systeemupdate</div>
              <div class="text-gray-500">Database geoptimaliseerd</div>
            </div>
            <div class="text-xs text-gray-400">12:00</div>
          </div>
          <div class="flex justify-between items-start">
            <div>
              <div class="font-medium">Backup voltooid</div>
              <div class="text-gray-500">Automatische backup uitgevoerd</div>
            </div>
            <div class="text-xs text-gray-400">10:15</div>
          </div>
        </div>
        <div class="mt-4 pt-3 border-t text-xs text-gray-500">
          Laatste update: {{ now()->format('d-m-Y H:i:s') }}
        </div>
      </div>
    </div>

  </main>
</x-layouts.app>