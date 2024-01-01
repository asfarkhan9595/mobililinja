<?php

namespace App\Http\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\Log;

class CustomerService
{
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

    public function  getCustomerById($id)
    {
        try {
            // Fetch all the customers
            return Customer::whereId($id)->first();
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
                'customer_number' => $request->customer_number,
                'name' => $request->name,
                'street_address' => $request->street_address,
                'zip' => $request->zip,
                'city' => $request->city,
                'country' => $request->country,
                'vat' => $request->vat,
                'contact_person_name' => $request->contact_person_name,
                'contact_person_email' => $request->contact_person_email,
                'contact_person_phone' => $request->contact_person_phone,
            ]);
        } catch (\Exception $e) {
            // Log any exceptions
            Log::error("Error creating customer: {$e->getMessage()}");
            return false; // Return false on error
        }
    }
    public function update($request, $id){
        try {
            // Updating Customer
            $customer = Customer::find($id);
            return $customer->update(
                [
                    'customer_number' => $request->customer_number,
                    'name' => $request->name,
                    'street_address' => $request->street_address,
                    'zip' => $request->zip,
                    'city' => $request->city,
                    'country' => $request->country,
                    'vat' => $request->vat,
                    'contact_person_name' => $request->contact_person_name,
                    'contact_person_email' => $request->contact_person_email,
                    'contact_person_phone' => $request->contact_person_phone,
                ]
            );
        } catch (\Exception $e) {
            // Log any exceptions
            Log::error("Error updating customer: {$e->getMessage()}");
            return false; // Return false on error
        }
    }

    public function delete($id){
        try {
            // Updating Customer
            $customer = Customer::find($id);
            if ($customer) {
                $customer->delete();
                return true;
            }
            return false;
        } catch (\Exception $e) {
            // Log any exceptions
            Log::error("Error deleting customer: {$e->getMessage()}");
            return false; // Return false on error
        }
    }
}

