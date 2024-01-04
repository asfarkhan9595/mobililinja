<?php

namespace App\Http\Controllers\Superadmin\Customer;

use App\DataTables\CustomerDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Services\CustomerService;
use App\Traits\Response;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\Logger;

class CustomerController extends Controller
{
    use Logger, Response;
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
    public function store(CreateCustomerRequest $request): \Illuminate\Http\JsonResponse
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
                return$this->createResponse('success',__('customer.created'));
            }
            DB::rollback();
            return $this->createResponse('error',__('customer.creation.failed'));
        } catch (Exception $e) {
            DB::rollBack();
            $this->log($e->getMessage(), auth()->id ?? '', 'Customer - Store Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
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
                return $this->createResponse('error',__('customer.not_found'));
            }
            return $this->createResponse('success',null,['data'=> $customer]);
        }catch (Exception $e){
            $this->log($e->getMessage(), auth()->id ?? '', 'Customer - Edit Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, string $id): \Illuminate\Http\JsonResponse
    {
        try {
            $customer = $this->customerService->getCustomerById($id);
            if(!$customer) {
                return $this->createResponse('error',__('customer.not_found'));
            }
            $updateCustomer = DB::transaction(function() use ($request, $customer) {
                $updateCustomer = $this->customerService->update($request, $customer);
                return [
                    'updateCustomer' => $updateCustomer,
                ];
            });
            if ($updateCustomer['updateCustomer']){
                DB::commit();
                return $this->createResponse('success',__('customer.updated'));
            }
            DB::rollback();
            return $this->createResponse('error',__('customer.update.failed'));
        } catch (Exception $e) {
            DB::rollBack();
            $this->log($e->getMessage(), auth()->id ?? '', 'Customer - Update Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        try {
            $customer = $this->customerService->getCustomerById($id);
            if(!$customer) {
                return $this->createResponse('error',__('customer.not_found'));
            }
            $deleteCustomer = DB::transaction(function() use ($customer) {
                $deleteCustomer = $this->customerService->delete($customer);
                return [
                    'deleteCustomer' => $deleteCustomer,
                ];
            });
            if ($deleteCustomer['deleteCustomer']){
                DB::commit();
                return $this->createResponse('success',__('customer.deleted'));
            }
            DB::rollback();
            return $this->createResponse('error',__('customer.delete.failed'));
        }catch (Exception $e){
            $this->log($e->getMessage(), auth()->id ?? '', 'Customer - Delete Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
        }
    }
}
