<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function __construct() {

        $this->middleware('auth');
        $this->middleware('permission:create-product|edit-product|delete-product',  ['only' => ['index', 'show']]);
        $this->middleware('permission:create-product', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-product', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-product', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('products.index' , [
          'products' => Product::latest()->paginate(3)
        ]);
            
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request) : RedirectResponse
    {
        
        Product::create($request->all());
        return redirect()->route('products.index')
                  ->withSuccess('New Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show' , [
          'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit' , [
            'product' => $product
          ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product) : RedirectResponse
    {
        $product->update($request->all());
        return redirect()->back()
                ->withSuccess('Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back('products.index')
                ->withSuccess('Product delete successfully');
    }
}
