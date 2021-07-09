<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name', 'document_number', 'zipcode', 'address', 'complement', 'district', 'city', 'state', 'cellular', 'email', 'status', 'picture'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'uuid', 'created_at', 'updated_at'
    ];

    public function worklogs()
    {
        return $this->hasMany(WorkLog::class, 'employee_id', 'id');
    }

}
