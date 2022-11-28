<?php

namespace App\Domain\JobOffer\Actions;

use App\Domain\JobOffer\Models\JobOffer;
use Illuminate\Support\Facades\DB;

class DeleteJobOfferAction
{
    public static function execute(JobOffer $jobOffer): bool
    {
        return DB::transaction(function () use ($jobOffer) {
            $jobOffer->categories()->detach();
            $jobOffer->contract()->delete();
            $jobOffer->salaries()->delete();
            $jobOffer->applies()->delete();

            return $jobOffer->delete();
        });
    }
}
