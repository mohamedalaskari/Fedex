<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
class JobEmployee extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=[
        'job_title'
    ];
    protected $hidden=[
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //relation jopemployee
    public function Employee():HasMany{
        return $this->hasMany(Employee::class);
    }
}
