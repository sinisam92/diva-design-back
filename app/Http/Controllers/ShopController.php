<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;

class ShopController extends Controller
{
    public function index()
    {
        $query = Shop::query();
        $query->with(['user']);

        return response()->json([
            'shop' =>  $query->latest()->paginate(10)
        ]);
    }
    public function show($id)
    {
        return Shop::with(['user'])->find($id);
    }
    public function store(Request $request)
    {

        $shop = new Shop();
        $shop->title = $request->input('title');
        $shop->description = $request->input('description');
        $shop->price = $request->input('price');
        $shop->currency = $request->input('currency');
        $shop->image_url = $request->input('image_url');
        $shop->type = $request->input('type');
        // $shop->user_id = auth()->user()->id;
        $shop->save();

        return $this->show($shop->id);
    }
    public function destroy($id)
    {
        $shop = Shop::find($id);
        $shop->delete();
        return response()->json([
            'message' => 'Deleted'
        ]);
    }
}
