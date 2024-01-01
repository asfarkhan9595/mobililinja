<?php

namespace App\Http\Controllers\Superadmin\Customer;

use App\DataTables\CustomerDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Services\CustomerService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    private $customerService;

    public function __construct(CustomerService $customerService){
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CustomerDataTable $customerDataTable)
    {
        return $customerDataTable->render('_back.superadmin.customers.manage');
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
         try {
            DB::transaction(function () use ($request) {
                $createCustomer = $this->customerService->create($request);
                return [
                    'createCustomer' => $createCustomer,
                ];
                if ($createCustomer['createCustomer']){
                    DB::commit();
                    return redirect()->route('superadmin.customer.index')->with(['message'=>trans('messages.customer-created')]);
                }
                DB::rollback();
                return false;
            });
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
            return redirect()->route('superadmin.customer.index');
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
