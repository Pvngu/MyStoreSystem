<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use App\Models\Address;
use App\Models\Country;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index() {
        return view('customers.index', [
            'customers' => Customer::with('address.city')->filter(request(['search', 'country', 'status']))->paginate(20)->withQueryString(),
            'countries' => Country::all(),
            'cities' => City::all()
        ]);
    }

    public function create() {
        return view('customers.create', [
            'countries' => $this->getCountries(),
            'states' => State::all(),
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

        if($request->filled('address') || $request->filled('address2') || $request->filled('city_id') || $request->filled('postal_code')) {
            $formFieldsAddress = $request->validate([
                'address' => 'required',
                'address2' => 'nullable',
                'postal_code' => 'required',
                'city_id' => 'required'
            ]);
    
            $address = Address::create($formFieldsAddress);
    
            $formFields['address_id'] = $address->id;
        }

        Customer::create($formFields);

        return redirect('/customers')->with('message', 'Customer created successfully');
    }

    public function edit(Customer $customer) {
        $address = Address::find($customer->address_id);
        return view('customers.edit',[
            'customer' => $customer,
            'countries' => $this->getCountries(),
            'states' => State::all(),
            'cities' => City::all(),
        ]);
    }

    public function update(Request $request, Customer $customer){
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'nullable',
            'phone' => 'nullable'
        ]);

        if($request->filled('address') || $request->filled('address2') || $request->filled('city_id') || $request->filled('postal_code')) {
            $formFieldsAddress = $request->validate([
                'address' => 'required',
                'address2' => 'nullable',
                'postal_code' => 'required',
                'city_id' => 'required'
            ]);

            if($customer->address) {
                $address = $customer->address;
                $address->update($formFieldsAddress);
            }
            else {
                $address = Address::create($formFieldsAddress);
                $formFields['address_id'] = $address->id;
            }
        }

        $customer->update($formFields);

        return redirect('/customers')->with('message', 'Customer updated successfuly');
    }

    public function destroy(Request $request) {
        $customer = Customer::find($request->row_delete_id);
        if($customer){
            $customer->delete();
            return redirect('customers')->with('message', 'Customer deleted successfully');
        }
        return redirect('customers')->with('message', 'Customer was not found');
    }

    public function getCountries () {
        $countries = DB::table('countries')->get();
        return $countries;
    }

    public function getStates(Request $request) {
        $states = DB::table('states')->where('country_id', $request->country_id)->get();

        if(count($states) > 0) {
            return response()->json($states);
        }
    }

    public function getCities(Request $request) {
        $cities = DB::table('cities')->where('state_id', $request->state_id)->get();

        if(count($cities) > 0) {
            return response()->json($cities);
        }
    }
}
