<?php

namespace App\Http\Services;

use App\Models\Customer;

class CustomerService
{ 
    public function getAllCustomers(){

    }

    public function createCustomer($request){
        return Customer::create([
            'customer_number' => $request->input('customer_number'),
            'company_name' => $request->input('company_name'),
            'street_address' => $request->input('street_address'),
            'zip' => $request->input('zip'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'vat' => $request->input('vat'),
            'contact_person_name' => $request->input('contact_person_name'),
            'contact_person_email' => $request->input('contact_person_email'),
            'contact_person_phone' => $request->input('contact_person_phone'),
        ]);
    }
}
