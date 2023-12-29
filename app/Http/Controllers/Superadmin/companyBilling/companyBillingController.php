<?php

namespace App\Http\Controllers\Superadmin\companyBilling;

use App\Http\Controllers\Controller;
use App\Http\companyBilling\Services\companyBillingService;
use Illuminate\Http\Request;

class companyBillingController extends Controller
{ 
    private $companyBillingService;

    public function __construct(companyBillingService $companyBillingService){
        $this->companyBillingService = $companyBillingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
  
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
    public function store(Request $request)
    {
        
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
