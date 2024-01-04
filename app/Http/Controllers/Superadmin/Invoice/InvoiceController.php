<?php

namespace App\Http\Controllers\Superadmin\Invoice;

use App\DataTables\InvoiceDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Invoice\CreateInvoiceRequest;
use App\Http\Requests\Invoice\UpdateInvoiceRequest;
use App\Http\Services\CustomerService;
use App\Http\Services\InvoiceService;
use App\Traits\Logger;
use App\Traits\Response;
use Exception;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    use Logger, Response;

    private $invoiceService;

    public function __construct(InvoiceService $invoiceService){
        $this->invoiceService = $invoiceService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(InvoiceDataTable $invoiceDataTable)
    {
        try {
            $customerService = new CustomerService;
            $customers = $customerService->getAllCustomers()->pluck('name','id')->toArray();
            return $invoiceDataTable->render('_back.superadmin.invoices.index',compact('customers'));
        }catch(Exception $e){
            $this->log($e->getMessage(), auth()->id ?? '', 'Invoice - List/Select Operation', request()->ip(), $e);
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
    public function store(CreateInvoiceRequest $request): \Illuminate\Http\JsonResponse
    {
         try {
             $createInvoice = DB::transaction(function () use ($request) {
                $createInvoice = $this->invoiceService->create($request);
                return [
                    'createInvoice' => $createInvoice,
                ];
            });
            if ($createInvoice['createInvoice']){
                DB::commit();
                return$this->createResponse('success',__('invoice.created'));
            }
            DB::rollback();
            return $this->createResponse('error',__('invoice.creation.failed'));
        } catch (Exception $e) {
            DB::rollBack();
            $this->log($e->getMessage(), auth()->id ?? '', 'Invoice - Store Operation', request()->ip(), $e);
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
            $invoice = $this->invoiceService->getInvoiceById($id);
            if(!$invoice) {
                return $this->createResponse('error',__('invoice.not_found'));
            }
            return $this->createResponse('success',null,$invoice);
        }catch (Exception $e){
            $this->log($e->getMessage(), auth()->id ?? '', 'Invoice - Edit Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, string $id): \Illuminate\Http\JsonResponse
    {
        try {
            $invoice = $this->invoiceService->getInvoiceById($id);
            if(!$invoice) {
                return $this->createResponse('error',__('invoice.not_found'));
            }
            $updateInvoice = DB::transaction(function() use ($request, $invoice) {
                $updateInvoice = $this->invoiceService->update($request, $invoice);
                return [
                    'updateInvoice' => $updateInvoice,
                ];
            });
            if ($updateInvoice['updateInvoice']){
                DB::commit();
                return $this->createResponse('success',__('invoice.updated'));
            }
            DB::rollback();
            return $this->createResponse('error',__('invoice.update.failed'));
        } catch (Exception $e) {
            DB::rollBack();
            $this->log($e->getMessage(), auth()->id ?? '', 'Invoice - Update Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        try {
            $invoice = $this->invoiceService->getInvoiceById($id);
            if(!$invoice) {
                return $this->createResponse('error',__('invoice.not_found'));
            }
            $deleteInvoice = DB::transaction(function() use ($invoice) {
                $deleteInvoice = $this->invoiceService->delete($invoice);
                return [
                    'deleteInvoice' => $deleteInvoice,
                ];
            });
            if ($deleteInvoice['deleteInvoice']){
                DB::commit();
                return $this->createResponse('success',__('invoice.deleted'));
            }
            DB::rollback();
            return $this->createResponse('error',__('invoice.delete.failed'));
        }catch (Exception $e){
            $this->log($e->getMessage(), auth()->id ?? '', 'Invoice - Delete Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
        }
    }
}
