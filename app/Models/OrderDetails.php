<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetails extends Model
{
    protected $fillable=[
        'order_id',
        'product_id',
        'quntity_order',
        'price',
        'created_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',

    ];
    use HasFactory , SoftDeletes;
    //relation orderdetils
    public function product ():BelongsTo{
        return $this->belongsTo(Product::class);
    }
    public function order() :BelongsTo{
        return $this->belongsTo(Order::class);
    }
}
