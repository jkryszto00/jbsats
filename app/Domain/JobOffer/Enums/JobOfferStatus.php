<?php

namespace App\Domain\JobOffer\Enums;

enum JobOfferStatus: int
{
    case PUBLISHED = 1;
    case DRAFTS = 2;

    public function text(): string
    {
        return match($this) {
            self::PUBLISHED => 'published',
            self::DRAFTS => 'drafts'
        };
    }
}
