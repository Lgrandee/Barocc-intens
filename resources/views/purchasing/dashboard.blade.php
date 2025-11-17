@php($title = 'Purchasing Dashboard')
@extends('layouts.admin_dashboard')

@section('welcome')
<div>
	<h2 class="text-lg font-semibold">Inkoop overzicht</h2>
	<p class="text-sm text-gray-400">Open bestellingen, leveringen en leveranciers</p>
</div>
@endsection

@section('stats')
	<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Open POs</h4>
			<div class="text-2xl font-bold">23</div>
		</div>
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">In afwachting</h4>
			<div class="text-2xl font-bold">8</div>
		</div>
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Maandelijkse uitgaven</h4>
			<div class="text-2xl font-bold">€34k</div>
		</div>
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Leveranciers</h4>
			<div class="text-2xl font-bold">42</div>
		</div>
	</div>
@endsection

@section('modules')
	<div class="bg-white border rounded-lg p-4">
		<h3 class="font-medium">Aankomende leveringen</h3>
		<p class="text-sm text-gray-500">Volgende 3 leveringen en status</p>
	</div>
@endsection

@section('activity')
	<div class="text-sm text-gray-500">Geen recente inkoop-activiteiten</div>
@endsection
<p> purchasing page </p>
