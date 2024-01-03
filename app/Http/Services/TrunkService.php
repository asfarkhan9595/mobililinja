<?php

namespace App\Http\Services;

use App\Models\Trunk;
use App\Traits\Logger;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
class TrunkService
{
    use Logger;
    /**
     * Get all trunks.
     *
     * Date: 02 jan, 2024
     * Purpose: Retrieves all trunks with specified fields.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllTrunks()
    {
        try {
            // Fetch all the trunks
            return Trunk::select([
                'id',
                'tname',
                'description',
                'secret',
                'authentication',
                'registration',
                'sip_server',
                'sip_secret_port',
                'context',
                'transport',
                // Add other columns if needed
            ]);
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Trunk - List Operation', request()->ip(), $e);
            return collect(); // Return an empty collection on error
        }
    }


    public function  getTrunkById($id)
    {
        try {
            // Fetch all the customers
            $trunk = Trunk::find($id);
            if(!$trunk) {
                return false;
            }
            return $trunk;

        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Trunk - Fetch Single', request()->ip(), $e);
            return collect(); // Return an empty collection on error
        }
    }

    /**
     * Create a new trunk.
     *
     * Date: 02 jan, 2024
    
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\Trunk|false
     */
    public function create(Request $request): Trunk|bool
    {
        try {
            // Creating Trunk
            return Trunk::create([
                'tname' => $request->tname,
                'description' => $request->description,
                'secret' => $request->secret,
                'authentication' => $request->authentication,
                'registration' => $request->registration,
                'sip_server' => $request->sip_server,
                'sip_secret_port' => $request->sip_secret_port,
                'context' => $request->context,
                'transport' => $request->transport,
                
            ]);
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Trunk - Create Operation', request()->ip(), $e);
            return false; // Return false on error
        }
    }

    /**
     * Update a trunk.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Trunk $trunk
     * @return bool
     */
    public function update($request, $trunk)
    {
        try {
            return $trunk->update([
                'tname' => $request->tname,
                'description' => $request->description,
                'secret' => $request->secret,
                'authentication' => $request->authentication,
                'registration' => $request->registration,
                'sip_server' => $request->sip_server,
                'sip_secret_port' => $request->sip_secret_port,
                'context' => $request->context,
                'transport' => $request->transport,
            ]);

        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Trunk - Update Operation', request()->ip(), $e);
            return false; // Return false on error
        }
    
    }
    public function delete($trunk){
        try {
            return $trunk->delete();
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Trunk - Delete Operation', request()->ip(), $e);
            return false; // Return false on error
        }
    }
}
