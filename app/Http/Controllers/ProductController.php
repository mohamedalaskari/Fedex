<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductLineRequest;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductIdRequest;
use App\Http\Requests\UpdateProductLineRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\ProductLine;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        Gate::authorize('viewAny', $product);
        $product = $product->get();
        return $this->response(code: 200, data: $product);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request, StoreProductLineRequest $product_line,Product $product)
    {
        Gate::authorize('create',$product);
        $request = str_replace(' ', '', $request->validated());
        //product_line_id
        $product_line = str_replace(' ', '', $product_line->validated());
        $array_valus = implode(array_values($product_line));
        $product_line_id = ProductLine::all()->where('line_name', "$array_valus")->first()->id;
        //insert_product_line_id
        $request['product_line_id'] = $product_line_id;
        $insert_product = Product::create($request);
        return $this->response(code: 201, data: $insert_product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        Gate::authorize('view', $product);
        $id = $product->id;
        $product = Product::with('productLine', 'orderdetils')->find($id);
        return $this->response(code: 200, data: $product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product, UpdateProductLineRequest $productline,UpdateProductIdRequest $product_id)
    {
        Gate::authorize('update', $product);
        $request = str_replace(' ', '', $request->validated());
        $productline = str_replace(' ', '', $productline->validated());
        $product_id=str_replace(' ', '', $product_id->validated());
        $productline = $productline['line_name'];
        $productline_id = ProductLine::all()->where('line_name', $productline)->first()->id;
        $update = DB::table('products')->where('id',$product_id['id'])->update([
            "product_image" => $request['product_image'],
            "product_name" =>  $request['product_name'],
            "product_price" => $request['product_price'],
            "quntity_stock" => $request['quntity_stock'],
            'product_line_id'=>$productline_id

        ]);
        return $this->response(code:201,data:$update);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
    public function delete(Product $product)
    {
        Gate::authorize('delete', $product);
        $delete= $product->delete();
        return $this->response(code:204);
    }
    public function deleted()
    {
        return Product::onlyTrashed()->get();
    }
    public function restore($product)
    {
        $restore= Product::where('id', $product)->restore();
        return $this->response(code:200);
    }
    public function delete_from_trash($product)
    {
        return Product::where('id', $product)->forceDelete();
    }
}
