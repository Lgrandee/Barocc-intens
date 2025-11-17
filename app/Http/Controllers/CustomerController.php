<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('sales.customerIndex')->with('customers',$customers);
    }

    public function create(){
        return view('sales.createCustomer');
   }

   public function store(Request $request)
    {
        $newCustomer = new Customer();
        $newCustomer->name_company = $request->name_company;
        $newCustomer->contact_person = $request->contact_person;
        $newCustomer->email = $request->email;
        $newCustomer->phone_number = $request->phone_number;
        $newCustomer->bkr_number = $request->bkr_number;
        $newCustomer->bkr_status = 'pending';
        $newCustomer->save();

        return redirect()->route('customers.index');
    }

}
