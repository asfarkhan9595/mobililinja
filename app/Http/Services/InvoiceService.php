<?php

namespace App\Http\Services;

use App\Models\Invoice;
use App\Traits\Logger;
use Illuminate\Http\Request;

class InvoiceService
{
    use Logger;


    public function getAllInvoices()
    {
        try {
            // Fetch all the customers
            return Invoice::select(['id','number','date','status','amount','payment_mode','customer_id']);
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Customer - List Operation', request()->ip(), $e);
            return collect(); // Return an empty collection on error
        }
    }

    public function  getInvoiceById($id)
    {
        try {
            // Fetch all the invoices
            $invoice = Invoice::find($id);
            if(!$invoice) {
                return false;
            }
            return $invoice;

        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Invoice - Fetch Single', request()->ip(), $e);
            return collect(); // Return an empty collection on error
        }
    }

    public function create(Request $request): Invoice|bool
    {
        try {
            // Creating Invoice
            return Invoice::create([
                'number' => $request->number,
                'date' => $request->date,
                'status' => $request->status,
                'amount' => $request->amount,
                'payment_mode' => $request->payment_mode,
                'customer_id' => $request->customer_id,
            ]);
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Invoice - Create Operation', request()->ip(), $e);
            return false; // Return false on error
        }
    }

    // Updating Invoice
    public function update($request, $invoice){
        try {
            return $invoice->update(
                [
                    'number' => $request->number,
                    'date' => $request->date,
                    'status' => $request->status,
                    'amount' => $request->amount,
                    'payment_mode' => $request->payment_mode,
                    'customer_id' => $request->customer_id,
                ]
            );
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Invoice - Update Operation', request()->ip(), $e);
            return false; // Return false on error
        }
    }

    // Deleting Invoice
    public function delete($invoice){
        try {
            return $invoice->delete();
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Invoice - Delete Operation', request()->ip(), $e);
            return false; // Return false on error
        }
    }

}
