<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Models\Customer;
use App\Models\CompanyFeatures;
use App\Models\CompanyBilling;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('_back.superadmin.customers.manage');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCustomerRequest $request)
    {
        $company = Customer::create([
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

        // Create Features for the Company
        $company->features()->create([
            'pbx' => $request->input('pbx'),
            'extensions' => $request->input('extensions'),
            'ivr' => $request->input('ivr'),
            'voicemail' => $request->input('voicemail'),
            'ring_groups' => $request->input('ring_groups'),
            'conferences' => $request->input('conferences'),
            'call_recording' => $request->input('call_recording'),
            'callback' => $request->input('callback'),
            'calendar' => $request->input('calendar'),
            'reports' => $request->input('reports'),
            'dashboard' => $request->input('dashboard'),
            'speech_to_text' => $request->input('speech_to_text'),
            'ai' => $request->input('ai'),
        ]);

        // Create Billing for the Company
        $company->billing()->create([
            'billing_full_name' => $request->input('billing_full_name'),
            'billing_card_number' => $request->input('billing_card_number'),
            'billing_expiration_month' => $request->input('billing_expiration_month'),
            'billing_expiration_year' => $request->input('billing_expiration_year'),
            'billing_cvv' => $request->input('billing_cvv'),
        ]);

        return redirect()->route('superadmin.customers.manage')->with(['message' => 'Company, Features, and Billing information stored successfully'], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
