<?php

namespace App\Domain\JobOffer\Enums;

enum JobOfferStatus: string
{
    case PUBLISHED = 'published';
    case DRAFTS = 'drafts';
    case EXPIRED = 'expired';
}
