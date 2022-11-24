<?php

namespace App\Domain\JobOffer\Models;

use App\Domain\Apply\Models\Apply;
use App\Domain\Company\Models\Company;
use App\Domain\JobOffer\Enums\JobOfferStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'title', 'description', 'level', 'contract', 'salary', 'status', 'expired_at'];

    protected $attributes = [
        'status' => JobOfferStatus::DRAFTS
    ];

    protected $casts = [
        'contract' => 'array',
        'salary' => 'array',
        'status' => 'integer',
        'expired_at' => 'datetime'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'job_offer_category');
    }

    public function applies()
    {
        return $this->hasMany(Apply::class);
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when($filters['title'] ?? null, function ($query, $title) {
            $query->where('title', 'like', '%' . $title . '%');
        })->when($filters['category'] ?? null, function ($query, $category) {
            $query->whereHas('categories', function ($query) use ($category) {
                $query->whereIn('name', $category);
            });
        })->when($filters['status'] ?? null, function ($query, $status) {
            match($status) {
                JobOfferStatus::PUBLISHED->text() => $this->scopePublished($query),
                JobOfferStatus::DRAFTS->text() => $this->scopeDraft($query),
                default => null
            };
        })->when($filters['level'] ?? null, function ($query, $level) {
            $query->whereIn('level', $level);
        })->when($filters['contract'] ?? null, function ($query, $contract) {
            $query->where(function ($query) use ($contract) {
               foreach ($contract as $c) {
                   $query->orWhereJsonContains('salary', ['type' => $c]);
               }
            });
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
