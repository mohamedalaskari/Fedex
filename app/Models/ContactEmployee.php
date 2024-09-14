<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class ContactEmployee extends Model
{
    use HasFactory ,SoftDeletes,HasApiTokens;
    protected $fillable = [
        'contact',
        'employee_id',
        'contact_type_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    //relation ContactEmployee
    public function Employee()  {
        return $this->belongsTo(Employee::class);
    }
    public function contact_type()  {
        return $this->belongsTo(ContactType::class);
    }
}
