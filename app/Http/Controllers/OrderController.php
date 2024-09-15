<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\StoreOrderDetailsRequest;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Branch;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Order $order)
    {
        Gate::authorize('viewAny', $order);
        $order = $order->get();
        return $this->response(code: 200, data: $order);
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
    public function store(StoreBranchRequest $branch, StoreOrderDetailsRequest $orderDetails, StoreOrderRequest $product)
    {
        $branch = str_replace(' ', '', $branch->validated());
        $branch_id = Branch::all()->where('address', $branch['address'])->first()->id;
        $product = $product->validated();
        $product = Product::all()->where('product_name', $product['product_name'])->first();

        $user = Auth::user()->id;

        $insert_order = Order::create([
            'user_id' => $user,
            'branch_id' => $branch_id
        ]);
        $orderDetails = str_replace(' ', '', $orderDetails->validated());
        $orderDetails['order_id'] = $insert_order->id;
        $orderDetails['product_id'] = $product['id'];
        $customer = Auth::user()->tokenable_type;
        $employee = Auth::user()->tokenable_type;
        $employee_children = Auth::user()->tokenable_type;
        if ($customer == "Customer") {
            $orderDetails['price'] = $product['product_price'] * $orderDetails['quntity_order'];
        } elseif ($employee == "employee") {
            $discount_employee = $product['product_price'] * $orderDetails['quntity_order'] * 0.15;
            $orderDetails['price'] = $product['product_price'] * $orderDetails['quntity_order'] - $discount_employee;
        } elseif ($employee_children == "employeeChildren") {
            $discount_employee_children = $product['product_price'] * $orderDetails['quntity_order'] * 0.10;
            $orderDetails['price'] = $product['product_price'] * $orderDetails['quntity_order'] - $discount_employee_children;
        }
        $insert_order_detalis = OrderDetails::create($orderDetails);
        $quntity = $product->quntity_stock - $orderDetails['quntity_order'];

        $update_quntity_product = DB::table('products')->where('product_name', $product['product_name'])->update(['quntity_stock' => $quntity]);
        return $this->response(code: 200, data: $insert_order_detalis);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        Gate::authorize('view', $order);
        $id = $order->id;
        $order = Order::with('orderdetils', 'user', 'branch')->find($id);
        return $this->response(code: 200, data: $order);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
    public function delete(Order $order)
    {
        Gate::authorize('delete', $order);
        $delete = $order->delete();
        return $this->response(code: 204);
    }
    public function deleted()
    {
        return Order::onlyTrashed()->get();
    }
    public function restore($order)
    {
        $restore = Order::where('id', $order)->restore();
        return $this->response(code: 200);
    }
    public function delete_from_trash($order)
    {
        return Order::where('id', $order)->forceDelete();
    }
}
