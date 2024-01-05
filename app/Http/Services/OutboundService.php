<?php

namespace App\Http\Services;

use App\Models\Outbound;
use App\Traits\Logger;
use Illuminate\Http\Request;

class OutboundService
{
    use Logger;

    /**
     * Get all outbounds.
     *
     * Date: 02 jan, 2024
     * Purpose: Retrieves all outbounds with specified fields.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllOutbounds()
    {
        try {
            // Fetch all the outbounds
            return Outbound::select([
                'id',
                'prepend',
                'prefix',
                'match_pattern',
                'trunk_id',
                // Add other columns if needed
            ]);
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Outbound - List Operation', request()->ip(), $e);
            return collect(); // Return an empty collection on error
        }
    }

    /**
     * Get outbound by ID.
     *
     * @param int $id
     * @return \App\Models\Outbound|false
     */
    public function getOutboundById($id)
    {
        try {
            // Fetch the outbound by ID
            $outbound = Outbound::find($id);
            if (!$outbound) {
                return false;
            }
            return $outbound;
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Outbound - Fetch Single', request()->ip(), $e);
            return false; // Return false on error
        }
    }

    /**
     * Create a new outbound.
     *
     * Date: 02 jan, 2024
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\Outbound|bool
     */
    public function create(Request $request)
    {
        try {
            // Creating Outbound
            return Outbound::create([
                'prepend' => $request->prepend,
                'prefix' => $request->prefix,
                'match_pattern' => $request->match_pattern,
                'trunk_id' => $request->trunk_id,
                // Add other fields as needed
            ]);
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Outbound - Create Operation', request()->ip(), $e);
            return false; // Return false on error
        }
    }

    /**
     * Update an outbound.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Outbound $outbound
     * @return bool
     */
    public function update($request, $outbound)
    {
        try {
            return $outbound->update([
                'prepend' => $request->prepend,
                'prefix' => $request->prefix,
                'match_pattern' => $request->match_pattern,
                'trunk_id' => $request->trunk_id,
                // Add other fields as needed
            ]);
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Outbound - Update Operation', request()->ip(), $e);
            return false; // Return false on error
        }
    }

    /**
     * Delete an outbound.
     *
     * @param \App\Models\Outbound $outbound
     * @return bool
     */
    public function delete($outbound)
    {
        try {
            return $outbound->delete();
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Outbound - Delete Operation', request()->ip(), $e);
            return false; // Return false on error
        }
    }
}
