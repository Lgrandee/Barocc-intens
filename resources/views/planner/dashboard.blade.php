@php($title = 'Planner Dashboard')
@extends('layouts.layout_dashboard')

@section('welcome_classes', 'bg-gradient-to-br from-purple-600 to-purple-800')
@section('welcome')
	<h1 class="text-xl font-semibold mb-1">Goedemorgen, Alex 👋</h1>
	<p class="text-sm text-white/90 mb-4">Je hebt 12 taken ingepland voor vandaag en 3 urgente aanpassingen</p>
	<div class="flex flex-wrap gap-3">
		<button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded">+ Nieuwe Planning</button>
		<button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded">👥 Teamcapaciteit</button>
		<button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded">📊 Overzicht</button>
	</div>
@endsection

@section('stats')
	<div class="flex-1 min-w-0 bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
		<div class="flex justify-between items-start">
			<h3 class="text-sm text-gray-500">Geplande Taken</h3>
			<div class="w-8 h-8 flex items-center justify-center bg-purple-100 text-purple-700 rounded">📅</div>
		</div>
		<p class="text-2xl font-semibold mt-3">56</p>
		<div class="flex items-center gap-2 text-sm text-green-600 mt-2">↑ 8 <span class="text-gray-400">deze week</span></div>
	</div>

	<div class="flex-1 min-w-0 bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
		<div class="flex justify-between items-start">
			<h3 class="text-sm text-gray-500">Voltooide Taken</h3>
			<div class="w-8 h-8 flex items-center justify-center bg-purple-100 text-purple-700 rounded">✅</div>
		</div>
		<p class="text-2xl font-semibold mt-3">42</p>
		<div class="flex items-center gap-2 text-sm text-green-600 mt-2">↑ 12% <span class="text-gray-400">vs vorige week</span></div>
	</div>

	<div class="flex-1 min-w-0 bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
		<div class="flex justify-between items-start">
			<h3 class="text-sm text-gray-500">Team Capaciteit</h3>
			<div class="w-8 h-8 flex items-center justify-center bg-purple-100 text-purple-700 rounded">👥</div>
		</div>
		<p class="text-2xl font-semibold mt-3">78%</p>
		<div class="flex items-center gap-2 text-sm text-yellow-600 mt-2">= 0% <span class="text-gray-400">vs gemiddeld</span></div>
	</div>

	<div class="flex-1 min-w-0 bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
		<div class="flex justify-between items-start">
			<h3 class="text-sm text-gray-500">Achterstand</h3>
			<div class="w-8 h-8 flex items-center justify-center bg-red-100 text-red-700 rounded">⚠️</div>
		</div>
		<p class="text-2xl font-semibold mt-3">4</p>
		<div class="flex items-center gap-2 text-sm text-red-600 mt-2">↑ 1 <span class="text-gray-400">vs gisteren</span></div>
	</div>
@endsection

@section('alerts')
<div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
	<div class="flex items-center justify-between p-4 border-b border-gray-100">
		<h2 class="text-lg font-medium">Wekelijks Overzicht</h2>
		<div class="flex gap-2">
			<button class="px-3 py-1 text-sm bg-purple-100 text-purple-700 rounded border border-purple-200">Deze Week</button>
			<button class="px-3 py-1 text-sm bg-white text-gray-600 rounded border border-gray-200">Volgende Week</button>
		</div>
	</div>
	<div class="p-4">
		<div class="space-y-4">
			<div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
				<div>
					<div class="font-medium text-sm">Maandag 18 nov</div>
					<div class="text-xs text-gray-500">8 taken gepland</div>
				</div>
				<div class="text-sm text-green-600">85% capaciteit</div>
			</div>
			<div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
				<div>
					<div class="font-medium text-sm">Dinsdag 19 nov</div>
					<div class="text-xs text-gray-500">12 taken gepland</div>
				</div>
				<div class="text-sm text-red-600">110% capaciteit</div>
			</div>
			<div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
				<div>
					<div class="font-medium text-sm">Woensdag 20 nov</div>
					<div class="text-xs text-gray-500">6 taken gepland</div>
				</div>
				<div class="text-sm text-green-600">65% capaciteit</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('modules')
<div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
	<div class="flex items-center justify-between p-4 border-b border-gray-100">
		<h2 class="text-lg font-medium">Team Planning</h2>
		<button class="text-sm text-gray-600">Kalender Weergave</button>
	</div>
	<div class="divide-y divide-gray-100">
		<div class="p-4">
			<div class="flex items-center justify-between mb-2">
				<div class="font-medium text-sm">Sarah (Technician)</div>
				<div class="text-xs text-green-600">Beschikbaar</div>
			</div>
			<div class="text-sm text-gray-500">Vandaag: 3 afspraken - 09:00, 14:00, 16:30</div>
		</div>
		<div class="p-4">
			<div class="flex items-center justify-between mb-2">
				<div class="font-medium text-sm">Mark (Technician)</div>
				<div class="text-xs text-yellow-600">Bijna vol</div>
			</div>
			<div class="text-sm text-gray-500">Vandaag: 4 afspraken - 08:30, 11:00, 13:30, 15:00</div>
		</div>
		<div class="p-4">
			<div class="flex items-center justify-between mb-2">
				<div class="font-medium text-sm">Lisa (Sales)</div>
				<div class="text-xs text-blue-600">Extern</div>
			</div>
			<div class="text-sm text-gray-500">Vandaag: 2 klantbezoeken - 10:00, 15:30</div>
		</div>
	</div>
</div>
@endsection

@section('activity')
<div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
	<div class="flex items-center justify-between p-4 border-b border-gray-100">
		<h2 class="text-lg font-medium">Urgente Aanpassingen</h2>
		<button class="text-sm text-gray-600">Alle Meldingen</button>
	</div>
	<div class="divide-y divide-gray-100">
		<div class="p-4">
			<div class="flex items-start gap-3">
				<div class="w-2 h-2 bg-red-500 rounded-full mt-2"></div>
				<div class="flex-1">
					<div class="font-medium text-sm">Afspraak verzet - Familie Janssen</div>
					<div class="text-sm text-gray-500">Van 14:00 naar 16:00 - Sarah beschikbaarheid controleren</div>
					<div class="text-xs text-gray-400">2 minuten geleden</div>
				</div>
			</div>
		</div>
		<div class="p-4">
			<div class="flex items-start gap-3">
				<div class="w-2 h-2 bg-yellow-500 rounded-full mt-2"></div>
				<div class="flex-1">
					<div class="font-medium text-sm">Extra materiaal nodig - Bakkerij van Dijk</div>
					<div class="text-sm text-gray-500">Mark heeft aanvullende onderdelen nodig voor reparatie</div>
					<div class="text-xs text-gray-400">15 minuten geleden</div>
				</div>
			</div>
		</div>
		<div class="p-4">
			<div class="flex items-start gap-3">
				<div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
				<div class="flex-1">
					<div class="font-medium text-sm">Nieuwe installatie aanvraag</div>
					<div class="text-sm text-gray-500">Restaurant de Haven - spoedaanvraag voor volgende week</div>
					<div class="text-xs text-gray-400">1 uur geleden</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
