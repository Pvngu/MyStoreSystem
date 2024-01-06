<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {
        return view('customers.index', [
            'customers' => Customer::with('address.city')->filter(request(['search', 'country', 'status']))->paginate(20),
            'countries' => Country::all(),
            'cities' => City::all()
        ]);
    }

    public function create() {
        return view('customers.create', [
            'countries' => Country::all(),
            'cities' => City::all()
        ]);
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'nullable|email|unique:customers',
            'phone' => 'nullable|numeric'
        ]);

        $formFields['active'] = 1;

        Customer::create($formFields);

        return redirect('/customers')->with('message', 'Customer created successfully');
    }

    public function edit(Customer $customer) {
        return view('customers.edit',[
            'customer' => $customer
        ]);
    }

    public function update(Request $request, Customer $customer){
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'nullable',
            'phone' => 'nullable'
        ]);

        $customer->update($formFields);

        return redirect('/customers')->with('message', 'Customer updated successfuly');
    }

    public function destroy(Request $request) {
        $customer = Customer::find($request->customer_delete_id);
        if($customer){
            $customer->delete();
            return redirect('customers')->with('message', 'Customer deleted successfully');
        }
        return redirect('customers')->with('message', 'Customer was not found');
    }
}
