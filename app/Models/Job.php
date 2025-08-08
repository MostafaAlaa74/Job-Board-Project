<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'company_id',
        'title',
        'description',
        'type', // e.g., full-time, part-time, contract
        'status', // e.g., pending, accepted, rejected
        'salary',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }   

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
