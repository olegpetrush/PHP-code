<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductIndexRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  ProductIndexRequest  $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ProductIndexRequest $request)
    {
        $data=$request->validated();
        $products=Product::filter($data)
            ->with('images')
            ->with('ingredients')
            ->with('statements')
            ->paginate(10);
        if(!empty($data['filter']['search'])){
            $products->appends('filter[search]',$data['filter']['search']);
        }
        return view('products.index')->with('products',$products);
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
     * @param  Product  $product
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Product $product)
    {
        //$this->authorize('view-product',$product);
        $product->load('ingredients');
        /**
        The "similar products" in the product page should be based on the logic here:
        1. Products from the same subcategory (if the subcategory value is not null).
        1.1. If the subcategory value is null, use products from the same category (if the category value is not null)
        2. The value of the "brand" column must be different from the brand value of the current product.
        3. No two products of the same brand.
        4. Max 5 products
        If the current product has no subcategory, no similar products will be displayed. We will then need to fix the loader script to make sure every product has a category and subcategory value.
         */
        $similar_products=Product::query();
        $found=false;
        if(!empty($product->subcategory)) {
            $similar_products->where('subcategory', $product->subcategory);
            $found=true;
        }
        else{
            if(!empty($product->category)) {
                $found=true;
                $similar_products->where('category', $product->category);
            }
        }
        if($found) {
            $similar_products = $similar_products->whereNotNull('brand')
                ->where('brand', '<>', $product->brand)
                ->groupBy('brand')
                ->take(5)
                ->get();
        }

        $product->load('images');

        return view('products.show')->with('product',$product)
            ->with('similar_products',$similar_products ?? null);
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
}
