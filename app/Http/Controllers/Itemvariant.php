<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MItemvariant;

class Itemvariant extends Controller
{
    //
    public function index()
    {
        $itemvariants = MItemvariant::paginate(20);
        return response()->json([
            'data' => $itemvariants,
            'current_page' => $itemvariants->currentPage(),
            'last_page' => $itemvariants->lastPage(),
            'per_page' => $itemvariants->perPage(),
            'total' => $itemvariants->total()
        ]);
    }

    public function cari(Request $request)
    {
        $perPage = 10; // Jumlah data yang ditampilkan per halaman

        $query = MItemvariant::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        }
        if ($request->has('sort')) {
            $sortColumn = $request->input('sort.column');
            $sortDirection = $request->input('sort.direction', 'asc');
    
            $query->orderBy($sortColumn, $sortDirection);
        }

        $itemvarian = $query->paginate($perPage);

        return response()->json([
            'data' => $itemvarian->items(),
            'current_page' => $itemvarian->currentPage(),
            'last_page' => $itemvarian->lastPage(),
            'per_page' => $itemvarian->perPage(),
            'total' => $itemvarian->total(),
        ]);
    }

    public function show($id)
    {
        $itemvariant = MItemvariant::find($id);

        if (!$itemvariant) {
            return response()->json(['message' => 'itemvariant not found'], 404);
        }

        return response()->json(['data' => $itemvariant]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'description' => 'required',
            'item_id' => 'required',
        ]);

        $itemvariant = MItemvariant::create($request->all());

        return response()->json(['message' => 'itemvariant created', 'data' => $itemvariant], 201);
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'code' => 'required',
            'description' => 'required',
            'item_id' => 'required',
        ]);

        $itemvariant = MItemvariant::where('id', $request->id)->update(
            [
                'code' => $request->code,
                'description' => $request->description,
                'item_id' => $request->item_id,
            ]

            );
        

        return response()->json(['message' => 'itemvariant updated', 'data' => $itemvariant]);
    }
    public function destroy($id)
    {
        $itemvariant = MItemvariant::find($id);

        if (!$itemvariant) {
            return response()->json(['message' => 'itemvariant not found'], 404);
        }

        $itemvariant->delete();

        return response()->json(['message' => 'itemvariant deleted']);
    }
}
