<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
       
    use HasFactory , SoftDeletes;

    
    protected $fillable = [
        'country'
        
    ];
    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at',

    ];


    //relation country
public function branch()  {
    return $this->HasMany(Branch::class);
}
public function customer() :HasMany  {
    return $this->HasMany(customer::class); 
}
public function employee() :HasMany  {
    return $this->HasMany(Employee::class);
}
// protected function country():Attribute{
//     return Attribute::make(
//      get: fn($val) => explode(',',$val)
//     );
// }
}