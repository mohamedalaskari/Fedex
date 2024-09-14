<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class ContactBranch extends Model
{

    use HasFactory, SoftDeletes, HasApiTokens;
    protected $fillable = [
        'contact',
        'branch_id',
        'contact_type_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    //relation branch
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
    public function contact_type(): BelongsTo
    {
        return $this->belongsTo(ContactType::class);
    }
}
