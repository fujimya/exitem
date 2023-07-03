<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MBrand;

class Brand extends Controller
{
    public function index()
    {
        $brands = MBrand::paginate(20);
        return response()->json([
            'data' => $brands,
            'current_page' => $brands->currentPage(),
            'last_page' => $brands->lastPage(),
            'per_page' => $brands->perPage(),
            'total' => $brands->total()
        ]);
    }
    public function cari(Request $request)
    {
        $perPage = 10; // Jumlah data yang ditampilkan per halaman

        $query = MBrand::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        }

        if ($request->has('sort')) {
            $sortColumn = $request->input('sort.column');
            $sortDirection = $request->input('sort.direction', 'asc');
    
            $query->orderBy($sortColumn, $sortDirection);
        }

        $brand = $query->paginate($perPage);

        return response()->json([
            'data' => $brand->items(),
            'current_page' => $brand->currentPage(),
            'last_page' => $brand->lastPage(),
            'per_page' => $brand->perPage(),
            'total' => $brand->total(),
        ]);
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
