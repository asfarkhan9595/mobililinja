<?php

namespace App\Http\Services;

use App\Models\Trunk;
use Illuminate\Support\Facades\Log;

class TrunkService
{
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
            ])->get();
        } catch (\Exception $e) {
            // Log any exceptions
            Log::error("Error fetching all trunks: {$e->getMessage()}");
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
            // Log any exceptions using Laravel's built-in Log facade
            Log::error("Trunk -Created Operation: {$e->getMessage()}");
            return false; // Return false on error
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
    public function create($request)
    {
        try {
            // Creating Trunk
            return Trunk::create([
                'tname' => $request->input('tname'),
                'description' => $request->input('description'),
                'secret' => $request->input('secret'),
                'authentication' => $request->input('authentication'),
                'registration' => $request->input('registration'),
                'sip_server' => $request->input('sip_server'),
                'sip_secret_port' => $request->input('sip_secret_port'),
                'context' => $request->input('context'),
                'transport' => $request->input('transport'),
                
            ]);
        } catch (\Exception $e) {
            // Log any exceptions using Laravel's built-in Log facade
            Log::error("Trunk -Created Operation: {$e->getMessage()}");
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
            $trunk->fill($request->all())->save();
            
            return true; // Return true on successful update
        } catch (\Exception $e) {
            // Log any exceptions using Laravel's built-in Log facade
            Log::error("Trunk - Update Operation: {$e->getMessage()}");
            return false; // Return false on error
        }
    
    }
    public function delete($trunk){
        try {
            return $trunk->delete();
        } catch (\Exception $e) {
            // Log any exceptions using Laravel's built-in Log facade
            Log::error("Trunk - Deleted Operation: {$e->getMessage()}");
            return false; // Return false on error
        }
    }
}
