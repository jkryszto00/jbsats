<?php

namespace App\Domain\JobOffer\Models;

use App\Domain\Apply\Models\Apply;
use App\Domain\Company\Models\Company;
use App\Domain\JobOffer\Enums\JobOfferLevel;
use App\Domain\JobOffer\Enums\JobOfferStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'title', 'description', 'level', 'status', 'expired_at'];

    protected $attributes = [
        'status' => JobOfferStatus::DRAFTS
    ];

    protected $casts = [
        'expired_at' => 'datetime'
    ];

    protected function level(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => [
                'name' => JobOfferLevel::tryFrom($attributes['level'])->text(),
                'value' => JobOfferLevel::tryFrom($attributes['level'])->value
            ],
            set: fn ($level, $attributes) => $level['value']
        );
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'job_offer_category');
    }

    public function contract()
    {
        return $this->hasOne(JobContract::class);
    }

    public function salaries()
    {
        return $this->hasMany(JobSalary::class);
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
                JobOfferStatus::PUBLISHED => $this->scopePublished($query),
                JobOfferStatus::DRAFTS => $this->scopeDrafts($query),
                default => null
            };
        })->when($filters['level'] ?? null, function ($query, $level) {
            $query->whereIn('level', $level);
        })->when($filters['type'] ?? null, function ($query, $type) {
            $query->whereHas('salaries', function ($query) use ($type) {
               $query->whereIn('type', $type);
            });
        });
    }

    public function scopePublished(Builder $query)
    {
        $query->where('status', JobOfferStatus::PUBLISHED);
    }

    public function scopeDrafts(Builder $query)
    {
        $query->where('status', JobOfferStatus::DRAFTS);
    }

    public function scopeExpired(Builder $query)
    {
        $query->whereNotNull('expired_at')->where('status', JobOfferStatus::PUBLISHED);
    }
}
