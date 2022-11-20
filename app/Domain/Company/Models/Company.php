<?php

namespace App\Domain\Company\Models;

use App\Domain\Company\Enums\CompanyStatus;
use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\Shared\Traits\HasMedia;
use App\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory, HasMedia;

    protected $fillable = [
        'owner_id', 'name', 'description', 'founded', 'size', 'industry', 'city', 'country', 'status'
    ];

    protected $attributes = [
        'status' => CompanyStatus::DRAFT
    ];

    protected $casts = [
        'status' => 'integer'
    ];

    protected function logo(): Attribute
    {
        return Attribute::make(
            get: function () {
                $logo = $this->media()->where('collection', 'logos')->first();
                return Storage::url($logo->collection.'/'.$logo->name);
            }
        );
    }

    protected function location(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['city'].', '.$attributes['country']
        );
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function jobOffers()
    {
        return $this->hasMany(JobOffer::class);
    }
}
