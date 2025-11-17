@php($title = 'Admin Dashboard')
@extends('layouts.admin_dashboard')

@section('welcome')
	{{-- keep the layout default welcome or add admin-specific notes here --}}
	<div>
		<h2 class="text-lg font-semibold">Administrator Console</h2>
		<p class="text-sm text-gray-400">Systeembrede instellingen en beheer</p>
	</div>
@endsection

@section('stats')
	<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Actieve Gebruikers</h4>
			<div class="text-2xl font-bold">24</div>
		</div>
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Systeembelasting</h4>
			<div class="text-2xl font-bold">32%</div>
		</div>
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">API Requests</h4>
			<div class="text-2xl font-bold">2.4k</div>
		</div>
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Response Tijd</h4>
			<div class="text-2xl font-bold">238ms</div>
		</div>
	</div>
@endsection

@section('modules')
	<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
		<div class="bg-white border rounded-lg p-4">
			<h3 class="font-medium">Systeem Alerts (kort)</h3>
			<p class="text-sm text-gray-500">Snelle meldingen van kritieke items</p>
		</div>
		<div class="bg-white border rounded-lg p-4">
			<h3 class="font-medium">Configuratie</h3>
			<p class="text-sm text-gray-500">Systeeminstellingen en beheerlinks</p>
		</div>
	</div>
@endsection

@section('activity')
	<div class="text-sm text-gray-500">Laatste systeemacties en logs</div>
@endsection
