<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MCategory;

class Category extends Controller
{
    public function index()
    {
        $categorys = MCategory::paginate(20);
        return response()->json([
        'data' => $categorys,
        'current_page' => $categorys->currentPage(),
        'last_page' => $categorys->lastPage(),
        'per_page' => $categorys->perPage(),
        'total' => $categorys->total(),]);
    }
    public function cari(Request $request)
    {
        $perPage = 10; // Jumlah data yang ditampilkan per halaman

        $query = MCategory::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        }
        if ($request->has('sort')) {
            $sortColumn = $request->input('sort.column');
            $sortDirection = $request->input('sort.direction', 'asc');
    
            $query->orderBy($sortColumn, $sortDirection);
        }

        $categories = $query->paginate($perPage);

        return response()->json([
            'data' => $categories->items(),
            'current_page' => $categories->currentPage(),
            'last_page' => $categories->lastPage(),
            'per_page' => $categories->perPage(),
            'total' => $categories->total(),
        ]);
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
