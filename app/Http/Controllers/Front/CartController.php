<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $product;
    private $cart;
    public function __construct(Product $product, Cart $cart)
    {
        $this->product = $product;
        $this->cart = $cart;
    }
    public function addToCart($id, Request $request)
    {
        $product = $this->product->find($id);
        $cart = $this->cart->all();
        foreach ($cart as $item) {
            if ($item->product_id == $product->id) {
                $item->update([
                    'qty' => $item->qty + $request->qty,
                ]);
                return back();
            }
        }
        $this->cart->create([
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->discount ?? $product->price,
            'weight' => $product->weight ?? 0,
            'images' => $product->productImages[0]->path,
            'qty' => $request->qty,
        ]);
        return back();
    }

    public function add($id)
    {
        $product = $this->product->find($id);
        $cart = $this->cart->all();
        foreach ($cart as $item) {
            if ($item->product_id == $product->id) {
                $item->update([
                    'qty' => $item->qty + 1,
                ]);
                return back();
            }
        }
        $this->cart->create([
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->discount ?? $product->price,
            'weight' => $product->weight ?? 0,
            'images' => $product->productImages[0]->path,
        ]);
        return back();
    }

    public function index()
    {
        $subTotal = 0;
        $cart = $this->cart->all();
        foreach ($cart as $item) {
            $item->total = ($item->price * $item->qty);
            $subTotal += ($item->price * $item->qty);
        }

        return view('front.shop.cart', compact('cart', 'subTotal'));
    }
    public function update(Request $request, $id)
    {
        $this->cart->find($id)->update([
            'qty' => $request->qty,
        ]);

        // if ($request->ajax()) {
        //     $response['cart'] = $this->cart->update([$request->rowId, $request->qty]) ? 'xx' : 'yy';
        //     $response['count'] = count($this->cart->all());
        //     $subTotal = 0;
        //     $cart = $this->cart->all();
        //     foreach ($cart as $item) {
        //         $item->total = ($item->price * $item->qty);
        //         $subTotal += ($item->price * $item->qty);
        //     }
        //     $response['subtotal'] = $subTotal;
        //     return $response;
        // }
        return back();
    }
    public function delete($id)
    {
        $this->cart->find($id)->delete();
        return back();
    }
    public function deleteAll()
    {
        $this->cart->getQuery()->delete();
        return back();
    }
}