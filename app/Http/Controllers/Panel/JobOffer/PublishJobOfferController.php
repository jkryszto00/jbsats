<?php

namespace App\Http\Controllers\Panel\JobOffer;

use App\Domain\JobOffer\Actions\PublishJobOfferAction;
use App\Domain\JobOffer\Models\JobOffer;

class PublishJobOfferController
{
    public function __invoke(JobOffer $jobOffer)
    {
        PublishJobOfferAction::execute($jobOffer);
        return redirect()->route('panel.posting.index');
    }
}
