<?php

namespace App\Http\Services;

use App\Models\Customer;
use App\Traits\Logger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerService
{
    use Logger;
    /**
     * Get all customers.
     *
     * Date: 29th Dec, 2023
     * Developer: Kaushik
     * Purpose: Retrieves all customers with specified fields and paginates the results.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllCustomers()
    {
        try {
            // Fetch all the customers
            return Customer::select(['id','customer_number','name','country','city','zip','contact_person_name']);
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Customer - List Operation', request()->ip(), $e);
            return collect(); // Return an empty collection on error
        }
    }

    public function getCustomerArray(){
        try {
            // Fetch all the customers
            return Customer::pluck('name','id')->toArray();
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Customer - List Operation', request()->ip(), $e);
            return collect(); // Return an empty collection on error
        }
    }

    public function  getCustomerById($id)
    {
        try {
            // Fetch all the customers
            $customer = Customer::find($id);
            if(!$customer) {
                return false;
            }
            return $customer;

        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Customer - Fetch Single', request()->ip(), $e);
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
    public function create(Request $request): Customer|bool
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
            $this->log($e->getMessage(), auth()->id ?? '', 'Customer - Create Operation', request()->ip(), $e);
            return false; // Return false on error
        }
    }

    // Updating Customer
    public function update($request, $customer){
        try {
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
            $this->log($e->getMessage(), auth()->id ?? '', 'Customer - Update Operation', request()->ip(), $e);
            return false; // Return false on error
        }
    }

    // Deleting Customer
    public function delete($customer){
        try {
            return $customer->delete();
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Customer - Delete Operation', request()->ip(), $e);
            return false; // Return false on error
        }
    }
}

