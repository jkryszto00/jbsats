<?php

namespace App\Domain\Shared\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'file_name', 'mime_type', 'disk', 'collection', 'size'];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
