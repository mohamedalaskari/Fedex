<?php

namespace App\Http\Controllers;

use App\Models\ProductLine;
use App\Http\Requests\StoreProductLineRequest;
use App\Http\Requests\UpdateProductLineIdRequest;
use App\Http\Requests\UpdateProductLineRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ProductLineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductLine $productLine)
    {
        Gate::authorize('viewAny',$productLine);
        $productline = $productLine->get();
        return $this->response(code: 200, data: $productline);
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
    public function store(StoreProductLineRequest $request,ProductLine $productLine)
    {
        Gate::authorize('create',$productLine);
        $request = str_replace(' ', '', $request->validated());
        $insert = ProductLine::create($request);
        return $this->response(code: 201, data: $insert);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductLine $productLine)
    {
        Gate::authorize('view',$productLine);
        $id = $productLine->id;
        $productLine = ProductLine::with('product')->find($id);
        return $this->response(code: 200, data: $productLine);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductLine $productLine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductLineRequest $request, ProductLine $productLine,UpdateProductLineIdRequest $id)
    {
        Gate::authorize('update',$productLine);
        $request = str_replace(' ', '', $request->validated());
        $id=str_replace(' ', '', $id->validated());
        $update=DB::table('product_lines')->where('id',$id['id'])->update(['line_name'=>$request['line_name']]);
        return $this->response(code:201,data:$update);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductLine $productline)
    {
        //
    }
    public function delete(ProductLine $productline)
    {
        Gate::authorize('delete',$productline);
        $delete= $productline->delete();
        return $this->response(code:204);
    }
    public function deleted()
    {
        return ProductLine::onlyTrashed()->get();
    }
    public function restore($productline)
    {
        $restore= ProductLine::where('id', $productline)->restore();
        return $this->response(code:200);
    }
    public function delete_from_trash($productline)
    {
        return ProductLine::where('id', $productline)->forceDelete();
    }
}
