<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    //return list of donations
    public function index()
    {
        $collections = Collection::all(['id', 'title', 'description', 'target_amount', 'link']);
        return response()->json($collections);
    }
    //create new donation
    public function createCollection(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'target_amount' => 'required|numeric|min:0',
            'link' => 'required|url',
        ]);

        $collection = Collection::create($data);

        return response()->json(['message' => 'Collection created successfully', 'collection' => $collection], 201);
    }
    //return detailed info
    public function showDetails($id)
    {
        $collection = Collection::with('contributors')->findOrFail($id);
        return response()->json($collection);
    }
    //find donations which less than specific amount
    public function filter(Request $request)
    {
        $amount = $request->query('amount', 0);

        $collections = Collection::whereHas('contributors', function ($query) use ($amount) {
            $query->select('collection_id', \DB::raw('SUM(amount) as total_amount'))
                ->groupBy('collection_id')
                ->havingRaw('total_amount < collections.target_amount')
                ->whereRaw("total_amount < $amount");
        })->get(['id', 'title', 'description', 'target_amount', 'link']);

        return response()->json($collections);
    }
}
