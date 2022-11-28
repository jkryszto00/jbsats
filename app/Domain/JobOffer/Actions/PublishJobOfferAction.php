<?php

namespace App\Domain\JobOffer\Actions;

use App\Domain\JobOffer\Enums\JobOfferStatus;
use App\Domain\JobOffer\Exceptions\CannotPublishJobOfferException;
use App\Domain\JobOffer\Models\JobOffer;

class PublishJobOfferAction
{
    public static function execute(JobOffer $jobOffer): JobOffer
    {
        if ($jobOffer->status !== JobOfferStatus::DRAFTS->value) {
            throw new CannotPublishJobOfferException('Cannot publish job offer');
        }

        $jobOffer->update([
            'status' => JobOfferStatus::PUBLISHED->value,
            'expired_at' => now()->addDays(30)
        ]);

        return $jobOffer;
    }
}
