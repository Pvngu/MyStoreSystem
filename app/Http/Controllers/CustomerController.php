<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {
        return view('customers.index', [
            'customers' => Customer::filter(request(['search', 'country', 'status']))->paginate(20),
            'countries' => Country::all()
        ]);
    }
}
