<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factuur aanmaken</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <div class="bg-white border-b border-gray-200 px-6 py-4">
            <h1 class="text-2xl font-semibold text-gray-900">Factuur aanmaken</h1>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-8">
            <form action="{{ route('facturen.store') }}" method="POST" id="factuurForm">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Left Column - Main Form -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Nieuwe factuur section -->
                        <div class="bg-white rounded-lg shadow p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Nieuwe factuur</h2>

                            <div class="space-y-4">
                                <!-- Customer Search -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kies klant of zoek...</label>
                                    @livewire('customer-search', ['name' => 'name_company_id', 'required' => true])
                                </div>

                                <!-- Factuurnr and Invoice Date -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Factuurnr (auto)</label>
                                        <input type="text" value="Wordt automatisch gegenereerd" disabled
                                            class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50 text-gray-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Factuurdatum</label>
                                        <input type="date" name="invoice_date" value="{{ date('Y-m-d') }}" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    </div>
                                </div>

                                <!-- Reference and Payment Terms -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Referentie (optioneel)</label>
                                        <input type="text" name="reference" placeholder="Contract-nr, Offerte-nr, of Project-nr"
                                            class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                        <p class="text-xs text-gray-500 mt-1">Bijv: CONTRACT-2025-001 of OFF-2025-005</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Betalingstermijn</label>
                                        <select name="payment_terms_days" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                            <option value="30">30 dagen</option>
                                            <option value="14">14 dagen</option>
                                            <option value="7">7 dagen</option>
                                            <option value="0">Direct betaalbaar</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Payment Method -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Betaalwijze</label>
                                    <select name="payment_method" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                        <option value="bank_transfer">Bankoverschrijving</option>
                                        <option value="ideal">iDEAL</option>
                                        <option value="creditcard">Creditcard</option>
                                        <option value="cash">Contant</option>
                                    </select>
                                </div>

                                <!-- Products Table -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Producten</label>
                                    @livewire('product-multi-select', ['name' => 'products'])
                                </div>

                                <!-- Description for Invoice -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Omschrijving</label>
                                    <textarea name="description" rows="2" placeholder="Korte omschrijving van de factuur (verschijnt op de factuur)"
                                        class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('description') }}</textarea>
                                </div>

                                <!-- Internal Notes -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Interne notities (optioneel)</label>
                                    <textarea name="notes" rows="3" placeholder="Notities voor intern gebruik, niet zichtbaar voor klant"
                                        class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('notes') }}</textarea>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex gap-3 pt-4">
                                    <button type="submit" name="status" value="concept"
                                        class="px-6 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50 font-medium">
                                        💾 Opslaan als concept
                                    </button>
                                    <button type="submit" name="status" value="verzonden"
                                        class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 font-medium">
                                        ✉️ Maak aan en verstuur
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Preview & Total -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow p-6 sticky top-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Voorbeeld & Totaal</h2>

                            <div class="space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Subtotaal</span>
                                    <span class="font-medium" id="subtotal">€0,00</span>
                                </div>

                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">BTW (21%)</span>
                                    <span class="font-medium" id="btw">€0,00</span>
                                </div>

                                <div class="border-t pt-3 flex justify-between">
                                    <span class="font-semibold text-gray-900">Totaal</span>
                                    <span class="font-semibold text-gray-900 text-lg" id="total">€0,00</span>
                                </div>
                            </div>

                            <div class="mt-6 p-3 bg-blue-50 border border-blue-200 rounded text-xs text-blue-800">
                                <strong>💡 Tip:</strong> Selecteer "Maak aan en verstuur" om direct naar de verzendpagina te gaan, of kies "Opslaan als concept" om later te verzenden.
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
