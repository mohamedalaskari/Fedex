<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;


class Customer extends Model
{
    use HasFactory ,SoftDeletes,HasApiTokens;
    protected $fillable = [
        'first_name',
        'last_name',
        'customer_image',
        'birth_date',
        'age',
        'email',
        'password',
        'role',
        'type',
        'country_id',
    ];
protected $hidden = [
    'created_at',
    'updated_at',
    'deleted_at',
];
public function ContactCustomer() :HasMany{
    return $this->hasMany(ContactCustomer::class);
  }
  public function country() :BelongsTo{
    return $this->BelongsTo(Country::class);
  }
  protected function role():Attribute{
    return Attribute::make(
          get: fn($val) => explode(',',$val),
          set: fn($val) => implode(',',$val)
    );
  }

}
