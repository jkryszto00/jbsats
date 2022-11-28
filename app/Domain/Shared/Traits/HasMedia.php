<?php

namespace App\Domain\Shared\Traits;

use App\Domain\Shared\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasMedia
{
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'imageable');
    }
}
