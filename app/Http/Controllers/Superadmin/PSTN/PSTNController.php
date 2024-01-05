<?php

namespace App\Http\Controllers\Superadmin\PSTN;

use App\DataTables\PSTNDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\PSTN\UpdatePSTNRequest;
use App\Http\Services\CustomerService;
use App\Http\Services\PSTNService;
use App\Traits\Logger;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class PSTNController extends Controller
{
    use Logger, Response;
    private $PSTNService;

    public function __construct(PSTNService $PSTNService){
        $this->PSTNService = $PSTNService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PSTNDataTable $PSTNDataTable)
    {
        $customerService = new CustomerService();
        $customers = $customerService->getAllCustomers()->pluck('name','id')->toArray();
        return $PSTNDataTable->render('_back.superadmin.pstn.index',compact('customers'));
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
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $createPSTN = DB::transaction(function () use ($request) {
                $createPSTN = $this->PSTNService->create($request);
                return [
                    'createPSTN' => $createPSTN,
                ];
            });
            if ($createPSTN['createPSTN']){
                DB::commit();
                return$this->createResponse('success',__('pstn.created'));
            }
            DB::rollback();
            return $this->createResponse('error',__('pstn.creation.failed'));
        } catch (\Exception $e) {
            DB::rollBack();
            $this->log($e->getMessage(), auth()->id ?? '', 'PSTN - Store Operation', request()->ip(), $e);
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
    public function edit(string $id): \Illuminate\Http\JsonResponse
    {
        try {
            $PSTN = $this->PSTNService->getPSTNById($id);
            if(!$PSTN) {
                return $this->createResponse('error',__('pstn.not_found'));
            }
            return $this->createResponse('success',null,$PSTN);
        }catch (\Exception $e){
            $this->log($e->getMessage(), auth()->id ?? '', 'PSTN - Edit Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePSTNRequest $request, string $id)
    {
        try{
            $PSTN = $this->PSTNService->getPSTNById($id);
            if(!$PSTN) {
                return $this->createResponse('error',__('pstn.not_found'));
            }
            $updatePSTN = DB::transaction(function() use ($request, $PSTN) {
                $updatePSTN = $this->PSTNService->update($request, $PSTN);
                return [
                    'updatePSTN' => $updatePSTN,
                ];
            });
            if ($updatePSTN['updatePSTN']){
                DB::commit();
                return $this->createResponse('success',__('pstn.updated'));
            }
            DB::rollback();
            return $this->createResponse('error',__('pstn.update.failed'));
        } catch (Exception $e) {
            DB::rollBack();
            $this->log($e->getMessage(), auth()->id ?? '', 'PSTN - Update Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $PSTN = $this->PSTNService->getPSTNById($id);
            if(!$PSTN) {
                return $this->createResponse('error',__('pstn.not_found'));
            }
            $deletePSTN = DB::transaction(function() use ($PSTN) {
                $deletePSTN = $this->PSTNService->delete($PSTN);
                return [
                    'deletePSTN' => $deletePSTN,
                ];
            });
            if ($deletePSTN['deletePSTN']){
                DB::commit();
                return $this->createResponse('success',__('pstn.deleted'));
            }
            DB::rollback();
            return $this->createResponse('error',__('pstn.delete.failed'));
        }catch (Exception $e){
            $this->log($e->getMessage(), auth()->id ?? '', 'PSTN - Delete Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
        }
    }
}
