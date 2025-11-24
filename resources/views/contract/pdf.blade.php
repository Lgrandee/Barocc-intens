<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Contract PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; line-height: 1.5; }
        h1 { font-size: 20px; margin-bottom: 10px; }
        h2 { font-size: 14px; margin-top: 20px; margin-bottom: 8px; border-bottom: 1px solid #ccc; padding-bottom: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 15px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background: #f3f3f3; font-weight: bold; }
        .info-row { margin-bottom: 5px; }
        .info-label { font-weight: bold; display: inline-block; width: 120px; }
        ul { margin: 5px 0; padding-left: 20px; }
        li { margin-bottom: 3px; }
        .terms { margin-top: 10px; background: #f9f9f9; padding: 10px; border-left: 3px solid #4F46E5; }
    </style>
</head>
<body>
    <h1>Contract #CON-{{ date('Y', strtotime($contract->start_date)) }}-{{ str_pad($contract->id, 3, '0', STR_PAD_LEFT) }}</h1>

    <div class="info-row">
        <span class="info-label">Customer:</span> {{ $contract->customer->name_company ?? 'Unknown' }}
    </div>
    <div class="info-row">
        <span class="info-label">Start date:</span> {{ \Carbon\Carbon::parse($contract->start_date)->format('d-m-Y') }}
    </div>
    <div class="info-row">
        <span class="info-label">End date:</span> {{ \Carbon\Carbon::parse($contract->end_date)->format('d-m-Y') }}
    </div>
    <div class="info-row">
        <span class="info-label">Status:</span> {{ ucfirst($contract->status) }}
    </div>

    <h2>Products</h2>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
        @foreach($contract->products as $product)
            <tr>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->pivot->quantity ?? 1 }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h2>Terms & Remarks</h2>
    <div class="terms">
        <p>This contract includes standard maintenance services, parts and annual inspection. Additional work will be charged separately.</p>
        <ul>
            <li>Delivery time/response: 48 hours</li>
            <li>Warranty: 2 years on performed work</li>
            <li>Payment: Annual invoice 30 days</li>
        </ul>
    </div>

    <h2>Payment & Service Planning</h2>
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Date</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Annual invoice {{ date('Y', strtotime($contract->start_date)) }}</td>
                <td>{{ \Carbon\Carbon::parse($contract->start_date)->format('d M Y') }}</td>
                <td>€{{ number_format($contract->products->sum('price') ?: ($contract->product->price ?? 1250), 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Interim service</td>
                <td>{{ \Carbon\Carbon::parse($contract->start_date)->addMonths(6)->format('d M Y') }}</td>
                <td>Included</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
