<?php

namespace App\Http\Controllers\Panel\JobOffer;

use App\Domain\JobOffer\Actions\DeleteJobOfferAction;
use App\Domain\JobOffer\Models\JobOffer;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class DeleteJobOfferController extends Controller
{
    public function __invoke(JobOffer $jobOffer, DeleteJobOfferAction $deleteJobOfferAction): RedirectResponse
    {
        if ($deleteJobOfferAction($jobOffer)) {
            abort(500);
        }

        return redirect()->route('panel.posting.index');
    }
}
