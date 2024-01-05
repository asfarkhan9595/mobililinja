<?php

namespace App\Http\Controllers\Superadmin\Firewall;

use App\DataTables\FirewallNetworkDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Firewall\CreateFirewallRequest;
use App\Http\Requests\Firewall\UpdateFirewallRequest;
use App\Http\Services\CustomerService;
use App\Http\Services\FirewallService;
use App\Traits\Logger;
use App\Traits\Response;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class FirewallController extends Controller
{
    use Logger, Response;
    private $firewallService;

    public function __construct(FirewallService $firewallService){
        $this->firewallService = $firewallService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(FirewallNetworkDataTable $firewallDataTable)
    {
        try {
            $customerService = new CustomerService();
            $customers = $customerService->getAllCustomers()->pluck('name','id');
            return $firewallDataTable->render('_back.superadmin.firewalls.index',compact('customers'));
        }catch(Exception $e){
            $this->log($e->getMessage(), auth()->id ?? '', 'Firewall - List/Select Operation', request()->ip(), $e);
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
    public function store(CreateFirewallRequest $request)
    {
        try {
            $createFirewall = DB::transaction(function () use ($request) {
               $createFirewall = $this->firewallService->create($request);
               return [
                   'createFirewall' => $createFirewall,
               ];
           });
           if ($createFirewall['createFirewall']){
               DB::commit();
               return$this->createResponse('success',__('firewall.created'));
           }
           DB::rollback();
           return $this->createResponse('error',__('firewall.creation.failed'));
       } catch (Exception $e) {
           DB::rollBack();
           $this->log($e->getMessage(), auth()->id ?? '', 'Firewall - Store Operation', request()->ip(), $e);
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
            $firewall = $this->firewallService->getFirewallById($id);
            if(!$firewall) {
                return $this->createResponse('error',__('firewall.not_found'));
            }
            return $this->createResponse('success',null,$firewall);
        }catch (Exception $e){
            $this->log($e->getMessage(), auth()->id ?? '', 'Firewall - Edit Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFirewallRequest $request, string $id)
    {
        try{
            $firewall = $this->firewallService->getFirewallById($id);
            if(!$firewall) {
                return $this->createResponse('error',__('firewall.not_found'));
            }
            $updateFirewall = DB::transaction(function() use ($request, $firewall) {
                $updateFirewall = $this->firewallService->update($request, $firewall);
                return [
                    'updateFirewall' => $updateFirewall,
                ];
            });
            if ($updateFirewall['updateFirewall']){
                DB::commit();
                return $this->createResponse('success',__('firewall.updated'));
            }
            DB::rollback();
            return $this->createResponse('error',__('firewall.update.failed'));
        } catch (Exception $e) {
            DB::rollBack();
            $this->log($e->getMessage(), auth()->id ?? '', 'Firewall - Update Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $firewall = $this->firewallService->getFirewallById($id);
            if(!$firewall) {
                return $this->createResponse('error',__('firewall.not_found'));
            }
            $deleteFirewall = DB::transaction(function() use ($firewall) {
                $deleteFirewall = $this->firewallService->delete($firewall);
                return [
                    'deleteFirewall' => $deleteFirewall,
                ];
            });
            if ($deleteFirewall['deleteFirewall']){
                DB::commit();
                return $this->createResponse('success',__('firewall.deleted'));
            }
            DB::rollback();
            return $this->createResponse('error',__('firewall.delete.failed'));
        }catch (Exception $e){
            $this->log($e->getMessage(), auth()->id ?? '', 'Firewall - Delete Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
        }
    }
}
