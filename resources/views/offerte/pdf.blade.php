<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Offerte PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; line-height: 1.5; color: #333; }
        h1 { font-size: 22px; margin-bottom: 10px; color: #4F46E5; }
        h2 { font-size: 16px; margin-top: 20px; margin-bottom: 10px; border-bottom: 2px solid #4F46E5; padding-bottom: 4px; color: #4F46E5; }
        h3 { font-size: 14px; margin-top: 15px; margin-bottom: 8px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #4F46E5; color: white; font-weight: bold; }
        .info-row { margin-bottom: 5px; }
        .info-label { font-weight: bold; display: inline-block; width: 150px; }
        ul { margin: 5px 0; padding-left: 20px; }
        li { margin-bottom: 3px; }
        .header-section { background: #F3F4F6; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .terms { margin-top: 15px; background: #F9FAFB; padding: 12px; border-left: 4px solid #4F46E5; }
        .footer { margin-top: 30px; padding-top: 15px; border-top: 2px solid #4F46E5; text-align: center; font-size: 10px; color: #666; }
        .price-box { background: #EEF2FF; padding: 10px; border-radius: 5px; font-size: 14px; font-weight: bold; color: #4F46E5; }
    </style>
</head>
<body>
    <h1>Offerte #OFF-{{ date('Y', strtotime($offerte->created_at)) }}-{{ str_pad($offerte->id, 3, '0', STR_PAD_LEFT) }}</h1>

    <div class="header-section">
        <div class="info-row">
            <span class="info-label">Klant:</span> {{ $offerte->customer->name_company ?? 'Onbekend' }}
        </div>
        <div class="info-row">
            <span class="info-label">Contactpersoon:</span> {{ $offerte->customer->contact_person ?? 'Onbekend' }}
        </div>
        <div class="info-row">
            <span class="info-label">E-mail:</span> {{ $offerte->customer->email ?? 'Onbekend' }}
        </div>
        <div class="info-row">
            <span class="info-label">Telefoon:</span> {{ $offerte->customer->phone_number ?? 'Onbekend' }}
        </div>
        <div class="info-row">
            <span class="info-label">Adres:</span> {{ $offerte->customer->address ?? 'Onbekend' }}, {{ $offerte->customer->zipcode ?? '' }} {{ $offerte->customer->city ?? '' }}
        </div>
        <div class="info-row">
            <span class="info-label">Offerte datum:</span> {{ \Carbon\Carbon::parse($offerte->created_at)->format('d-m-Y') }}
        </div>
        <div class="info-row">
            <span class="info-label">Geldig tot:</span> {{ \Carbon\Carbon::parse($offerte->created_at)->addDays(30)->format('d-m-Y') }}
        </div>
        <div class="info-row">
            <span class="info-label">Status:</span> {{ ucfirst($offerte->status) }}
        </div>
    </div>

    <h2>Producten en Specificaties</h2>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th style="text-align: center;">Aantal</th>
                <th style="text-align: right;">Prijs per stuk</th>
                <th style="text-align: right;">Totaal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalExVat = 0;
            @endphp
            @foreach($offerte->products as $product)
                @php
                    $quantity = $product->pivot->quantity ?? 1;
                    $lineTotal = $product->price * $quantity;
                    $totalExVat += $lineTotal;
                @endphp
                <tr>
                    <td>{{ $product->product_name }}</td>
                    <td style="text-align: center;">{{ $quantity }}</td>
                    <td style="text-align: right;">€{{ number_format($product->price, 2, ',', '.') }}</td>
                    <td style="text-align: right;">€{{ number_format($lineTotal, 2, ',', '.') }}</td>
                </tr>
            @endforeach
            @php
                $vat = $totalExVat * 0.21;
                $totalIncVat = $totalExVat + $vat;
            @endphp
            <tr style="border-top: 2px solid #4F46E5;">
                <td colspan="3" style="text-align: right; font-weight: bold;">Subtotaal (excl. BTW)</td>
                <td style="text-align: right; font-weight: bold;">€{{ number_format($totalExVat, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right;">BTW (21%)</td>
                <td style="text-align: right;">€{{ number_format($vat, 2, ',', '.') }}</td>
            </tr>
            <tr style="background: #EEF2FF;">
                <td colspan="3" style="text-align: right; font-weight: bold; font-size: 13px;">Totaal (incl. BTW)</td>
                <td style="text-align: right; font-weight: bold; font-size: 13px; color: #4F46E5;">€{{ number_format($totalIncVat, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h2>Installatie en Voorwaarden</h2>
    <h3>Installatiekosten en voorwaarden</h3>
    <ul>
        <li>Professionele installatie door gecertificeerde technici</li>
        <li>Inclusief alle benodigde materialen en aansluitingen</li>
        <li>Pre-installatie inspectie op locatie</li>
        <li>Installatie binnen 2-4 weken na acceptatie</li>
    </ul>

    <h3>Garantieverplichtingen</h3>
    <ul>
        <li>2 jaar volledige fabrieksgarantie op alle onderdelen</li>
        <li>5 jaar garantie op de installatie</li>
        <li>24/7 storingsdienst beschikbaar</li>
        <li>Jaarlijkse onderhoudsbeurt inbegrepen (eerste 2 jaar)</li>
    </ul>

    <h3>Levertijd en Planning</h3>
    <ul>
        <li>Levertijd: 2-4 weken na acceptatie offerte</li>
        <li>Installatieduur: 1-2 werkdagen</li>
        <li>Planning wordt in overleg met u bepaald</li>
        <li>Installatie op werkdagen tussen 08:00 - 17:00 uur</li>
    </ul>

    <div class="terms">
        <h3 style="margin-top: 0;">Algemene Voorwaarden</h3>
        <p><strong>Betalingsvoorwaarden:</strong> 30 dagen netto na factuurdatum. Bij opdrachten boven €10.000 wordt een aanbetaling van 30% gevraagd.</p>

        <p><strong>Offerte geldigheid:</strong> Deze offerte is 30 dagen geldig vanaf de offertedatum. Na deze periode behouden wij ons het recht voor om prijzen en voorwaarden aan te passen.</p>

        <p><strong>Annulering:</strong> Annulering tot 7 dagen voor geplande installatie is kosteloos. Bij latere annulering worden administratiekosten in rekening gebracht.</p>

        <p><strong>Wijzigingen:</strong> Eventuele wijzigingen in de opdracht kunnen leiden tot aanpassing van de prijs en levertijd.</p>
    </div>

    <h2>Contact</h2>
    <p><strong>Lisa Bakker</strong><br>
    Sales Advisor<br>
    Tel: +31 (0)6 12345678<br>
    E-mail: l.bakker@barroc.nl</p>

    <div class="footer">
        <p>Barroc Intens - Koffiestraat 123, 1234 AB Amsterdam - info@barroc.nl - www.barroc.nl</p>
        <p>KvK: 12345678 - BTW: NL123456789B01</p>
    </div>
</body>
</html>
