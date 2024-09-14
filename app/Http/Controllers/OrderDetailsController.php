<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Http\Requests\StoreOrderDetailsRequest;
use App\Http\Requests\UpdateOrderDetailsRequest;
use Illuminate\Support\Facades\Gate;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDetails $orderdetail)
    {
        Gate::authorize('viewAny',$orderdetail);
        $orderdetail = $orderdetail->get();
        return $this->response(code: 200, data: $orderdetail);
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
    public function store(StoreOrderDetailsRequest $request)
    {
//
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderDetails $orderdetail)
    {
        Gate::authorize('view',$orderdetail);
        $id = $orderdetail->id;
        $orderdetail = OrderDetails::with('product', 'order')->find($id);
        return $this->response(code: 200, data: $orderdetail);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderDetails $orderDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderDetailsRequest $request, OrderDetails $orderDetails)
    {
//
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderDetails $orderDetails)
    {
        //
    }
    public function delete(OrderDetails $orderdetail)
    {
        Gate::authorize('delete',$orderdetail);
        $delete= $orderdetail->delete();
        return $this->response(code:204);
    }
    public function deleted()
    {
        return OrderDetails::onlyTrashed()->get();
    }
    public function restore($orderdetail)
    {
        $restore= OrderDetails::where('id', $orderdetail)->restore();
        return $this->response(code:200);
    }
    public function delete_from_trash($orderdetail)
    {
        return OrderDetails::where('id', $orderdetail)->forceDelete();
    }
}
