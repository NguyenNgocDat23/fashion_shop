<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\favorite;
use App\Models\product;
class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('isLogin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $favorites = favorite::where('user_id', $user->id)->get();
        return view('frontend.favorite.index', compact('favorites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $product_id)
    {
        $user = $request->user();
        $product = Product::find($product_id);
        $exiting_favorite = favorite::where('user_id', $user->id)
                                    -> where('product_id', $product->id)
                                    ->first();
        if($exiting_favorite){
            return redirect()->back()->with('error', 'Sản phẩm đã được thêm vào yêu thích trước đó!!!');
        }
        $favorite = Favorite::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
        return redirect()->route('favorite.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($favorite_id)
    {
        $favorite = Favorite::find($favorite_id);
        if ($favorite){
            return redirect()->back();
        }
        $favorite->delete();
        return redirect()->route('favorite.index');
    }
}
