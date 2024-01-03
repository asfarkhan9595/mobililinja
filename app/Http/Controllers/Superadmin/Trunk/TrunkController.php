<?php

namespace App\Http\Controllers\Superadmin\Trunk;
use App\DataTables\CustomerDataTable;
use App\DataTables\TrunkDataTable;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Trunk\CreateTrunkRequest;
use App\Http\Requests\Trunk\UpdateTrunkRequest;
use App\Http\Services\TrunkService;
use App\Models\Trunk;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TrunkController extends Controller
{ 
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
    public function store(CreateTrunkRequest $request)
    {
        try {
            $createTrunk = $this->trunkService->create($request);
    
            if ($createTrunk) {
                return redirect()->route('superadmin.trunks.index')->with(['message' => __('trunk-created')]);
            }
    
            return redirect()->route('superadmin.trunks.index')->with(['error' => __('messages.trunk-creation-failed')]);
        } catch (\Exception $e) {
            $this->log($e->getMessage(), auth()->id ?? '', 'Trunk - List Operation', request()->ip(), $e);
            return redirect()->route('superadmin.trunks.index')->with(['error' => __('messages.trunk-creation-error')]);
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
     
             if (!$trunk) {
                 return response()->json(['error' => 'Trunk not found'], 404);
             }
     
             return response()->json($trunk, 200);
         } catch (Exception $e) {
             $this->log($e->getMessage(), auth()->id ?? '', 'Trunk - Edit Operation', request()->ip(), $e);
             return response()->json(['error' => 'Internal Server Error'], 500);
         }
     }
     
     
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrunkRequest $request, string $id)
{
    
    try {
        $trunk = $this->trunkService->getTrunkById($id);

        if (!$trunk) {
            return response()->json(['error' => 'Trunk not found'], 404);
        }

        $updateTrunk = $this->trunkService->update($request, $trunk);

        if (!$updateTrunk) {
            return response()->json(['error' => 'Trunk update failed'], 500);
        }

        // If you're in an API context, you might return a success JSON response here
        return response()->json(['message' => trans('messages.trunk-updated')], 200);
    } catch (Exception $e) {
        $this->log($e->getMessage(), auth()->id ?? '', 'Trunk - Update Operation', request()->ip(), $e);
        return response()->json(['error' => trans('messages.trunk-update-error')], 500);
    }
}
    protected function log($message, $userId, $operation, $ip, Exception $exception = null)
    {
        // Your logging logic here
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($trunk)
    {
        try {
            // Retrieve the Trunk model using the provided $trunk parameter
            $trunkModel = Trunk::findOrFail($trunk);

            $result = $this->trunkService->delete($trunkModel);

            if ($result) {
                // Return a success response or redirect as needed
                return response()->json(['message' => 'Data deleted successfully']);
            } else {
                // Return an error response or handle the error scenario
                return response()->json(['error' => 'Failed to delete data'], 500);
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., Trunk model not found)
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
