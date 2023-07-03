<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MItem;

class Item extends Controller
{
    //
    public function index()
    {
        $items = MItem::all();
        return response()->json(['data' => $items]);
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
