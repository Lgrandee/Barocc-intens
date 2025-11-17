@php($title = 'Finance Dashboard')
@extends('layouts.admin_dashboard')

@section('welcome')
<div>
	<h2 class="text-lg font-semibold">Finance overzicht</h2>
	<p class="text-sm text-gray-400">Facturen, cashflow en openstaand saldo</p>
</div>
@endsection

@section('stats')
	<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Open Facturen</h4>
			<div class="text-2xl font-bold">28</div>
		</div>
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Omzet (Mtd)</h4>
			<div class="text-2xl font-bold">€98k</div>
		</div>
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Te Ontvangen</h4>
			<div class="text-2xl font-bold">€45k</div>
		</div>
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Overdue</h4>
			<div class="text-2xl font-bold">€3.2k</div>
		</div>
	</div>
@endsection

@section('modules')
	<div class="bg-white border rounded-lg p-4">
		<h3 class="font-medium">Cashflow</h3>
		<p class="text-sm text-gray-500">Kort overzicht van cashpositie</p>
	</div>
@endsection

@section('activity')
	<div class="text-sm text-gray-500">Geen recente finance-activiteiten</div>
@endsection
<p> finance page </p>
