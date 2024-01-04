<?php

namespace App\Http\Services;

use App\Models\PSTN;
use App\Traits\Logger;
use Illuminate\Support\Facades\Log;

class PSTNService
{
    use Logger;
    protected $perPage;

    public function getAllPSTN()
    {
        try {
            // Fetch all the customers
            return PSTN::select(['id','provider','number_pool','customer_id']);
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'PSTN - List Operation', request()->ip(), $e);
            return collect(); // Return an empty collection on error
        }
    }

    public function getPSTNById($id)
    {
        try {
            // Fetch all the customers
            $customer = PSTN::find($id);
            if(!$customer) {
                return false;
            }
            return $customer;

        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'PSTN - Fetch Single', request()->ip(), $e);
            return collect(); // Return an empty collection on error
        }
    }

    public function create($request)
    {
        try {
            // Creating Customer
            return PSTN::create([
                'provider' => $request->provider,
                'number_pool' => $request->number_pool,
                'customer_id' => $request->customer_id,
            ]);
        } catch (\Exception $e) {
            // Log any exceptions
            // $this->log($e->getMessage(), auth()->id ?? '', 'Customer - Create Operation', request()->ip(), $e);
            return false; // Return false on error
        }
    }

    public function delete($pstn){
        try {
            return $pstn->delete();
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'PSTN - Delete Operation', request()->ip(), $e);
            return false; // Return false on error
        }
    }

    public function update($request, $customer)
    {
        try {
            return $customer->update(
                [
                    'provider' => $request->provider,
                    'number_pool' => $request->number_pool,
                    'customer_id' => $request->customer_id
                ]
            );
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'PSTN - Update Operation', request()->ip(), $e);
            return false; // Return false on error
        }
    }
}
