<x-layouts.app :title="'Contract Details'">
  <main class="p-6 max-w-4xl mx-auto">
    <header class="mb-6">
      <div class="flex items-center gap-3 mb-2">
        <a href="{{ route('contracts.index') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
          ← Back to overview
        </a>
      </div>
      <h1 class="text-2xl font-semibold">Contract Details</h1>
      <p class="text-sm text-gray-500">Details and actions for this contract</p>
    </header>

    @if(session('success'))
      <div class="mb-4 p-3 rounded-md bg-green-50 border border-green-100 text-green-800">
        {{ session('success') }}
      </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
      <!-- Contract nummer header -->
      <div class="p-6 border-b border-gray-100">
        <div class="flex justify-between items-start">
          <div>
            <div class="text-sm text-gray-500 mb-1">CON nummer</div>
            <h2 class="text-2xl font-semibold mb-2">CON-{{ date('Y', strtotime($contract->start_date)) }}-{{ str_pad($contract->id, 3, '0', STR_PAD_LEFT) }}</h2>
            <p class="text-gray-600">{{ $contract->products->pluck('product_name')->join(', ') ?: ($contract->product->product_name ?? 'N/A') }} — Location: {{ $contract->customer->city ?? 'Unknown' }}</p>
          </div>
          <div class="flex gap-2">
            @php
              $statusColors = [
                'active' => 'bg-green-100 text-green-800',
                'inactive' => 'bg-red-100 text-red-800',
                'pending' => 'bg-yellow-100 text-yellow-800'
              ];
              $statusLabels = [
                'active' => 'active',
                'inactive' => 'inactive',
                'pending' => 'pending'
              ];
            @endphp
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColors[$contract->status] ?? 'bg-gray-100 text-gray-800' }}">
              {{ $statusLabels[$contract->status] ?? ucfirst($contract->status) }}
            </span>
          </div>
        </div>
        <div class="flex gap-3 mt-4">
          <a href="{{ route('contracts.pdf', $contract->id) }}" class="text-indigo-600 hover:text-indigo-700 text-sm">Download PDF</a>
          <a href="#" class="text-indigo-600 hover:text-indigo-700 text-sm">Hide</a>
          <a href="#" class="text-indigo-600 hover:text-indigo-700 text-sm">Notifications</a>
        </div>
      </div>

      <!-- Twee kolommen layout -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
        <!-- Left column: Contract information -->
        <div>
          <h3 class="font-semibold mb-4">Contract Information</h3>
          <div class="space-y-3 text-sm">
            <div class="flex justify-between">
              <span class="text-gray-500">Contract number</span>
              <span class="font-medium">CON-{{ date('Y', strtotime($contract->start_date)) }}-{{ str_pad($contract->id, 3, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-500">Start date</span>
              <span class="font-medium">{{ \Carbon\Carbon::parse($contract->start_date)->format('d M Y') }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-500">End date</span>
              <span class="font-medium">{{ \Carbon\Carbon::parse($contract->end_date)->format('d M Y') }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-500">Notice period</span>
              <span class="font-medium">1 month</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-500">Type</span>
              <span class="font-medium">Service & Maintenance</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-500">Price (per year)</span>
              <span class="font-medium">€{{ number_format($contract->products->sum('price') ?: ($contract->product->price ?? 1250), 2, ',', '.') }}</span>
            </div>
          </div>

          <h3 class="font-semibold mt-6 mb-4">Status & Data</h3>
          <div class="space-y-3 text-sm">
            <div class="flex justify-between items-center">
              <span class="text-gray-500">Customer information</span>
            </div>
            <div>
              <div class="font-medium">{{ $contract->customer->name_company ?? 'Unknown' }}</div>
              <div class="text-gray-500">{{ $contract->customer->contact_person ?? 'Mark van Dijk' }}</div>
              <div class="text-gray-500">{{ $contract->customer->email ?? 'm.vandijk@vandijk.nl' }}</div>
              <div class="text-gray-500">Address: {{ $contract->customer->address ?? 'Keizerstraat 12' }}, {{ $contract->customer->zipcode ?? '1012 AB' }} {{ $contract->customer->city ?? 'Amsterdam' }}</div>
              <a href="#" class="text-indigo-600 hover:text-indigo-700 text-sm">Contact</a>
            </div>
          </div>
        </div>

        <!-- Right column: Terms & Remarks -->
        <div>
          <h3 class="font-semibold mb-4">Terms & Remarks</h3>
          <div class="text-sm text-gray-600 space-y-2 mb-6">
            <p>This contract includes standard maintenance services, parts and annual inspection. Additional work will be charged separately.</p>
            <ul class="list-disc list-inside space-y-1">
              <li>Delivery time/response: 48 hours</li>
              <li>Warranty: 2 years on performed work</li>
              <li>Payment: Annual invoice 30 days</li>
            </ul>
          </div>

          <h3 class="font-semibold mb-4">Payment & Service Planning</h3>
          <div class="space-y-3">
            <div class="flex justify-between items-center text-sm">
              <span class="text-gray-500">Description</span>
              <span class="text-gray-500">Date</span>
              <span class="text-gray-500 font-medium">Amount</span>
            </div>
            <div class="flex justify-between items-center text-sm">
              <span>Annual invoice 2025</span>
              <span>{{ \Carbon\Carbon::parse($contract->start_date)->format('d M Y') }}</span>
              <span class="font-medium">€{{ number_format($contract->products->sum('price') ?: ($contract->product->price ?? 1250), 2, ',', '.') }}</span>
            </div>
            <div class="flex justify-between items-center text-sm">
              <span>Interim service</span>
              <span>{{ \Carbon\Carbon::parse($contract->start_date)->addMonths(6)->format('d M Y') }}</span>
              <span class="font-medium">Included</span>
            </div>
          </div>

          <h3 class="font-semibold mt-6 mb-4">Maintenance Policy</h3>
          <div class="bg-blue-50 border border-blue-200 rounded-md p-4 text-sm">
            <p class="font-medium text-blue-900 mb-2">Monthly Maintenance Included</p>
            <p class="text-blue-800 mb-2">Customers receive <strong>1 free maintenance visit per month</strong> as part of this contract.</p>
            <p class="text-blue-800 mb-2">Additional maintenance beyond the monthly visit will incur extra charges, unless the issue is caused by a defect from Barroc Intens.</p>
            <p class="text-blue-800">Contact: <strong>service@barroc.nl</strong> or <strong>+31 (0)20 123 4567</strong></p>
          </div>

          <h3 class="font-semibold mt-6 mb-4">Attachments</h3>
          <div class="space-y-2">
            <a href="{{ route('contracts.pdf', $contract->id) }}" class="text-indigo-600 hover:text-indigo-700 text-sm flex items-center gap-2">
              <span>📄</span>
              <span>Contract-CON-{{ date('Y', strtotime($contract->start_date)) }}-{{ str_pad($contract->id, 3, '0', STR_PAD_LEFT) }}.pdf</span>
            </a>
          </div>

          <h3 class="font-semibold mt-6 mb-4">Activity & Notes</h3>
          <div class="space-y-3 text-sm">
            <div>
              <div class="flex justify-between items-start">
                <div>
                  <div class="font-medium">{{ \Carbon\Carbon::now()->subDays(7)->format('d M Y') }} — Customer confirmed extension via email</div>
                </div>
                <div class="text-gray-500">M.v.dijk</div>
              </div>
            </div>
            <div>
              <div class="flex justify-between items-start">
                <div>
                  <div class="font-medium">{{ \Carbon\Carbon::now()->subDays(45)->format('d M Y') }} — Inspection completed</div>
                </div>
                <div class="text-gray-500">Technician</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="mt-6 text-center">
      <p class="text-sm text-gray-500">Contract details — actions and history</p>
    </div>
  </main>
</x-layouts.app>
