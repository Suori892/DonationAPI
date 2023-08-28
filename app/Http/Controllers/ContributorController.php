<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contributor;

class ContributorController extends Controller
{
    //add new user + amount
    public function addContributor(Request $request)
    {
        $data = $request->validate([
            'collection_id' => 'required|exists:collections,id',
            'user_name' => 'required',
            'amount' => 'required|numeric|min:0',
        ]);

        $contributor = Contributor::create($data);

        return response()->json(['message' => 'Contribution added successfully', 'contributor' => $contributor], 201);
    }
}
