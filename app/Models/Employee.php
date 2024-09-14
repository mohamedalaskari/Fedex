<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Model
{
    use HasFactory , SoftDeletes,HasApiTokens ;
    protected $fillable =[
      'employee_image',
      'first_name',
      'last_name',
      'birth_date',
      'age',
      'password',
      'email',
      'role',
      'job_employee_id',
      'country_id',
      'branch_id',
    ];
    protected $hidden = [
      'password',
      'created_at',
      'updated_at',
      'deleted_at',
  ];
    //relation employee
    public function EmployeeChildren() :HasMany{
       return $this->hasMany(EmployeeChildren::class);
    }
    public function contactemployee() :HasMany{
       return $this->hasMany(contactemployee::class);
    }
    public function jobEmployee() :BelongsTo{
       return $this->belongsTo(JobEmployee::class);
    }
    public function country() :BelongsTo{
       return $this->belongsTo(Country::class);
    }
    protected function role():Attribute{
      return Attribute::make(
        get: fn($val) =>explode(',',$val),
        set: fn($val) =>implode(',',$val),
      );
    }
}
