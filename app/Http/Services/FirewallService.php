<?php

namespace App\Http\Services;

use App\Models\Firewall;
use App\Models\FirewallNetwork;
use Illuminate\Http\Request;
use App\Traits\Logger;

class FirewallService
{

    use Logger;

    public function getAllNetworks()
    {
        try {
            // Fetch all the customers
            return FirewallNetwork::select(['id','network_host','assigned_zone','customer_id','description','accepted_date']);
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Firewall Network - List Operation', request()->ip(), $e);
            return collect(); // Return an empty collection on error
        }
    }

    public function getFirewallById($id)
    {
        try {
            // Fetch all the firewall - networks
            $firewall = FirewallNetwork::find($id);
            if(!$firewall) {
                return false;
            }
            return $firewall;

        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Firewall - Fetch Single', request()->ip(), $e);
            return collect(); // Return an empty collection on error
        }
    }

    public function create(Request $request)
    {
        try {
            return FirewallNetwork::create([
                "network_host" => $request->network_host,
                "assigned_zone" => $request->assigned_zone,
                "customer_id" => $request->customer,
                "description" => $request->description
            ]);
            } catch (\Exception $e) {
                // Log any exceptions
                $this->log($e->getMessage(), auth()->id ?? '', 'Firewall - Create Operation', request()->ip(), $e);
                return false; // Return false on error
            }
    }


    // Updating Customer
    public function update($request, $firewall){
        try {
            return $firewall->update(
                [
                    "network_host" => $request->network_host,
                    "assigned_zone" => $request->assigned_zone,
                    "customer_id" => $request->customer,
                    "description" => $request->description
                ]
            );
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Firewall - Update Operation', request()->ip(), $e);
            return false; // Return false on error
        }
    }

    // Deleting Customer
    public function delete($firewall){
        try {
            return $firewall->delete();
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'Firewall - Delete Operation', request()->ip(), $e);
            return false; // Return false on error
        }
    }

}
