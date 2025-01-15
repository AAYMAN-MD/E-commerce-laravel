<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use GuzzleHttp\Psr7\Request as Psr7Request;

class WishlistController extends Controller

{

    public function getWishlistedProducts(){
        $items = Cart::instance("whishlist")->content();
        return view('whishlist',['item'=>$items]);
    }
    public function addProductToWishlist(Request $request){
        Cart::instance('Wishlist')->add($request->id,$request->name,$request->price)->associate('App\Models\Product');
        return response()->json(['status' => 200,'message'=> 'Success ! item successfully added to your wishlist']);
    }

    public function removeProductFromWishlist(Request $request){
        $rowId = $request->rowId;
        Cart::instance("wishlist")->remove($rowId);
        return redirect()->route('wishlist.list');
    }

    public function cleanWishlist(){
        Cart::instance("whishlist")->destroy();
        return redirect()->route('wishlist.list');
    }

    public function moveToCart(Request $request)
    {
        $item = Cart::instance("wishlist")->get($request->rowId);
        Cart::instance('wishlist')->remove($request->rowId);
        Cart::instance('cart')->add($item->model->id,$item->model->name,1,$item->model->regular_price)->associate('App\Models\Product');
        return redirect(route('wishlist.list'));
    }
}
