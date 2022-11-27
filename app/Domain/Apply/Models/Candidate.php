<?php

namespace App\Domain\Apply\Models;

use App\Domain\Shared\Traits\HasMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory, HasMedia;

    protected $fillable = ['name', 'email', 'about'];

    protected function cv(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->media()->where('collection', 'cvs')->first();
            }
        );
    }

    public function apply()
    {
        return $this->hasOne(Apply::class);
    }
}
