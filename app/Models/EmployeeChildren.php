<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class EmployeeChildren extends Model
{
    use HasFactory, SoftDeletes,HasApiTokens;

    protected $fillable =[
      'employee_childern_image',
      'first_name',
      'last_name',
      'birth_date',
      'age',
      'password',
      'email',
      'role',
      'type',
      'employee_id',
    ];
    protected $hidden = [
      'created_at',
      'updated_at',
      'deleted_at',
  ];
    //relation employee_childrens
    public function Employee():BelongsTo{
        return $this->belongsTo(Employee::class);
    }
    protected function role():Attribute{
      return Attribute::make(
            get: fn($val) => explode(',',$val),
            set: fn($val) => implode(',',$val)
      );
    }
}
