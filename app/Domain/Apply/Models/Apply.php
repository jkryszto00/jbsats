<?php

namespace App\Domain\Apply\Models;

use App\Domain\Apply\Enums\ApplyStatus;
use App\Domain\JobOffer\Enums\JobOfferStatus;
use App\Domain\JobOffer\Models\JobOffer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    use HasFactory;

    protected $fillable = ['job_offer_id', 'candidate', 'status'];

    protected $attributes = [
        'status' => ApplyStatus::APPLIED
    ];

    protected $casts = [
        'candidate' => 'array',
        'status' => ApplyStatus::class
    ];

    public function scopeRejected(Builder $query)
    {
        $query->where('status', ApplyStatus::REJECTED);
    }

    public function scopeApplied(Builder $query)
    {
        $query->where('status', ApplyStatus::APPLIED);
    }

    public function scopeAccepted(Builder $query)
    {
        $query->where('status', ApplyStatus::ACCEPTED);
    }

    public function jobOffer()
    {
        return $this->belongsTo(JobOffer::class);
    }
}
