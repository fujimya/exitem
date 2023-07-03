<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MBrand;

class Brand extends Controller
{
    public function index()
    {
        $brands = MBrand::all();
        return response()->json(['data' => $brands]);
    }

    public function show($id)
    {
        $brand = MBrand::find($id);

        if (!$brand) {
            return response()->json(['message' => 'Brand not found'], 404);
        }

        return response()->json(['data' => $brand]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $brand = MBrand::create($request->all());

        return response()->json(['message' => 'Brand created', 'data' => $brand], 201);
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|string|max:255',
        ]);

        $brand = MBrand::where('id', $request->id)->update(
            [
                'name' => $request->name,
            ]

            );
        

        return response()->json(['message' => 'Brand updated', 'data' => $brand]);
    }
    public function destroy($id)
    {
        $brand = MBrand::find($id);

        if (!$brand) {
            return response()->json(['message' => 'Brand not found'], 404);
        }

        $brand->delete();

        return response()->json(['message' => 'Brand deleted']);
    }


}
