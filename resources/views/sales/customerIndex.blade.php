<p> Customers </p>

    @foreach ($customers as $customer)
        <div>
            <p> {{ $customer->name }} </p>
            <a> dem customer </a>
        </div>
    @endforeach
