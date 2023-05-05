<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductComment;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private $product;
    private $productComment;
    private $brand;
    private $productCategory;
    private $cart;
    public function __construct(Cart $cart, Product $product, ProductComment $productComment, Brand $brand, ProductCategory $productCategory)
    {
        $this->product = $product;
        $this->productComment = $productComment;
        $this->brand = $brand;
        $this->productCategory = $productCategory;
        $this->cart = $cart;
    }
    public function sortAndPaginate($sortBy, $perPage, $product)
    {

        switch ($sortBy) {
            case 'latest':
                $product = $product->orderBy('id');
                break;
            case 'oldest':
                $product = $product->orderByDesc('id');
                break;
            case 'name-ascending':
                $product = $product->orderBy('name');
                // dd($product);
                break;
            case 'name-descending':
                $product = $product->orderByDesc('name');
                break;
            case 'price-ascending':
                $product = $product->orderBy('price');
                break;
            case 'price-descending':
                $product = $product->orderByDesc('price');
                break;
            default:
                $product = $product->orderBy('id');
        }

        $product =  $product->paginate($perPage);
        $product->appends(['sort_by' => $sortBy, 'show' => $perPage]);
        return $product;
    }

    public function show($id)
    {
        $cart = $this->cart->all();
        $subTotal = 0;
        $cart = $this->cart->all();
        foreach ($cart as $item) {
            $item->total = ($item->price * $item->qty);
            $subTotal += ($item->price * $item->qty);
        }
        $brand = $this->brand->all();
        $category = $this->productCategory->all();
        $product = $this->product->find($id);
        $avgRating = 0;
        $sumRating = array_sum(array_column($product->productComments->toArray(), 'rating'));
        $countRating = count($product->productComments);
        if ($countRating != 0) {
            $avgRating = $sumRating / $countRating;
        }
        $product->avgRating = $avgRating;
        $productRelated = $this->product->where('tag', '=', $product->tag)->limit(4)->get();
        return view('front.shop.show', compact('product', 'productRelated', 'category', 'brand', 'cart', 'subTotal'));
    }

    public function addShow($id, Request $request)
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
            'qty' => $request->qty,
            'price' => $product->discount ?? $product->price,
            'weight' => $product->weight ?? 0,
            'images' => $product->productImages[0]->path,
        ]);
        return back();
    }

    public function index(Request $request)
    {
        $cart = $this->cart->all();
        $subTotal = 0;
        $cart = $this->cart->all();
        foreach ($cart as $item) {
            $item->total = ($item->price * $item->qty);
            $subTotal += ($item->price * $item->qty);
        }
        $brand = $this->brand->all();
        $category = $this->productCategory->all();
        $perPage = $request->show ?? 6;
        $sortBy = $request->sort_by ?? 'latest';
        $search = $request->search ?? '';
        $product = $this->product->where('name', 'like', '%' . $search . '%');
        $product = $this->filter($request, $product);
        $product = $this->sortAndPaginate($sortBy, $perPage, $product);
        return view('front.shop.index', compact('product', 'category', 'brand', 'cart', 'subTotal'));
    }
    public function postComment(Request $request)
    {
        $this->productComment->create($request->all());
        return redirect()->back();
    }
    public function filter(Request $request, $product)
    {
        //brand
        $brand = $request->brand ?? [];
        $brand_id = array_keys($brand);
        $product = $brand_id != null ? $product->whereIn('brand_id', $brand_id) : $product;


        //price
        $priceMin = str_replace('$', '', $request->price_min);
        $priceMax = str_replace('$', '', $request->price_max);
        $product = ($priceMin != null && $priceMax != null) ? ($product->whereBetween('price', [$priceMin, $priceMax])) : $product;

        //color
        $color = $request->color;
        $product =  $color != null ? $product->whereHas('productDetails', function ($query) use ($color) {
            return $query->where('color', $color)->where('qty', '>', 0);
        }) : $product;

        //size
        $size = $request->size;
        $product =  $size != null ? $product->whereHas('productDetails', function ($query) use ($size, $color) {
            if ($color != null) {
                return $query->where('size', $size)->where('color', $color)->where('qty', '>', 0);
            } else {
                return $query->where('size', $size)->where('qty', '>', 0);
            }
        }) : $product;


        return $product;
    }
    public function category($categoryName, Request $request)
    {
        $perPage = $request->show ?? 6;
        $sortBy = $request->sort_by ?? 'latest';
        $search = $request->search ?? '';

        $brand = $this->brand->all();
        $cart = $this->cart->all();
        $subTotal = 0;
        $cart = $this->cart->all();
        foreach ($cart as $item) {
            $item->total = ($item->price * $item->qty);
            $subTotal += ($item->price * $item->qty);
        }
        $category = $this->productCategory->all();
        $idCategory = $this->productCategory->where('name', $categoryName)->get();
        $product = $this->product->where('product_category_id', $idCategory[0]->id)->get()->toQuery();
        $product = $product->where('name', 'like', '%' . $search . '%');
        $product = $this->filter($request, $product);
        $product = $this->sortAndPaginate($sortBy, $perPage, $product);
        return view('front.shop.index', compact('product', 'category', 'brand', 'subTotal', 'cart'));
    }
}
