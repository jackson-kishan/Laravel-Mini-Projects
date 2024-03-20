<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();

        if(is_null($products->first())) {
            return response()->json([
                'status' => 'success',
                'message' => 'No product found',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Product are retrieved successfully',
            'data' => $products,
        ];

        return response()->json($response, 200);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
           'name' => 'required|string|max:100',
           'description' => 'required|string',
        ]);

        if($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'data' => $validate->errors(),
            ], 403);
        }

        $product = Product::create($request->all());

        $response = [
            'status' => 'success',
            'message' => 'Product is successfully created',
            'data' => $product,
        ];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);

        if(is_null($product)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found',   
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Product is retrieved successfully',
            'data' => $product,
        ];

        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
           'name' => 'required',
           'description' => 'required',
        ]);

        if($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation failed',
                'data' => $validate->errors(),
            ], 200);
        }

        $product = Product::find($id);

        if(is_null($product)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Product is not found',
            ], 200);
        }

        $product->update($request->all());

        $response = [
            'status' => 'success',
            'message' => 'Product is update successfully',
            'data' => $product,
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $product = Product::find($id);

       if(is_null($product)) {
        return response()->json([
            'status' => 'failed',
            'message' => 'Validation failed',
        ], 200);
       }

       Product::destroy($id);

       return response()->json([
        'status' => 'success',
        'message' => 'Product is delete successfully',
      ], 200);
    }

    public function search($name) 
    {
        $products = Product::where('name', 'like', '%' . $name . '%')
                 ->latest()->get();

         if(is_null($products->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Product is not found',
            ], 200);
         }        

         $response = [
            'status' => 'success',
            'message' => 'Product are retrieved successfully',
            'data' => $products,
        ];

        return response()->json($response, 200);
    }
}
