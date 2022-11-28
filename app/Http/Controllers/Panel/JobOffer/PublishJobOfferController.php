<?php

namespace App\Http\Controllers\Panel\JobOffer;

use App\Domain\JobOffer\Actions\PublishJobOfferAction;
use App\Domain\JobOffer\Exceptions\CannotPublishJobOfferException;
use App\Domain\JobOffer\Models\JobOffer;
use App\Http\Controllers\Controller;

class PublishJobOfferController extends Controller
{
    public function __invoke(JobOffer $jobOffer)
    {
        $this->authorize('update', $jobOffer);

        try {
            PublishJobOfferAction::execute($jobOffer);
            return redirect()->route('panel.posting.index');
        } catch (CannotPublishJobOfferException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
