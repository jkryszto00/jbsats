<?php

namespace App\Domain\Shared\Traits;

use App\Domain\Shared\Models\Media;

trait HasMedia
{
    public function media()
    {
        return $this->morphMany(Media::class, 'imageable');
    }
}
