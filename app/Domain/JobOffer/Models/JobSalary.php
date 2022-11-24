<?php

namespace App\Domain\JobOffer\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSalary extends Model
{
    use HasFactory;

    protected $fillable = ['from', 'to', 'type', 'per'];

    public $timestamps = false;

    public function jobOffer()
    {
        return $this->belongsTo(JobOffer::class);
    }
}
