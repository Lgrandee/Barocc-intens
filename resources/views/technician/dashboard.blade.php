@php($title = 'Technician Dashboard')
@extends('layouts.layout_dashboard')

@section('welcome_classes', 'bg-gradient-to-br from-red-500 to-red-700')
@section('welcome')
	<h1 class="text-xl font-semibold mb-1">Goedemorgen, Sarah 👋</h1>
	<p class="text-sm text-white/90 mb-4">Je hebt 8 geplande afspraken en 3 urgente tickets voor vandaag</p>
	<div class="flex flex-wrap gap-3">
		<button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded">+ Nieuwe Afspraak</button>
		<button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded">+ Ticket Aanmaken</button>
		<button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded">📅 Planning</button>
	</div>
@endsection

@section('stats')
	<div class="flex-1 min-w-0 bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
		<div class="flex justify-between items-start">
			<h3 class="text-sm text-gray-500">Open Tickets</h3>
			<div class="w-8 h-8 flex items-center justify-center bg-red-100 text-red-700 rounded">🎫</div>
		</div>
		<p class="text-2xl font-semibold mt-3">24</p>
		<div class="flex items-center gap-2 text-sm text-green-600 mt-2">↓ 15% <span class="text-gray-400">vs vorige week</span></div>
	</div>

	<div class="flex-1 min-w-0 bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
		<div class="flex justify-between items-start">
			<h3 class="text-sm text-gray-500">Geplande Service</h3>
			<div class="w-8 h-8 flex items-center justify-center bg-red-100 text-red-700 rounded">🔧</div>
		</div>
		<p class="text-2xl font-semibold mt-3">12</p>
		<div class="flex items-center gap-2 text-sm text-green-600 mt-2">↑ 3 <span class="text-gray-400">voor deze week</span></div>
	</div>

	<div class="flex-1 min-w-0 bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
		<div class="flex justify-between items-start">
			<h3 class="text-sm text-gray-500">Gemiddelde Responstijd</h3>
			<div class="w-8 h-8 flex items-center justify-center bg-red-100 text-red-700 rounded">⏱️</div>
		</div>
		<p class="text-2xl font-semibold mt-3">4.2u</p>
		<div class="flex items-center gap-2 text-sm text-red-600 mt-2">↑ 0.8u <span class="text-gray-400">vs vorige week</span></div>
	</div>

	<div class="flex-1 min-w-0 bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
		<div class="flex justify-between items-start">
			<h3 class="text-sm text-gray-500">Voorraad Alerts</h3>
			<div class="w-8 h-8 flex items-center justify-center bg-red-100 text-red-700 rounded">⚠️</div>
		</div>
		<p class="text-2xl font-semibold mt-3">5</p>
		<div class="flex items-center gap-2 text-sm text-green-600 mt-2">↓ 2 <span class="text-gray-400">vs gisteren</span></div>
	</div>
@endsection

@section('alerts')
<div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
	<div class="flex items-center justify-between p-4 border-b border-gray-100">
		<h2 class="text-lg font-medium">Planning Deze Week</h2>
		<div class="flex gap-2">
			<button class="px-3 py-1 text-sm bg-red-100 text-red-700 rounded border border-red-200">Week</button>
			<button class="px-3 py-1 text-sm bg-white text-gray-600 rounded border border-gray-200">Maand</button>
		</div>
	</div>
	<div class="p-4 space-y-3">
		<div class="border border-gray-200 rounded-lg p-3 shadow-sm">
			<div class="font-medium text-sm mb-2">Maandag 18 november</div>
			<div class="space-y-2">
				<div class="flex items-center gap-2 p-2 bg-gray-50 rounded text-sm">
					<span class="font-medium min-w-12">09:00</span>
					<span>Onderhoud zonnepanelen - Familie Janssen</span>
				</div>
				<div class="flex items-center gap-2 p-2 bg-gray-50 rounded text-sm">
					<span class="font-medium min-w-12">14:00</span>
					<span>Warmtepomp reparatie - Bakkerij van Dijk</span>
				</div>
			</div>
		</div>
		<div class="border border-gray-200 rounded-lg p-3 shadow-sm">
			<div class="font-medium text-sm mb-2">Dinsdag 19 november</div>
			<div class="space-y-2">
				<div class="flex items-center gap-2 p-2 bg-gray-50 rounded text-sm">
					<span class="font-medium min-w-12">10:30</span>
					<span>Installatie nieuwe inverter - Restaurant de Haven</span>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('modules')
<div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
	<div class="flex items-center justify-between p-4 border-b border-gray-100">
		<h2 class="text-lg font-medium">Urgente Tickets</h2>
		<button class="text-sm text-gray-600">Alle Tickets</button>
	</div>
	<div class="divide-y divide-gray-100">
		<div class="flex items-start p-4 gap-3">
			<div class="w-2 h-2 bg-red-500 rounded-full mt-2"></div>
			<div class="flex-1">
				<h4 class="font-medium text-sm">Zonnepanelen offline - Bedrijf ABC</h4>
				<p class="text-sm text-gray-500">Klant: Jan de Vries - Locatie: Amsterdam Noord</p>
			</div>
			<span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-red-50 text-red-700">Open</span>
		</div>
		<div class="flex items-start p-4 gap-3">
			<div class="w-2 h-2 bg-yellow-500 rounded-full mt-2"></div>
			<div class="flex-1">
				<h4 class="font-medium text-sm">Warmtepomp geluidsoverlast</h4>
				<p class="text-sm text-gray-500">Klant: Maria Peters - Locatie: Utrecht Centrum</p>
			</div>
			<span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-yellow-50 text-yellow-800">In behandeling</span>
		</div>
		<div class="flex items-start p-4 gap-3">
			<div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
			<div class="flex-1">
				<h4 class="font-medium text-sm">Jaarlijkse inspectie systeem</h4>
				<p class="text-sm text-gray-500">Klant: Gemeente Almere - Locatie: Sportcomplex</p>
			</div>
			<span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-50 text-green-700">Voltooid</span>
		</div>
	</div>
</div>
@endsection

@section('activity')
<div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
	<div class="flex items-center justify-between p-4 border-b border-gray-100">
		<h2 class="text-lg font-medium">Voorraad Status</h2>
		<button class="text-sm text-gray-600">Alles Bekijken</button>
	</div>
	<div class="p-4 space-y-3">
		<div class="flex items-center justify-between py-2 border-b border-gray-100">
			<div class="text-sm">Zonnepaneel kabels (50m)</div>
			<div class="text-sm font-medium text-red-600">Laag: 3 rollen</div>
		</div>
		<div class="flex items-center justify-between py-2 border-b border-gray-100">
			<div class="text-sm">Warmtepomp filters</div>
			<div class="text-sm font-medium">OK: 24 stuks</div>
		</div>
		<div class="flex items-center justify-between py-2 border-b border-gray-100">
			<div class="text-sm">Inverter onderdelen</div>
			<div class="text-sm font-medium text-red-600">Laag: 2 sets</div>
		</div>
		<div class="flex items-center justify-between py-2 border-b border-gray-100">
			<div class="text-sm">Bevestigingsmaterialen</div>
			<div class="text-sm font-medium">OK: 150 stuks</div>
		</div>
		<div class="flex items-center justify-between py-2">
			<div class="text-sm">Meetapparatuur batterijen</div>
			<div class="text-sm font-medium text-yellow-600">Medium: 8 stuks</div>
		</div>
	</div>
</div>
@endsection
