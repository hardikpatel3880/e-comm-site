<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\SizeMaster;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with(['images', 'sizes'])
            ->latest()->get();
        // return $products;
        return view('Admin.product.index', compact('products'));
    }

    public function create()
    {
        $sizeMaster = SizeMaster::where('status', 'Y')->get();
        // return $sizeMaster;
        return view('Admin.product.create', compact('sizeMaster'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'productName' => 'required|string|max:255',
            'productDescription' => 'required|string',
            'productPrice' => 'required|numeric',
            'productThumbnail' => 'required|image',
            'productImages.*' => 'required|image',

            // 'productThumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'productImages.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = new Product();
        $product->productName = $request->productName;
        $product->slug = $request->slug;
        $product->productDescription = $request->productDescription;
        $product->productPrice = $request->productPrice;
        if ($request->productThumbnail) {
            $image = $request->file('productThumbnail');
            $imageName = $image->getClientOriginalName();
            $destinationPath = public_path('collection/product/thumbnail');
            $image->move($destinationPath, $imageName);
            $product->productThumbnail = $imageName;
        }
        if ($request->status) {
            $product->status = 'Y';
        } else {
            $product->status = 'N';
        }
        if ($request->bestseller) {
            $product->bestseller = "Y";
        } else {
            $product->bestseller = "N";
        }
        $product->save();
        if ($request->hasFile('productImages')) {
            foreach ($request->file('productImages') as $image) {
                $imageName = $image->getClientOriginalName();

                $destinationPath = public_path('collection/product/productimage');
                $image->move($destinationPath, $imageName);
                $relativePath = $imageName;
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $relativePath,
                ]);
            }
        }
        if ($request->has('size_master_ids')) {
            foreach ($request->size_master_ids as $sizeMasterId) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'size_master_id' => $sizeMasterId,
                ]);
            }
        }
        return redirect()->route('product.index')
            ->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $product = Product::with(['images', 'sizes'])->findOrFail($id);
        $sizeMaster = SizeMaster::where('status', 'Y')->get();
        // return $sizeMaster;
        $selectedSizes = $product->sizes->pluck('size_master_id')->toArray();

        return view('Admin.product.edit', compact('product', 'sizeMaster', 'selectedSizes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'productName' => 'required|string|max:255',
            'productDescription' => 'required|string',
            'productPrice' => 'required|numeric',
            'productThumbnail' => 'nullable|image',
            'productImages.*' => 'nullable|image',
        ]);

        $product = Product::findOrFail($id);
        $product->productName = $request->productName;
        $product->slug = $request->slug;
        $product->productDescription = $request->productDescription;
        $product->productPrice = $request->productPrice;
        $product->status = $request->status ? 'Y' : 'N';
        $product->bestseller = $request->bestseller ? 'Y' : 'N';
        if ($request->hasFile('productThumbnail')) {
            if ($product->productThumbnail && file_exists(public_path('collection/product/thumbnail/' . $product->productThumbnail))) {
                unlink(public_path('collection/product/thumbnail/' . $product->productThumbnail));
            }

            $image = $request->file('productThumbnail');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('collection/product/thumbnail'), $imageName);
            $product->productThumbnail = $imageName;
        }

        $product->save();

        if ($request->hasFile('productImages')) {
            foreach ($product->images as $image) {
                if ($image->image && file_exists(public_path('collection/product/productimage/' . $image->image))) {
                    unlink(public_path('collection/product/productimage/' . $image->image));
                }
                $image->delete();
            }

            foreach ($request->file('productImages') as $image) {
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('collection/product/productimage'), $imageName);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imageName,
                ]);
            }
        }
        $existingSize = ProductSize::where('product_id', $id)->pluck('size_master_id')->toArray();
        $newSizes = array_diff((array)$request->size_master_ids, $existingSize);

        // ProductSize::where('product_id', $product->id)->delete();
        // if ($request->has('size_master_ids')) {
        foreach ($newSizes as $sizeMasterId) {
            ProductSize::create([
                'product_id' => $product->id,
                'size_master_id' => $sizeMasterId,
            ]);
        }
        // }
        $sizesToRemove = array_diff($existingSize, (array)$request->size_master_ids);
        ProductSize::where('product_id', $id)->whereIn('size_master_id', $sizesToRemove)->delete();

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        if ($product->productThumbnail && file_exists(public_path($product->productThumbnail))) {
            unlink(public_path($product->productThumbnail));
        }

        foreach ($product->images as $image) {
            if (file_exists(public_path($image->image))) {
                unlink(public_path($image->image));
            }
        }

        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);

        $imagePath = public_path('collection/product/productimage/' . $image->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }
}
