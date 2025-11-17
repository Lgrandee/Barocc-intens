<p> Customers </p>

    @foreach ($customers as $customer)
        <div>
            <p> {{ $customer->name_company }} </p>
            <a> dem customer </a>
        </div>
    @endforeach
