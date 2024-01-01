<?php

namespace App\Http\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\Log;

class CustomerService
{
    protected $perPage;

    /**
     * CustomerService constructor.
     *
     * Date: 29th Dec, 2023
     * Developer: Kaushik
     * Purpose: Initializes the CustomerService instance.
     */


    /**
     * Get all customers.
     *
     * Date: 29th Dec, 2023
     * Developer: Kaushik
     * Purpose: Retrieves all customers with specified fields and paginates the results.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllCustomers()
    {
        try {
            // Fetch all the customers
            return Customer::select(['id','customer_number','name','country','city','zip','contact_person_name']);
        } catch (\Exception $e) {
            // Log any exceptions
            Log::error("Error fetching all customers: {$e->getMessage()}");
            return collect(); // Return an empty collection on error
        }
    }

    /**
     * Create a new customer.
     *
     * Date: 29th Dec, 2023
     * Developer: Kaushik
     * Purpose: Creates a new customer based on the provided request data.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\Customer|false
     */
    public function create($request)
    {
        try {
            // Creating Customer
            return Customer::create([
                'customer_number' => $request->input('customer_number'),
                'name' => $request->input('name'),
                'street_address' => $request->input('street_address'),
                'zip' => $request->input('zip'),
                'city' => $request->input('city'),
                'country' => $request->input('country'),
                'vat' => $request->input('vat'),
                'contact_person_name' => $request->input('contact_person_name'),
                'contact_person_email' => $request->input('contact_person_email'),
                'contact_person_phone' => $request->input('contact_person_phone'),
            ]);
        } catch (\Exception $e) {
            // Log any exceptions
            Log::error("Error creating customer: {$e->getMessage()}");
            return false; // Return false on error
        }
    }
}

