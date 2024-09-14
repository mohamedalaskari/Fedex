<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Product extends Model
{
    use HasFactory, SoftDeletes, HasApiTokens;
    protected $fillable = [
        'product_image',
        'product_name',
        'product_price',
        'quntity_stock',
        'product_line_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    //relation Product
    public function  orderdetils(): HasMany
    {
        return $this->HasMany(OrderDetails::class);
    }
    public function  productLine(): BelongsTo
    {
        return $this->BelongsTo(ProductLine::class);
    }
}
