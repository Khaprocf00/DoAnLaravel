<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductComment;
use App\Models\ProductDetail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $product;
    private $blog;
    private $productCategory;
    private $productDetail;
    private $productComment;
    private $cart;
    public function __construct(Cart $cart, Product $product, Blog $blog, ProductCategory $productCategory, ProductDetail $productDetail, ProductComment $productComment)
    {
        $this->product = $product;
        $this->blog = $blog;
        $this->productDetail = $productDetail;
        $this->productComment = $productComment;
        $this->productCategory = $productCategory;
        $this->cart = $cart;
    }
    public function index()
    {
        $cart = $this->cart->all();
        $subTotal = 0;
        foreach ($cart as $item) {
            $item->total = ($item->price * $item->qty);
            $subTotal += ($item->price * $item->qty);
        }
        $menProducts = $this->product->where('featured', true)->where('product_category_id', 1)->get();
        $womenProducts = $this->product->where('featured', true)->where('product_category_id', 2)->get();
        $blog = $this->blog->orderBy('id', 'desc')->limit(3)->get();
        return view('front.index', [
            'menProducts' => $menProducts,
            'womenProducts' => $womenProducts,
            'blog' => $blog,
            'cart' => $cart,
            'subTotal' => $subTotal,
        ]);
    }
}
