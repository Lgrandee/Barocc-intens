@php($title = 'Sales Dashboard')
@extends('layouts.admin_dashboard')

@section('welcome')
<div>
	<h2 class="text-lg font-semibold">Sales overzicht</h2>
	<p class="text-sm text-gray-400">Snel overzicht van leads, offertes en omzet</p>
</div>
@endsection

@section('stats')
	<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Leads</h4>
			<div class="text-2xl font-bold">128</div>
		</div>
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Opportunities</h4>
			<div class="text-2xl font-bold">34</div>
		</div>
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Conversie</h4>
			<div class="text-2xl font-bold">18%</div>
		</div>
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Omzet (Mtd)</h4>
			<div class="text-2xl font-bold">€12.4k</div>
		</div>
	</div>
@endsection

@section('modules')
	<div class="grid grid-cols-1 gap-4">
		<div class="bg-white border rounded-lg p-4">
			<h3 class="font-medium">Recent Offertes</h3>
			<p class="text-sm text-gray-500">Laatste 5 offertes en status</p>
		</div>
	</div>
@endsection

@section('activity')
	<div>
		<div class="text-sm text-gray-500">Geen recente activiteiten</div>
	</div>
@endsection
<p> sales page </p>
