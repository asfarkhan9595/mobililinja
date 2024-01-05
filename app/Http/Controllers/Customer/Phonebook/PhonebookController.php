<?php

namespace App\Http\Controllers\Customer\Phonebook;
use App\Http\Requests\PhoneBook\CreatePhoneBookRequest;
use App\DataTables\PhoneBookDataTable;
use App\Http\Controllers\Controller;
// use App\Http\Requests\PhoneBook\CreatePhoneBookRequest;
use App\Http\Requests\PhoneBook\UpdatePhoneBookRequest;
use Illuminate\Http\Request;
use App\Http\Services\PhoneBookService;
use App\Traits\Logger;
use App\Traits\Response;
use Exception;
use Illuminate\Support\Facades\DB;

class PhonebookController extends Controller
{
    use Logger, Response;
    private $phoneBookService;

    public function __construct(PhoneBookService $phoneBookService)
    {
        $this->phoneBookService = $phoneBookService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PhoneBookDataTable $phoneBookDataTable)
    {
        try {
            return $phoneBookDataTable->render('_back.customer.phonebooks.index');
        } catch (Exception $e) {
            $this->log($e->getMessage(), auth()->id ?? '', 'PhoneBook - List/Select Operation', request()->ip(), $e);
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
    public function store(CreatePhoneBookRequest $request)
    {

        try {
            $createPhoneBook = DB::transaction(function () use ($request) {
                $createPhoneBook = $this->phoneBookService->create($request);
                return [
                    'createPhoneBook' => $createPhoneBook,
                ];
            });
            if ($createPhoneBook['createPhoneBook']) {
                DB::commit();
                return $this->createResponse('success', __('phonebook.created'));
            }
            DB::rollback();
            return $this->createResponse('error', __('phonebook.creation.failed'));
        } catch (Exception $e) {
            DB::rollBack();
            $this->log($e->getMessage(), auth()->id ?? '', 'PhoneBook - Store Operation', request()->ip(), $e);
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
    public function edit(string $id)
    {
        try {
            $phonebook = $this->phoneBookService->getPhoneBookEntryById($id);
            if(!$phonebook) {
                return $this->createResponse('error',__('$phonebook.not_found'));
            }
            return $this->createResponse('success',null, $phonebook);
        }catch (Exception $e){
            $this->log($e->getMessage(), auth()->id ?? '', 'PhoneBook - Edit Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhoneBookRequest $request, string $id): \Illuminate\Http\JsonResponse
    {
        try {
            $phonebook = $this->phoneBookService->getPhoneBookEntryById($id);
            if(!$phonebook) {
                return $this->createResponse('error',__('phonebook.not_found'));
            }
            $updatePhoneBook = DB::transaction(function() use ($request, $phonebook) {
                $updatePhoneBook = $this->phoneBookService->update($request, $phonebook);
                return [
                    'updatePhoneBook' => $updatePhoneBook,
                ];
            });
            if ($updatePhoneBook['updatePhoneBook']){
                DB::commit();
                return $this->createResponse('success',__('phonebook.updated'));
            }
            DB::rollback();
            return $this->createResponse('error',__('phonebook.update.failed'));
        } catch (Exception $e) {
            DB::rollBack();
            $this->log($e->getMessage(), auth()->id ?? '', 'PhoneBook - Update Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $phonebook = $this->phoneBookService->getPhoneBookEntryById($id);
            if(!$phonebook) {
                return $this->createResponse('error',__('phonebook.not_found'));
            }
            $deletePhoneBook = DB::transaction(function() use ($phonebook) {
                $deletePhoneBook = $this->phoneBookService->delete($phonebook);
                return [
                    'deletePhoneBook' => $deletePhoneBook,
                ];
            });
            if ($deletePhoneBook['deletePhoneBook']){
                DB::commit();
                return $this->createResponse('success',__('phonebook.deleted'));
            }
            DB::rollback();
            return $this->createResponse('error',__('phonebook.delete.failed'));
        }catch (Exception $e){
            $this->log($e->getMessage(), auth()->id ?? '', 'PhoneBook - Delete Operation', request()->ip(), $e);
            return $this->createResponse('error',__('something_went_wrong'));
        }
    }
}
