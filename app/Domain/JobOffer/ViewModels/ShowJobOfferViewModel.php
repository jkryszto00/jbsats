<?php

namespace App\Domain\JobOffer\ViewModels;

use App\Domain\JobOffer\Data\JobOfferData;
use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\Shared\ViewModels\ViewModel;

class ShowJobOfferViewModel extends ViewModel
{
    public function __construct(
        public readonly JobOffer $jobOffer
    ){}

    public function jobOffer(): JobOfferData
    {
        return JobOfferData::from($this->jobOffer->load('company', 'categories', 'contract', 'salaries'));
    }
}
