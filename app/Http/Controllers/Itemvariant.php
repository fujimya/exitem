<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MItemvariant;

class Itemvariant extends Controller
{
    //
    public function index()
    {
        $itemvariants = MItemvariant::all();
        return response()->json(['data' => $itemvariants]);
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
