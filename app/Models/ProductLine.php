<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductLine extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'line_name'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

        'created_at',
        'updated_at',
        'deleted_at',

    ];
    //reltion productline
    public function product(): HasMany
    {
        return $this->HasMany(Product::class);
    }
}
