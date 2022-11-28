<?php

namespace App\Domain\JobOffer\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobContract extends Model
{
    use HasFactory;

    protected $fillable = ['time', 'currency'];

    public $timestamps = false;

    public function jobOffer(): BelongsTo
    {
        return $this->belongsTo(JobOffer::class);
    }
}
