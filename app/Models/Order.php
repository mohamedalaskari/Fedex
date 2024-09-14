<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

class Order extends Model
{
    protected $fillable=[
        'user_id',
        'branch_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',

    ];
    use HasFactory ,SoftDeletes;
    //relation Order
    public function branch():BelongsTo{
        return $this->belongsTo(branch::class);
    }
    public function orderdetils():HasMany{
        return $this->HasMany(OrderDetails::class);
    }
    public function user():BelongsTo{
        return $this->BelongsTo(User::class);
    }
}
