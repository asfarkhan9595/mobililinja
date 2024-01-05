<?php

namespace App\Http\Services;

use App\Models\PhoneBook;
use App\Traits\Logger;
use Illuminate\Http\Request;

class PhoneBookService
{
    use Logger;

    public function getAllPhoneBookEntries()
    {
        try {
            // Fetch all phone book entries
            return PhoneBook::select(['id', 'first_name','last_name', 'phone_number', 'mobile_number', 'company', 'position']);
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'PhoneBook - List Operation', request()->ip(), $e);
            return collect(); // Return an empty collection on error
        }
    }

    public function getPhoneBookEntryById($id)
    {
        try {
            // Fetch a phone book entry by ID
            $phoneBookEntry = PhoneBook::find($id);
            if (!$phoneBookEntry) {
                return false;
            }
            return $phoneBookEntry;
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'PhoneBook - Fetch Single', request()->ip(), $e);
            return collect(); // Return an empty collection on error
        }
    }

    public function create(Request $request): PhoneBook|bool
    {
        try {
            // Creating a new phone book entry
            return PhoneBook::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'mobile_number' => $request->mobile_number,
                'company' => $request->company,
                'position' => $request->position,
            ]);
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'PhoneBook - Create Operation', request()->ip(), $e);
            return false; // Return false on error
        }
    }

    public function update(Request $request, PhoneBook $phoneBookEntry): bool
    {
        try {
            // Updating a phone book entry
            return $phoneBookEntry->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'mobile_number' => $request->mobile_number,
                'company' => $request->company,
                'position' => $request->position,
            ]);
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'PhoneBook - Update Operation', request()->ip(), $e);
            return false; // Return false on error
        }
    }

    public function delete($phoneBook)
    {
        try {
            // Deleting a phone book entry
            return $phoneBook->delete();
        } catch (\Exception $e) {
            // Log any exceptions
            $this->log($e->getMessage(), auth()->id ?? '', 'PhoneBook - Delete Operation', request()->ip(), $e);
            return false; // Return false on error
        }
    }
}
