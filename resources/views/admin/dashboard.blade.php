@php($title = 'Admin Dashboard')
@extends('layouts.layout_dashboard')

@section('welcome_classes', 'bg-gradient-to-br from-blue-700 to-blue-500')
@section('welcome')
  <h1 class="text-xl font-semibold mb-1">Welcome, {{ auth()->user()->name ?? '' }}</h1>
	<p class="text-sm text-white/90 mb-4">You have 5 outstanding invoices and 3 reminders for this week</p>
	<div class="flex flex-wrap gap-3">
		<button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded">Manage Users</button>
		<button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded">Roles Overview</button>
		<button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded">Planner Page</button>
    <button class="bg-white/10 border border-white/20 text-white text-sm px-4 py-2 rounded">Inventory Management</button>
	</div>
@endsection

@section('stats')
	<div class="flex-1 min-w-0 bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
		<div class="flex justify-between items-start">
			<h3 class="text-sm text-gray-500">Revenue This Month</h3>
		</div>
		<p class="text-2xl font-semibold mt-3">€184.320</p>
	</div>

	<div class="flex-1 min-w-0 bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
		<div class="flex justify-between items-start">
			<h3 class="text-sm text-gray-500">Active Colleagues</h3>
		</div>
		<p class="text-2xl font-semibold mt-3">24</p>
	</div>

	<div class="flex-1 min-w-0 bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
		<div class="flex justify-between items-start">
			<h3 class="text-sm text-gray-500">Open Tickets</h3>
		</div>
		<p class="text-2xl font-semibold mt-3">18 tickets</p>
	</div>

	<div class="flex-1 min-w-0 bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
		<div class="flex justify-between items-start">
			<h3 class="text-sm text-gray-500">Outstanding Invoices</h3>
		</div>
		<p class="text-2xl font-semibold mt-3">25</p>
	</div>
@endsection

@section('alerts_title', 'Revenue')
@section('alerts_action')
<div class="flex gap-2">
	<button class="px-3 py-1 text-sm bg-yellow-100 text-yellow-700 rounded border border-yellow-200">Month</button>
	<button class="px-3 py-1 text-sm bg-white text-gray-600 rounded border border-gray-200">Year</button>
</div>
@endsection
@section('alerts')
<div class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-lg p-8 text-center">
	<p class="text-gray-500">Here will be a line chart with income vs expenses</p>
</div>
@endsection

@section('modules')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Sales Module -->
    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Sales Module</h3>
            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-50 text-green-700 border border-green-200">Active</span>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500 mb-1">Active Customers</p>
                <p class="text-2xl font-bold text-gray-900">45</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">New Customers / Week Overview</p>
                <p class="text-2xl font-bold text-gray-900">15</p>
            </div>
        </div>
    </div>
    <!-- Finance Module -->
    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Finance Module</h3>
            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-yellow-50 text-yellow-700 border border-yellow-200">Active</span>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500 mb-1">Open Invoices / Week Overview</p>
                <p class="text-2xl font-bold text-gray-900">28</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">To Receive / Week Overview</p>
                <p class="text-2xl font-bold text-gray-900">€1200</p>
            </div>
        </div>
    </div>
    <!-- Service Module -->
    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Service Module</h3>
            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-pink-50 text-pink-700 border border-pink-200">Active</span>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500 mb-1">Open Reports / Week Overview</p>
                <p class="text-2xl font-bold text-gray-900">3</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">On Location / Week Overview</p>
                <p class="text-2xl font-bold text-gray-900">1</p>
            </div>
        </div>
    </div>

    <!-- Levering / Logistiek -->
    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Delivery / Logistics</h3>
            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">Optimal</span>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500 mb-1">Deliveries / Week Overview</p>
                <p class="text-2xl font-bold text-gray-900">42</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">Deliveries / Week Overview</p>
                <p class="text-2xl font-bold text-gray-900">9</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('activity')
<div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
    <div class="flex items-center justify-between p-4 border-b border-gray-100">
        <h2 class="text-lg font-medium">Recent Activity</h2>
        <button class="text-sm text-gray-600">Filter</button>
    </div>
    <div class="p-4 divide-y divide-gray-100">
        <div class="py-3">
            <div class="flex justify-between items-start">
                <div>
                    <div class="font-medium">New User</div>
                    <div class="text-sm text-gray-500">Peter Jansen added to Sales team</div>
                </div>
                <div class="text-sm text-gray-400">14:25</div>
            </div>
        </div>
        <div class="py-3">
            <div class="flex justify-between items-start">
                <div>
                    <div class="font-medium">Role Modified</div>
                    <div class="text-sm text-gray-500">Finance role permissions updated</div>
                </div>
                <div class="text-sm text-gray-400">13:15</div>
            </div>
        </div>
        <div class="py-3">
            <div class="flex justify-between items-start">
                <div>
                    <div class="font-medium">System Update</div>
                    <div class="text-sm text-gray-500">Database backup completed</div>
                </div>
                <div class="text-sm text-gray-400">12:00</div>
            </div>
        </div>
        <div class="py-3">
            <div class="flex justify-between items-start">
                <div>
                    <div class="font-medium">Module Status</div>
                    <div class="text-sm text-gray-500">Invoicing module optimized</div>
                </div>
                <div class="text-sm text-gray-400">11:30</div>
            </div>
        </div>
        <div class="py-3">
            <div class="flex justify-between items-start">
                <div>
                    <div class="font-medium">Security</div>
                    <div class="text-sm text-gray-500">2-Factor authentication enabled</div>
                </div>
                <div class="text-sm text-gray-400">10:15</div>
            </div>
        </div>
        <div class="py-3">
            <div class="flex justify-between items-start">
                <div>
                    <div class="font-medium">API</div>
                    <div class="text-sm text-gray-500">New API keys generated</div>
                </div>
                <div class="text-sm text-gray-400">09:45</div>
            </div>
        </div>
    </div>
</div>
@endsection

