<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factuur versturen</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <div class="bg-white border-b border-gray-200 px-6 py-4">
            <h1 class="text-2xl font-semibold text-gray-900">Factuur versturen</h1>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-8">
            <!-- Offerte Link -->
            @if($factuur->offerte)
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="text-blue-600 text-xl">🔗</div>
                        <div>
                            <div class="font-medium text-blue-900">Gekoppeld aan offerte</div>
                            <div class="text-sm text-blue-700">
                                Deze factuur is automatisch aangemaakt vanuit offerte
                                <a href="{{ route('offertes.show', $factuur->offerte->id) }}" class="underline hover:text-blue-800 font-medium">
                                    OFF-{{ date('Y', strtotime($factuur->offerte->created_at)) }}-{{ str_pad($factuur->offerte->id, 3, '0', STR_PAD_LEFT) }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column - Email Form -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Email Section -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Verstuur factuur naar klant</h2>

                        <form action="{{ route('facturen.send', $factuur->id) }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <!-- Email Address -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Aan (e-mail)</label>
                                    <input type="email" name="email" value="{{ $factuur->customer->email ?? '' }}" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                </div>

                                <!-- Subject -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Onderwerp</label>
                                    <input type="text" name="subject" value="Factuur {{ $factuur->factuurnr }} via" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                </div>

                                <!-- Message -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Bericht</label>
                                    <textarea name="message" rows="6" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 focus:border-transparent">Beste {{ $factuur->customer->name_company ?? 'klant' }},

Bijgevoegd ontvangt u factuur {{ $factuur->factuurnr }} met een totaalbedrag van €{{ number_format($factuur->total_amount * 1.21, 2, ',', '.') }}.

Graag ontvangen wij de betaling binnen {{ \Carbon\Carbon::parse($factuur->invoice_date)->diffInDays(\Carbon\Carbon::parse($factuur->due_date)) }} dagen (uiterlijk {{ \Carbon\Carbon::parse($factuur->due_date)->format('d-m-Y') }}) via {{ $factuur->payment_method === 'bank_transfer' ? 'bankoverschrijving' : ($factuur->payment_method === 'ideal' ? 'iDEAL' : $factuur->payment_method) }}.

Rekeningnummer: NL12 RABO 0123 4567 89
Onder vermelding van: {{ $factuur->factuurnr }}

Voor vragen kunt u contact opnemen via info@barrocintens.nl of 076-5877400.

Met vriendelijke groet,
Barroc Intens B.V.
</textarea>
                                </div>

                                <!-- Checkboxes -->
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="attach_pdf" value="1" checked class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-700">Bijlage: PDF</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="send_copy" value="1" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-700">Stuur kopie naar administratie</span>
                                    </label>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex gap-3 pt-4">
                                    <button type="submit" name="action" value="send"
                                        class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 font-medium">
                                        Verstuur & Log
                                    </button>
                                    <a href="{{ route('facturen.edit', $factuur->id) }}"
                                        class="px-6 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50 font-medium inline-block">
                                        Sla concept op
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Betaalstatus & Herinneringen -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Betaalstatus & Herinneringen</h3>

                        <div class="space-y-4">
                            <!-- Today's Date -->
                            <div class="p-3 bg-indigo-50 rounded border border-indigo-200">
                                <div class="text-xs text-indigo-600 mb-1">📅 Datum vandaag</div>
                                <div class="font-medium text-indigo-900">
                                    {{ now()->format('d-m-Y') }}
                                </div>
                            </div>

                            <!-- Current Status -->
                            <div class="p-3 bg-gray-50 rounded border border-gray-200">
                                <div class="text-xs text-gray-500 mb-1">Huidige status</div>
                                <div class="font-medium text-gray-900">
                                    @switch($factuur->status)
                                        @case('betaald')
                                            ✅ Betaald
                                            @break
                                        @case('verzonden')
                                            📧 Verzonden
                                            @break
                                        @case('verlopen')
                                            ⚠️ Verlopen
                                            @break
                                        @case('concept')
                                            📝 Concept
                                            @break
                                    @endswitch
                                </div>
                                @if($factuur->sent_at)
                                    <div class="text-xs text-gray-500 mt-1">
                                        Verstuurd op: {{ \Carbon\Carbon::parse($factuur->sent_at)->format('d-m-Y H:i') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Payment Deadline -->
                            <div class="p-3 {{ \Carbon\Carbon::parse($factuur->due_date)->isPast() && $factuur->status !== 'betaald' ? 'bg-red-50 border-red-200' : 'bg-blue-50 border-blue-200' }} rounded border">
                                <div class="text-xs text-gray-600 mb-1">Betaaltermijn</div>
                                <div class="font-medium {{ \Carbon\Carbon::parse($factuur->due_date)->isPast() && $factuur->status !== 'betaald' ? 'text-red-700' : 'text-blue-900' }}">
                                    {{ \Carbon\Carbon::parse($factuur->due_date)->format('d-m-Y') }}
                                    @if(\Carbon\Carbon::parse($factuur->due_date)->isPast() && $factuur->status !== 'betaald')
                                        ({{ \Carbon\Carbon::parse($factuur->due_date)->diffForHumans() }})
                                    @else
                                        ({{ \Carbon\Carbon::parse($factuur->due_date)->diffForHumans() }})
                                    @endif
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            @if($factuur->status === 'verzonden' || $factuur->status === 'verlopen')
                                <div class="space-y-2 pt-2 border-t">
                                    <button type="button" onclick="alert('Herinnering versturen functionaliteit komt binnenkort')"
                                        class="w-full px-4 py-2 text-sm border border-yellow-500 rounded text-yellow-700 hover:bg-yellow-50">
                                        📩 Verstuur betalingsherinnering
                                    </button>
                                    @if($factuur->status === 'verlopen')
                                        <button type="button" onclick="alert('Aanmaning versturen functionaliteit komt binnenkort')"
                                            class="w-full px-4 py-2 text-sm border border-red-500 rounded text-red-700 hover:bg-red-50">
                                            ⚠️ Verstuur aanmaning
                                        </button>
                                    @endif
                                    <button type="button" onclick="if(confirm('Markeer deze factuur als betaald?')) { alert('Betaald markeren functionaliteit komt binnenkort'); }"
                                        class="w-full px-4 py-2 text-sm border border-green-500 rounded text-green-700 hover:bg-green-50">
                                        ✅ Markeer als betaald
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column - PDF Preview -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow p-6 sticky top-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Bijlage</h2>

                        <div class="space-y-3">
                            <div class="text-sm">
                                <div class="font-medium text-gray-900">{{ $factuur->factuurnr }}.pdf</div>
                                <div class="text-gray-500">• 120 KB</div>
                            </div>

                            <div class="space-y-2">
                                <a href="{{ route('facturen.pdf', $factuur->id) }}" target="_blank"
                                    class="block text-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm font-medium">
                                    Verstuur & Log
                                </a>
                                <a href="{{ route('facturen.edit', $factuur->id) }}"
                                    class="block text-center px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50 text-sm font-medium">
                                    Sla concept op
                                </a>
                            </div>
                        </div>

                        <a href="{{ route('facturen.edit', $factuur->id) }}" class="block text-center text-indigo-600 hover:text-indigo-700 mt-6 text-sm font-medium">
                            Terug naar bewerken
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('facturen.index') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                    Terug naar factuur overzicht
                </a>
            </div>
        </div>
    </div>
</body>
</html>
