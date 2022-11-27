<?php

namespace App\Domain\Apply\Models;

use App\Domain\Apply\Enums\ApplyStatus;
use App\Domain\JobOffer\Models\JobOffer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    use HasFactory;

    protected $fillable = ['job_offer_id', 'candidate_id', 'status'];

    protected $attributes = [
        'status' => ApplyStatus::APPLIED
    ];

    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when($filters['status'] ?? null, function ($query, $status) {
            match($status) {
                ApplyStatus::REJECTED => $this->scopeRejected($query),
                ApplyStatus::ACCEPTED => $this->scopeAccepted($query),
                default => $this->scopeApplied($query)
            };
        });
    }

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

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
