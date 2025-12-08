<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Factuur PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; line-height: 1.5; color: #333; }
        h1 { font-size: 22px; margin-bottom: 10px; color: #4F46E5; }
        h2 { font-size: 16px; margin-top: 20px; margin-bottom: 10px; border-bottom: 2px solid #4F46E5; padding-bottom: 4px; color: #4F46E5; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #4F46E5; color: white; font-weight: bold; }
        .info-row { margin-bottom: 5px; }
        .info-label { font-weight: bold; display: inline-block; width: 150px; }
        .header-section { background: #F3F4F6; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .payment-info { margin-top: 15px; background: #FEF3C7; padding: 12px; border-left: 4px solid #F59E0B; }
        .footer { margin-top: 30px; padding-top: 15px; border-top: 2px solid #4F46E5; text-align: center; font-size: 10px; color: #666; }
        .totals-box { background: #EEF2FF; padding: 15px; border-radius: 5px; margin-top: 15px; }
        .total-row { display: flex; justify-content: space-between; padding: 5px 0; }
        .total-label { font-weight: normal; }
        .total-value { font-weight: bold; text-align: right; }
        .grand-total { font-size: 16px; border-top: 2px solid #4F46E5; margin-top: 10px; padding-top: 10px; }
    </style>
</head>
<body>
    <h1>Factuur #FACT-{{ date('Y', strtotime($factuur->invoice_date)) }}-{{ str_pad($factuur->id, 3, '0', STR_PAD_LEFT) }}</h1>

    <div class="header-section">
        <div class="info-row">
            <span class="info-label">Klant:</span> {{ $factuur->customer->name_company ?? 'Onbekend' }}
        </div>
        <div class="info-row">
            <span class="info-label">Contactpersoon:</span> {{ $factuur->customer->contact_person ?? 'Onbekend' }}
        </div>
        <div class="info-row">
            <span class="info-label">E-mail:</span> {{ $factuur->customer->email ?? 'Onbekend' }}
        </div>
        <div class="info-row">
            <span class="info-label">Telefoon:</span> {{ $factuur->customer->phone_number ?? 'Onbekend' }}
        </div>
        <div class="info-row">
            <span class="info-label">Adres:</span> {{ $factuur->customer->address ?? 'Onbekend' }}, {{ $factuur->customer->zipcode ?? '' }} {{ $factuur->customer->city ?? '' }}
        </div>
        <div class="info-row">
            <span class="info-label">Factuurdatum:</span> {{ \Carbon\Carbon::parse($factuur->invoice_date)->format('d-m-Y') }}
        </div>
        <div class="info-row">
            <span class="info-label">Vervaldatum:</span> {{ \Carbon\Carbon::parse($factuur->due_date)->format('d-m-Y') }}
        </div>
        @if($factuur->reference)
            <div class="info-row">
                <span class="info-label">Referentie:</span> {{ $factuur->reference }}
            </div>
        @endif
        <div class="info-row">
            <span class="info-label">Betaalwijze:</span>
            @switch($factuur->payment_method)
                @case('bank_transfer')
                    Bankoverschrijving
                    @break
                @case('ideal')
                    iDEAL
                    @break
                @case('creditcard')
                    Creditcard
                    @break
                @case('cash')
                    Contant
                    @break
                @default
                    {{ ucfirst($factuur->payment_method) }}
            @endswitch
        </div>
        @if($factuur->status === 'betaald' && $factuur->paid_at)
            <div class="info-row">
                <span class="info-label">Betaald op:</span> {{ \Carbon\Carbon::parse($factuur->paid_at)->format('d-m-Y') }}
            </div>
        @endif
    </div>

    @if($factuur->description)
        <h2>Omschrijving</h2>
        <p style="margin-bottom: 15px; line-height: 1.6;">{{ $factuur->description }}</p>
    @endif

    <h2>Producten en Diensten</h2>
    <table>
        <thead>
            <tr>
                <th>Product/Dienst</th>
                <th style="text-align: center;">Aantal</th>
                <th style="text-align: right;">Prijs per stuk</th>
                <th style="text-align: right;">Totaal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $subtotal = 0;
            @endphp
            @foreach($factuur->products as $product)
                @php
                    $quantity = $product->pivot->quantity ?? 1;
                    $lineTotal = $product->price * $quantity;
                    $subtotal += $lineTotal;
                @endphp
                <tr>
                    <td>{{ $product->product_name }}</td>
                    <td style="text-align: center;">{{ $quantity }}</td>
                    <td style="text-align: right;">€{{ number_format($product->price, 2, ',', '.') }}</td>
                    <td style="text-align: right;">€{{ number_format($lineTotal, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @php
        $btw = $subtotal * 0.21;
        $total = $subtotal + $btw;
    @endphp

    <div class="totals-box">
        <table style="border: none; width: 50%; margin-left: auto;">
            <tr style="border: none;">
                <td style="border: none; padding: 5px;"><span class="total-label">Subtotaal:</span></td>
                <td style="border: none; padding: 5px; text-align: right;"><span class="total-value">€{{ number_format($subtotal, 2, ',', '.') }}</span></td>
            </tr>
            <tr style="border: none;">
                <td style="border: none; padding: 5px;"><span class="total-label">BTW (21%):</span></td>
                <td style="border: none; padding: 5px; text-align: right;"><span class="total-value">€{{ number_format($btw, 2, ',', '.') }}</span></td>
            </tr>
            <tr style="border: none;">
                <td style="border: none; padding: 10px 5px 5px 5px; border-top: 2px solid #4F46E5;"><span class="total-label" style="font-size: 14px; font-weight: bold;">Totaal:</span></td>
                <td style="border: none; padding: 10px 5px 5px 5px; border-top: 2px solid #4F46E5; text-align: right;"><span class="total-value" style="font-size: 14px;">€{{ number_format($total, 2, ',', '.') }}</span></td>
            </tr>
        </table>
    </div>

    <div class="payment-info">
        <strong>Betalingsinformatie:</strong><br>
        @php
            $paymentTermsDays = \Carbon\Carbon::parse($factuur->due_date)->diffInDays(\Carbon\Carbon::parse($factuur->invoice_date));
        @endphp
        Gelieve het totaalbedrag van <strong>€{{ number_format($total, 2, ',', '.') }}</strong> binnen <strong>{{ $paymentTermsDays }} dagen</strong> over te maken naar:<br>
        <br>
        <strong>Barroc Intens B.V.</strong><br>
        IBAN: NL12 RABO 0123 4567 89<br>
        BIC: RABONL2U<br>
        KvK: 12345678<br>
        BTW-nummer: NL123456789B01<br>
        <br>
        Onder vermelding van factuurnummer: <strong>FACT-{{ date('Y', strtotime($factuur->invoice_date)) }}-{{ str_pad($factuur->id, 3, '0', STR_PAD_LEFT) }}</strong>
    </div>

    <div class="footer">
        <strong>Barroc Intens B.V.</strong><br>
        Terheijdenseweg 350, 4826 AA Breda<br>
        Tel: 076-5877400 | E-mail: info@barrocintens.nl | Web: www.barrocintens.nl<br>
        KvK: 12345678 | BTW: NL123456789B01
    </div>
</body>
</html>
