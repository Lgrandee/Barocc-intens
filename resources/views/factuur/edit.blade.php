<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factuur bewerken</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <div class="bg-white border-b border-gray-200 px-6 py-4">
            <h1 class="text-2xl font-semibold text-gray-900">Factuur bewerken</h1>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-8">
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('facturen.update', $factuur->id) }}" method="POST" id="factuurForm">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Left Column - Main Form -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Bewerk factuur section -->
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-lg font-semibold text-gray-900">Bewerk factuur</h2>
                                <div class="flex gap-2">
                                    <button type="button" onclick="window.location.href='{{ route('facturen.index') }}'"
                                        class="px-4 py-2 text-sm border border-gray-300 rounded text-gray-700 hover:bg-gray-50">
                                        Annuleren
                                    </button>
                                    <button type="submit"
                                        class="px-4 py-2 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                        Opslaan wijzigingen
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <!-- Factuur Info -->
                                <div class="bg-gray-50 border border-gray-200 rounded p-4">
                                    <div class="grid grid-cols-4 gap-4 text-sm">
                                        <div>
                                            <div class="text-xs text-gray-500">Klant</div>
                                            <span class="text-gray-900 font-medium">{{ $factuur->customer->name_company ?? 'Onbekend' }}</span>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500">Factuurnr</div>
                                            <span class="text-gray-900 font-medium">{{ $factuur->factuurnr }}</span>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500">Factuurdatum</div>
                                            <span class="text-gray-600">{{ \Carbon\Carbon::parse($factuur->invoice_date)->format('d-m-Y') }}</span>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500">Status</div>
                                            @switch($factuur->status)
                                                @case('betaald')
                                                    <span class="text-green-700 font-medium">✅ Betaald</span>
                                                    @break
                                                @case('verzonden')
                                                    <span class="text-yellow-700 font-medium">📧 Verzonden</span>
                                                    @break
                                                @case('verlopen')
                                                    <span class="text-red-700 font-medium">⚠️ Verlopen</span>
                                                    @break
                                                @case('concept')
                                                    <span class="text-gray-700 font-medium">📝 Concept</span>
                                                    @break
                                            @endswitch
                                        </div>
                                    </div>
                                    <div class="mt-2 pt-2 border-t text-xs space-y-1">
                                        @if($factuur->offerte)
                                            <div>
                                                <span class="text-gray-500">Gekoppeld aan offerte:</span>
                                                <a href="{{ route('offertes.show', $factuur->offerte->id) }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                                                    OFF-{{ date('Y', strtotime($factuur->offerte->created_at)) }}-{{ str_pad($factuur->offerte->id, 3, '0', STR_PAD_LEFT) }}
                                                </a>
                                            </div>
                                        @endif
                                        @if($factuur->reference)
                                            <div>
                                                <span class="text-gray-500">Referentie:</span>
                                                <span class="text-gray-900">{{ $factuur->reference }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>                                <!-- Customer Search (read-only display) -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Klant</label>
                                    <input type="text" value="{{ $factuur->customer->name_company ?? '' }}" disabled
                                        class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50 text-gray-700">
                                    <input type="hidden" name="name_company_id" value="{{ $factuur->name_company_id }}">
                                </div>

                                <!-- Regels Header -->
                                <div class="pt-4">
                                    <div class="grid grid-cols-12 gap-2 text-xs font-medium text-gray-500 uppercase mb-2">
                                        <div class="col-span-5">Omschrijving</div>
                                        <div class="col-span-2">Aantal</div>
                                        <div class="col-span-2">Prijs</div>
                                        <div class="col-span-2">Actie</div>
                                    </div>
                                </div>

                                <!-- Products -->
                                @livewire('product-multi-select', [
                                    'name' => 'products',
                                    'initialSelected' => $factuur->products->pluck('id')->toArray(),
                                    'initialQuantities' => $factuur->products->mapWithKeys(function($product) {
                                        return [$product->id => $product->pivot->quantity];
                                    })->toArray()
                                ])

                                <!-- Add Rule Button -->
                                <button type="button" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                                    + Regel toevoegen
                                </button>

                                <!-- Description -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Omschrijving (zichtbaar op factuur)</label>
                                    <textarea name="description" rows="2"
                                        class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ $factuur->description ?? '' }}</textarea>
                                </div>

                                <!-- Internal Notes -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Interne notities (niet zichtbaar voor klant)</label>
                                    <textarea name="notes" rows="2"
                                        class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-yellow-50">{{ $factuur->notes ?? '' }}</textarea>
                                    <p class="text-xs text-gray-500 mt-1">💡 Deze notities zijn alleen voor intern gebruik</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Summary & History -->
                    <div class="lg:col-span-1 space-y-6">
                        <!-- Total Summary -->
                        <div class="bg-white rounded-lg shadow p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Totaal</h2>

                            <div class="space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Subtotaal</span>
                                    <span class="font-medium" id="subtotal">€{{ number_format($factuur->products->sum(function($p) { return $p->price * $p->pivot->quantity; }), 2, ',', '.') }}</span>
                                </div>

                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">BTW (21%)</span>
                                    <span class="font-medium" id="btw">€{{ number_format($factuur->products->sum(function($p) { return $p->price * $p->pivot->quantity; }) * 0.21, 2, ',', '.') }}</span>
                                </div>

                                <div class="border-t pt-3 flex justify-between">
                                    <span class="font-semibold text-gray-900">Totaal</span>
                                    <span class="font-semibold text-gray-900 text-lg" id="total">€{{ number_format($factuur->total_amount * 1.21, 2, ',', '.') }}</span>
                                </div>
                            </div>

                            <a href="{{ route('facturen.send', $factuur->id) }}" class="block text-center text-indigo-600 hover:text-indigo-700 mt-6 text-sm font-medium">
                                Verstuur factuur →
                            </a>
                        </div>

                        <!-- Change History -->
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Wijzigingsgeschiedenis</h3>

                            <div class="space-y-3 text-sm">
                                <div>
                                    <div class="text-gray-600">{{ \Carbon\Carbon::parse($factuur->updated_at)->format('d M Y') }}</div>
                                    <div class="text-gray-900">— Aangepast door {{ Auth::user()->name ?? 'Gebruiker' }}</div>
                                </div>
                                <div>
                                    <div class="text-gray-600">{{ \Carbon\Carbon::parse($factuur->created_at)->format('d M Y') }}</div>
                                    <div class="text-gray-900">— Concept aangemaakt</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('facturen.index') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                        Terug naar factuur overzicht
                    </a>
                </div>
            </form>
        </div>
    </div>

    @livewireScripts

    <script>
        // Update totals dynamically
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('productsUpdated', (data) => {
                const subtotal = data[0]?.subtotal || 0;
                const btw = subtotal * 0.21;
                const total = subtotal + btw;

                document.getElementById('subtotal').textContent = '€' + subtotal.toFixed(2).replace('.', ',');
                document.getElementById('btw').textContent = '€' + btw.toFixed(2).replace('.', ',');
                document.getElementById('total').textContent = '€' + total.toFixed(2).replace('.', ',');
            });
        });
    </script>
</body>
</html>
