@php($title = 'Technician Dashboard')
@extends('layouts.admin_dashboard')

@section('welcome')
<div>
	<h2 class="text-lg font-semibold">Technician overzicht</h2>
	<p class="text-sm text-gray-400">Open tickets, assigned taken en SLA-status</p>
</div>
@endsection

@section('stats')
	<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Open Tickets</h4>
			<div class="text-2xl font-bold">12</div>
		</div>
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Gem. Responstijd</h4>
			<div class="text-2xl font-bold">2.4u</div>
		</div>
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">SLA breaches</h4>
			<div class="text-2xl font-bold">1</div>
		</div>
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Assigned</h4>
			<div class="text-2xl font-bold">7</div>
		</div>
	</div>
@endsection

@section('modules')
	<div class="bg-white border rounded-lg p-4">
		<h3 class="font-medium">Mijn tickets</h3>
		<p class="text-sm text-gray-500">Top prioriteit en toegewezen taken</p>
	</div>
@endsection

@section('activity')
	<div class="text-sm text-gray-500">Geen recente technician-activiteiten</div>
@endsection
<p> technician page </p>
