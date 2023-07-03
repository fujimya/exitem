<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MCategory;

class Category extends Controller
{
    public function index()
    {
        $categorys = MCategory::all();
        return response()->json(['data' => $categorys]);
    }

    public function show($id)
    {
        $category = MCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'category not found'], 404);
        }

        return response()->json(['data' => $category]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = MCategory::create($request->all());

        return response()->json(['message' => 'category created', 'data' => $category], 201);
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|string|max:255',
        ]);

        $category = MCategory::where('id', $request->id)->update(
            [
                'name' => $request->name,
            ]

            );
        

        return response()->json(['message' => 'category updated', 'data' => $category]);
    }
    public function destroy($id)
    {
        $category = MCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'category not found'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'category deleted']);
    }

}
