<?php

namespace App\Http\Controllers\Superadmin\Outbound;

use App\DataTables\OutboundDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Outbound\CreateOutboundRequest;

use App\Http\Requests\Outbound\UpdateOutboundRequest;
use App\Http\Services\OutboundService;

use App\Http\Services\TrunkService;
use App\Traits\Logger;
use App\Traits\Response;
use Exception;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\DB;

class OutboundController extends Controller
{ 
    use Logger, Response;
    private $outboundService;

    public function __construct(OutboundService $outboundService){
        $this->outboundService = $outboundService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(OutboundDataTable $outboundDataTable)
    {
        $trunkService = new TrunkService();
        $trunks = $trunkService->getAllTrunks()->pluck('tname', 'id')->toArray();
        return $outboundDataTable->render('_back.superadmin.outbounds.index', compact('trunks'));
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
    public function store(CreateOutboundRequest $request):JsonResponse
    {
        try {
            $createOutbound = DB::transaction(function () use ($request) {
                $createOutbound = $this->outboundService->create($request);
                return [
                    'createOutbound' => $createOutbound,
                ];
            });
    
            if ($createOutbound['createOutbound']) {
                DB::commit();
                return $this->createResponse('success', __('outbound.created'));
            }
    
            DB::rollback();
            return $this->createResponse('error', __('outbound.creation.failed'));
        } catch (Exception $e) {
            DB::rollBack();
            $this->log($e->getMessage(), auth()->id ?? '', 'Outbound - Store Operation', request()->ip(), $e);
            return $this->createResponse('error', __('something_went_wrong'));
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
    public function edit(string $id): \Illuminate\Http\JsonResponse
    {
        try {
            $outbound = $this->outboundService->getOutboundById($id);
            if(!$outbound) {
                return $this->createResponse('error',__('outbound.not_found'));
            }
            return $this->createResponse('success',null,$outbound);
        }catch (\Exception $e){
            $this->log($e->getMessage(), auth()->id ?? '', 'Outbound - Edit Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOutboundRequest $request, string $id)
    {
        try{
            $outbound = $this->outboundService->getOutboundById($id);
            if(!$outbound) {
                return $this->createResponse('error',__('outbound.not_found'));
            }
            $updateOutbound = DB::transaction(function() use ($request, $outbound) {
                $updateOutbound = $this->outboundService->update($request, $outbound);
                return [
                    'updateOutbound' => $updateOutbound,
                ];
            });
            if ($updateOutbound['$updateOutbound']){
                DB::commit();
                return $this->createResponse('success',__('outbound.updated'));
            }
            DB::rollback();
            return $this->createResponse('error',__('outbound.update.failed'));
        } catch (Exception $e) {
            DB::rollBack();
            $this->log($e->getMessage(), auth()->id ?? '', 'Outbound - Update Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $outbound = $this->outboundService->getOutboundById($id);
            if(!$outbound) {
                return $this->createResponse('error',__('pstn.not_found'));
            }
            $deleteOutbound = DB::transaction(function() use ($outbound) {
                $deleteOutbound = $this->outboundService->delete($outbound);
                return [
                    'deleteOutbound' => $deleteOutbound,
                ];
            });
            if ($deleteOutbound['deleteOutbound']){
                DB::commit();
                return $this->createResponse('success',__('outbound.deleted'));
            }
            DB::rollback();
            return $this->createResponse('error',__('outbound.delete.failed'));
        }catch (Exception $e){
            $this->log($e->getMessage(), auth()->id ?? '', 'Outbound - Delete Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
        }
    }
}
