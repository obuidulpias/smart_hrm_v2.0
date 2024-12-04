<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    protected $fillable = [
        'card_number',
        'punch_number',
        'name',
        'email',
        'phone_number',
        'father_name',
        'mother_name',
        'gender',
        'birth_date',
        'nid',
        'company_id',
        'location_id',
        'department_id',
        'designation_id',
        'joining_date',
        'gross_salary',
        'status',
        'is_deleted',
        'created_by',
        'updated_by',
    ];

    public function user_phone(): HasMany
    {
        return $this->HasMany(User::class, 'emp_code', 'id');
    }

}
