<?php

namespace App\Http\Controllers\Superadmin\Customer;

use App\DataTables\CustomerDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Services\CustomerService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\Logger;

class CustomerController extends Controller
{
    use Logger;
    private $customerService;

    public function __construct(CustomerService $customerService){
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CustomerDataTable $customerDataTable)
    {
        try {
            return $customerDataTable->render('_back.superadmin.customers.index');
        }catch(Exception $e){
            $this->log($e->getMessage(), auth()->id ?? '', 'Customer - List/Select Operation', request()->ip(), $e);
        }
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
             $createCustomer = DB::transaction(function () use ($request) {
                $createCustomer = $this->customerService->create($request);
                return [
                    'createCustomer' => $createCustomer,
                ];
            });
            if ($createCustomer['createCustomer']){
                DB::commit();
                return redirect()->route('superadmin.customers.index')->with(['message'=>__('customer-created')]);
            }
            DB::rollback();
            return false;

        } catch (Exception $e) {
            DB::rollBack();
            $this->log($e->getMessage(), auth()->id ?? '', 'Customer - Store Operation', request()->ip(), $e);
            return redirect()->route('superadmin.customers.index');
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
        try {
            $customer = $this->customerService->getCustomerById($id);
            if(!$customer) {
                return response()->json([]);
            }
            return response()->json($customer);
        }catch (Exception $e){
            $this->log($e->getMessage(), auth()->id ?? '', 'Customer - Edit Operation', request()->ip(), $e);
            return false;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, string $id)
    {
        try {
            $updateCustomer = DB::transaction(function() use ($request, $id) {
                // $updateCustomer = $this->customerService->update($request, $id);
                $customer = $this->customerService->getCustomerById($id);
                if(!$customer) {
                    return false;
                }
                $updateCustomer = $this->customerService->update($request, $customer);
                return [
                    'updateCustomer' => $updateCustomer,
                ];
            });
            if ($updateCustomer['updateCustomer']){
                DB::commit();
                return redirect()->route('superadmin.customer.index')->with(['message'=>trans('messages.customer-created')]);
            }
            DB::rollback();
            return false;
        } catch (Exception $e) {
            DB::rollBack();
            $this->log($e->getMessage(), auth()->id ?? '', 'Customer - Update Operation', request()->ip(), $e);
            return redirect()->route('superadmin.customers.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $customer = $this->customerService->getCustomerById($id);
            if(!$customer) {
                return false;
            }
            return $this->customerService->delete($customer);
        }catch (Exception $e){
            $this->log($e->getMessage(), auth()->id ?? '', 'Customer - Delete Operation', request()->ip(), $e);
            return false;
        }
    }
}
