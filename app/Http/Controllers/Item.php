<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MItem;

class Item extends Controller
{
    //
    public function index()
    {
        $items = MItem::paginate(20);
        return response()->json([
            'data' => $items,
            'current_page' => $items->currentPage(),
            'last_page' => $items->lastPage(),
            'per_page' => $items->perPage(),
            'total' => $items->total()
        ]);
    }
    public function cari(Request $request)
    {
        $perPage = 10; // Jumlah data yang ditampilkan per halaman

        $query = MItem::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        }
        if ($request->has('sort')) {
            $sortColumn = $request->input('sort.column');
            $sortDirection = $request->input('sort.direction', 'asc');
    
            $query->orderBy($sortColumn, $sortDirection);
        }

        $item = $query->paginate($perPage);

        return response()->json([
            'data' => $item->items(),
            'current_page' => $item->currentPage(),
            'last_page' => $item->lastPage(),
            'per_page' => $item->perPage(),
            'total' => $item->total(),
        ]);
    }

    public function show($id)
    {
        $item = MItem::find($id);

        if (!$item) {
            return response()->json(['message' => 'item not found'], 404);
        }

        return response()->json(['data' => $item]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required',
            'name' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
        ]);

        $item = MItem::create($request->all());

        return response()->json(['message' => 'item created', 'data' => $item], 201);
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'number' => 'required',
            'name' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
        ]);

        $item = MItem::where('id', $request->id)->update(
            [
                'number' => $request->number,
                'name' => $request->name,
                'brand_id' => $request->brand_id,
                'category_id' => $request->item_id,
            ]

            );
        

        return response()->json(['message' => 'item updated', 'data' => $item]);
    }
    public function destroy($id)
    {
        $item = MItem::find($id);

        if (!$item) {
            return response()->json(['message' => 'item not found'], 404);
        }

        $item->delete();

        return response()->json(['message' => 'item deleted']);
    }
}
