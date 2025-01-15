<?php

namespace App\Http\Controllers;

use Cart;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $cartItems= FacadesCart::instance('cart')->content();
        return view('cart',compact('cartItems'));
    }

    public function AddToCart(Request $request){
        $product = Product::find($request->id);
        $price = $product->sale_price?$product->sale_price:$product->regular_price;
        FacadesCart::instance('cart')->add( $product->id , $product->name, $request->quantity, $price)->associate('App\Models\product');
        return redirect()->back()->with('message','success! item has been added successfully');
    }

    public function UpdateCart(Request $request){
        FacadesCart::instance('cart')->update($request->rowId,$request->quantity);
        return redirect()->route('cart.index');
    }

    public function removeItem(Request $request){
        FacadesCart::instance('cart')->remove($request->rowId);
        return redirect()->route('cart.index');
    }
    public function ClearCart(){
        FacadesCart::instance('cart')->destroy();
        return redirect()->route('cart.index');
    }
}
