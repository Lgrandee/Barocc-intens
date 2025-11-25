@php($title = 'Finance Dashboard')
@extends('layouts.layout_dashboard')

@section('welcome_classes', 'bg-gradient-to-br from-yellow-500 to-orange-600')
@section('welcome')
     <h1 class="text-xl font-semibold mb-1">Welcome, {{ auth()->user()->name ?? '' }}</h1>
	<p class="text-sm text-white/90 mb-4">You have 5 outstanding invoices and 3 reminders for this week</p>
	<div class="flex flex-wrap gap-3">
		<button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded">New Invoice</button>
		<button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded">Invoice Overview</button>
		<button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded">Ticket Overview</button>
	</div>
@endsection

@section('stats')
	<div class="flex-1 min-w-0 bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
		<div class="flex justify-between items-start">
			<h3 class="text-sm text-gray-500">Revenue This Month</h3>
		</div>
		<p class="text-2xl font-semibold mt-3">€184.320</p>
		<div class="flex items-center gap-2 text-sm text-green-600 mt-2">↑ 8% <span class="text-gray-400">vs last month</span></div>
	</div>

	<div class="flex-1 min-w-0 bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
		<div class="flex justify-between items-start">
			<h3 class="text-sm text-gray-500">Outstanding Invoices</h3>
		</div>
		<p class="text-2xl font-semibold mt-3">€42.850</p>
		<div class="flex items-center gap-2 text-sm text-red-600 mt-2">↓ 12% <span class="text-gray-400">vs last month</span></div>
	</div>


	<div class="flex-1 min-w-0 bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
		<div class="flex justify-between items-start">
			<h3 class="text-sm text-gray-500">Overdue Invoices</h3>
		</div>
		<p class="text-2xl font-semibold mt-3">8.4%</p>
		<div class="flex items-center gap-2 text-sm text-red-600 mt-2">↑ 1.2% <span class="text-gray-400">vs last month</span></div>
	</div>
@endsection

@section('alerts')
<div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
	<div class="flex items-center justify-between p-4 border-b border-gray-100">
		<h2 class="text-lg font-medium">Cashflow Overview</h2>
		<div class="flex gap-2">
			<button class="px-3 py-1 text-sm bg-yellow-100 text-yellow-700 rounded border border-yellow-200">Month</button>
			<button class="px-3 py-1 text-sm bg-white text-gray-600 rounded border border-gray-200">Quarter</button>
			<button class="px-3 py-1 text-sm bg-white text-gray-600 rounded border border-gray-200">Year</button>
		</div>
	</div>
	<div class="p-4">
		<div class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-lg p-8 text-center">
			<p class="text-gray-500">Here will be a line chart with income vs expenses</p>
		</div>
	</div>
</div>
@endsection

@section('modules')
<div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
	<div class="flex items-center justify-between p-4 border-b border-gray-100">
		<h2 class="text-lg font-medium">Recent Invoices</h2>
		<button class="text-sm text-gray-600">View All</button>
	</div>
	<div class="divide-y divide-gray-100">
		<div class="flex items-center p-4">
			<div class="flex-1 mr-4">
				<h4 class="font-medium">Invoice #2024-1187</h4>
				<p class="text-sm text-gray-500">van der Berg Family - Due date: Nov 22, 2024</p>
			</div>
			<div class="text-right">
				<div class="font-medium">€12.450</div>
				<span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-yellow-50 text-yellow-800">Processing</span>
			</div>
		</div>
		<div class="flex items-center p-4">
			<div class="flex-1 mr-4">
				<h4 class="font-medium">Invoice #2024-1186</h4>
				<p class="text-sm text-gray-500">Jansen Bakery - Due date: Nov 18, 2024</p>
			</div>
			<div class="text-right">
				<div class="font-medium">€8.950</div>
				<span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-50 text-green-700">Paid</span>
			</div>
		</div>
		<div class="flex items-center p-4">
			<div class="flex-1 mr-4">
				<h4 class="font-medium">Invoice #2024-1185</h4>
				<p class="text-sm text-gray-500">Utrecht Municipality - Due date: Nov 10, 2024</p>
			</div>
			<div class="text-right">
				<div class="font-medium">€42.000</div>
				<span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-red-50 text-red-700">Overdue</span>
			</div>
		</div>
	</div>
</div>
@endsection

@section('reminders_section')
<div class="flex items-start gap-3 p-4 border border-gray-200 rounded-lg shadow-sm mb-3">
	<div class="flex-1">
		<p class="text-sm font-medium mb-1">Send reminder to van der Berg Family</p>
		<p class="text-xs text-gray-500">Due date: Tomorrow</p>
	</div>
</div>
<div class="flex items-start gap-3 p-4 border border-gray-200 rounded-lg shadow-sm mb-3">
	<div class="flex-1">
		<p class="text-sm font-medium mb-1">Phone call with Utrecht Municipality</p>
		<p class="text-xs text-gray-500">Due date: This week</p>
	</div>
</div>
<div class="flex items-start gap-3 p-4 border border-gray-200 rounded-lg shadow-sm">
	<div class="flex-1">
		<p class="text-sm font-medium mb-1">Prepare monthly report</p>
		<p class="text-xs text-gray-500">Due date: End of week</p>
	</div>
</div>
@endsection

