<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class ContactType extends Model
{
    use HasFactory , SoftDeletes,HasApiTokens;
    protected $fillable = [
        'contact_type'
    ];
    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];
            //relation ContactType
            public function Contactemployee() :HasMany  {
                return $this->HasMany(ContactEmployee::class);
            }
            public function Contactcustomer() :HasMany  {
                return $this->HasMany(ContactCustomer::class);
            }
            public function Contactbranch() :HasMany  {
                return $this->HasMany(Contactbranch::class);
            }
}
