<?php

namespace App\Domain\JobOffer\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobSalary extends Model
{
    use HasFactory;

    protected $fillable = ['from', 'to', 'type', 'per'];

    public $timestamps = false;

    public function jobOffer(): BelongsTo
    {
        return $this->belongsTo(JobOffer::class);
    }
}
