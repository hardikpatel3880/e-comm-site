<?php

namespace App\Http\Controllers\visitor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function home()
    {
        $products = Product::where('status', 'y')->where('bestseller', 'Y')->with('sizes.size')->get();
        $slider = Slider::orderBy('sortOrder', 'asc')->get();

        // return $products;

        return view('visitor.pages.home', compact('products', 'slider'));
    }

    public function product()
    {
        $products = Product::where('status', 'y')->with('sizes.size')->paginate(12);

        return view('visitor.pages.product', compact('products'));
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->with('images', 'sizes.size')->first();
        // return $product;
        return view('visitor.pages.productDetail', compact('product'));
    }
}
