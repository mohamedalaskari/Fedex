<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Branch extends Model
{

    use HasFactory,SoftDeletes, HasApiTokens;
    protected $fillable = [
        'address',
        'country_id',
        'branch_id'
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
    //relation order
    public function country() :BelongsTo{
        return $this->belongsTo(Country::class);
    }
    public function order() :HasMany{
        return $this->HasMany(order::class);
    }
    public function contact_branch() :HasMany{
        return $this->HasMany(ContactBranch::class);
    }
    public function scopeRecent($qry){
// $qry->whereYear('created_at',Carbon::now());
$qry->whereMonth('created_at',Carbon::now())->whereYear('created_at',Carbon::now());
    }
}
