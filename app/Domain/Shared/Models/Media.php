<?php

namespace App\Domain\Shared\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'file_name', 'mime_type', 'disk', 'collection', 'size'];

    public function imageable()
    {
        return $this->morphTo();
    }
}
