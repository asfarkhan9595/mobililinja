<?php

namespace App\Http\Controllers\Superadmin\Customer;

use App\Http\Controllers\Controller;
use App\Http\Services\CustomerService;
use App\Http\Services\companyFeatureService;
use App\Http\Services\companyBillingService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{ 
    private $customerService;
    private $companyFeatureService;
    private $companyBillingService;


    public function __construct(CustomerService $customerService){
        $this->customerService = $customerService;
        $this->companyFeatureService = new companyBillingService;
        $this->companyBillingService = new companyBillingService;
    }

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
        $this->beginTransaction();

        try {
       
            $customer = $this->customerService->createCustomer($request);
            $feature = $this->companyFeatureService->createCompanyFeature($request);
            $feature = $this->companyBillingService->createCompanyBilling($request);
       
            $this->commit();
        }

        catch (Exception $e) {
            $this->rollBack();
            throw $e;
        }
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
