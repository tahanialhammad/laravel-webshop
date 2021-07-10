<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
// use Cartalyst\Stripe\Stripe;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function addToCart(Product $product)
    {
        if( session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }else {
            $cart = new Cart();
        }

        $cart->add($product);
        //dd($cart);
        session()->put('cart', $cart);
        return redirect()->route('product.index')->with('success', 'Product was added');
    }

    public function showCart()
    {
        if( session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }else {
            $cart = null ;
        }
        return view('cart.show', compact('cart'));
    }

    public function checkout($amount)
    {
        // return $amount;
        return view('cart.checkout', compact('amount'));
    }

    public function charge(Request $request)
    {
       // dd($request->stripeToken);
        $charge = Stripe::charges()->create([
            'currency' => 'EUR',
            'source' => $request->stripeToken,
            'amount'   => $request->amount,
            'description' => ' Test from laravel new app'
        ]);

        $chargeId = $charge['id'];

        if ($chargeId) {

             // clean cart
            session()->forget('cart');
            return redirect()->route('store')->with('success', " Payment was done. Thanks");
        }else {
            return redirect()->back();
        }
    }
}
