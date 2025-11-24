@php($title = 'Admin Dashboard')
@extends('layouts.layout_dashboard')

@section('welcome')
	<h1 class="text-xl font-semibold mb-1">🔧 Admin Controle Panel</h1>
	<p class="text-sm opacity-90 mb-4">Beheer alle systeemmodules en gebruikers</p>
	<div class="flex flex-wrap gap-3">
		<button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded hover:bg-white/20">👥 Gebruikers</button>
		<button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded hover:bg-white/20">🔐 Rollen</button>
		<button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded hover:bg-white/20">📊 Rapporten</button>
		<button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded hover:bg-white/20">⚙️ Systeem</button>
	</div>
@endsection

@section('stats')
	<div class="flex flex-col md:flex-row md:space-x-6 gap-6">
		<div class="flex-1 bg-red-50 border border-red-200 rounded-lg p-4">
			<h3 class="text-sm text-red-700">🚨 Admin Stats</h3>
			<p class="text-2xl font-semibold mt-2">Totaal: 156 gebruikers</p>
			<div class="text-sm text-red-600 mt-1">↑ 8 nieuwe deze week</div>
		</div>
		<div class="flex-1 bg-orange-50 border border-orange-200 rounded-lg p-4">
			<h3 class="text-sm text-orange-700">⚠️ Systeem Load</h3>
			<p class="text-2xl font-semibold mt-2">CPU: 45%</p>
			<div class="text-sm text-orange-600 mt-1">Memory: 62%</div>
		</div>
		<div class="flex-1 bg-green-50 border border-green-200 rounded-lg p-4">
			<h3 class="text-sm text-green-700">✅ Uptime</h3>
			<p class="text-2xl font-semibold mt-2">99.2%</p>
			<div class="text-sm text-green-600 mt-1">15 dagen online</div>
		</div>
	</div>
@endsection

@section('modules')
	<div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
		<h3 class="font-medium mb-3">🔧 Admin Module Beheer</h3>
		<div class="grid grid-cols-2 gap-4">
			<div class="bg-white rounded p-3">
				<div class="text-sm font-medium">Gebruikers Module</div>
				<div class="text-xs text-green-600">✓ Actief - 156 gebruikers</div>
			</div>
			<div class="bg-white rounded p-3">
				<div class="text-sm font-medium">Security Module</div>
				<div class="text-xs text-yellow-600">⚠ Updates beschikbaar</div>
			</div>
		</div>
	</div>
@endsection

@section('activity')
	<div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
		<h3 class="font-medium mb-3">👤 Admin Activiteiten</h3>
		<div class="space-y-2 text-sm">
			<div>• Gebruiker toegevoegd: Jan de Vries (14:30)</div>
			<div>• System backup voltooid (12:00)</div>
			<div>• Security scan uitgevoerd (10:15)</div>
		</div>
		<div class="mt-3 text-xs text-purple-600">
			Laatst bijgewerkt: {{ now()->format('H:i:s') }}
		</div>
	</div>
@endsection