<?php

namespace App\Domain\JobOffer\Models;

use App\Domain\JobOffer\Enums\JobOfferStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'title', 'description', 'level', 'contract', 'salary', 'expired_at'];

    protected $attributes = [
        'status' => JobOfferStatus::DRAFTS
    ];

    protected $casts = [
        'contract' => 'array',
        'salary' => 'array',
        'status' => 'integer',
        'expired_at' => 'datetime'
    ];

    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when($filters['title'] ?? null, function ($query, $title) {
            $query->where('title', 'like', '%'.$title.'%');
        });
    }

    public function scopePublished(Builder $query)
    {
        $query->where('status', JobOfferStatus::PUBLISHED);
    }

    public function scopeDraft(Builder $query)
    {
        $query->where('status', JobOfferStatus::DRAFTS);
    }

    public function scopeExpired(Builder $query)
    {
        $query->whereNotNull('expired_at')->where('status', JobOfferStatus::PUBLISHED);
    }
}
