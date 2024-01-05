<?php

namespace App\Http\Controllers\Superadmin\Trunk;

use App\DataTables\TrunkDataTable;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trunk\CreateTrunkRequest;
use App\Http\Requests\Trunk\UpdateTrunkRequest;
use App\Http\Services\TrunkService;

use Exception;
use App\Traits\Logger;
use App\Traits\Response;
use Illuminate\Support\Facades\DB;

class TrunkController extends Controller
{ 
    use Logger, Response;
    private $trunkService;

    public function __construct(TrunkService $trunkService){
        $this->trunkService = $trunkService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(TrunkDataTable $trunkDataTable)
    {
        try {
            return $trunkDataTable->render('_back.superadmin.trunk.index');
        } catch (Exception $e) {
            $this->log($e->getMessage(), auth()->id ?? '', 'Trunk - List/Select Operation', request()->ip(), $e);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTrunkRequest $request): \Illuminate\Http\JsonResponse
    {
        
        try {
            $createTrunk = DB::transaction(function () use ($request) {
                $createTrunk = $this->trunkService->create($request);
               return [
                   'createCustomer' => $createTrunk,
               ];
           });
           if ($createTrunk['createCustomer']){
               DB::commit();
               return$this->createResponse('success',__('trunk.created'));
           }
           DB::rollback();
           return $this->createResponse('error',__('trunk.creation.failed'));
       } catch (Exception $e) {
           DB::rollBack();
           $this->log($e->getMessage(), auth()->id ?? '', 'Trunk - Store Operation', request()->ip(), $e);
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
            $trunk = $this->trunkService->getTrunkById($id);
            if(!$trunk) {
                return $this->createResponse('error',__('trunk.not_found'));
            }
            return $this->createResponse('success',null, $trunk);
        }catch (Exception $e){
            $this->log($e->getMessage(), auth()->id ?? '', 'Trunk - Edit Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
        }
     }
     
     
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrunkRequest $request, string $id)
{
    
    try {
        $trunk = $this->trunkService->getTrunkById($id);
        if(!$trunk) {
            return $this->createResponse('error',__('customer.not_found'));
        }
        $updateTrunk = DB::transaction(function() use ($request, $trunk) {
            $updateTrunk = $this->trunkService->update($request, $trunk);
            return [
                'updateTrunk' => $updateTrunk,
            ];
        });
        if ($updateTrunk['updateTrunk']){
            DB::commit();
            return $this->createResponse('success',__('trunk.updated'));
        }
        DB::rollback();
        return $this->createResponse('error',__('trunk.update.failed'));
    } catch (Exception $e) {
        DB::rollBack();
        $this->log($e->getMessage(), auth()->id ?? '', 'Trunk - Update Operation', request()->ip(), $e);
        return $this->createResponse('error',__('something_went_wrong'));
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function  destroy(string $id): \Illuminate\Http\JsonResponse
    {
        try {
            $trunk = $this->trunkService->getTrunkById($id);
            if(!$trunk) {
                return $this->createResponse('error',__('trunk.not_found'));
            }
            $deleteTrunk = DB::transaction(function() use ($trunk) {
                $deleteTrunk = $this->trunkService->delete($trunk);
                return [
                    'deleteCustomer' => $deleteTrunk,
                ];
            });
            if ($deleteTrunk['deleteCustomer']){
                DB::commit();
                return $this->createResponse('success',__('trunk.deleted'));
            }
            DB::rollback();
            return $this->createResponse('error',__('trunk.delete.failed'));
        }catch (Exception $e){
            $this->log($e->getMessage(), auth()->id ?? '', 'Trunk - Delete Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
        }
    }
}
