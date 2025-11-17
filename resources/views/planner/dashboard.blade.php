@php($title = 'Planner Dashboard')
@extends('layouts.admin_dashboard')

@section('welcome')
<div>
	<h2 class="text-lg font-semibold">Planner overzicht</h2>
	<p class="text-sm text-gray-400">Overzicht van planning, capaciteit en tickets</p>
</div>
@endsection

@section('stats')
	<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Geplande taken</h4>
			<div class="text-2xl font-bold">56</div>
		</div>
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Voltooide</h4>
			<div class="text-2xl font-bold">42</div>
		</div>
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Capaciteit</h4>
			<div class="text-2xl font-bold">78%</div>
		</div>
		<div class="bg-white border rounded-lg p-4">
			<h4 class="text-sm text-gray-500">Achterstand</h4>
			<div class="text-2xl font-bold">4</div>
		</div>
	</div>
@endsection

@section('modules')
	<div class="bg-white border rounded-lg p-4">
		<h3 class="font-medium">Vandaag</h3>
		<p class="text-sm text-gray-500">Taken en resources voor vandaag</p>
	</div>
@endsection

@section('activity')
	<div class="text-sm text-gray-500">Geen recente planning-activiteiten</div>
@endsection
<p> planner page </p>
