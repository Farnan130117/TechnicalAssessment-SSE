<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id', 'name', 'email', 'department_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }


    public function employeeDetail()
    {
        return $this->hasOne(EmployeeDetail::class, 'employee_id', 'id');
    }

}
