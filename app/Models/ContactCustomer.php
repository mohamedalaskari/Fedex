<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactCustomer extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = [
        'contact',
        'customer_id',
        'contact_type_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    //relation contactuser
    public function customer()  {
        return $this->belongsTo(customer::class);
    }
    public function contact_type()  {
        return $this->belongsTo(ContactType::class);
    }
}
