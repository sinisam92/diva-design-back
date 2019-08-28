<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\Http\Requests\ShopRequest;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
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
    public function store(ShopRequest $request)
    {
        $user = auth()->user()->id;
        $shop = new Shop();
        $shop->title = $request->input('title');
        $shop->description = $request->input('description');
        $shop->price = $request->input('price');
        $shop->currency = $request->input('currency');
        $shop->image_url = $request->input('image_url');
        $shop->type = $request->input('type');
        $shop->user_id = $user;
        $shop->save();

        return $this->show($shop->id);
    }
    public function update(Request $request, $id)
    {
        $user = auth()->user()->id;
        $shop = Shop::find($id);
        $shop->title = $request->input('title');
        $shop->description = $request->input('description');
        $shop->price = $request->input('price');
        $shop->currency = $request->input('currency');
        $shop->image_url = $request->input('image_url');
        $shop->type = $request->input('type');
        $shop->user_id = $user;
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
