<?php

namespace App\Domain\JobOffer\Actions;

use App\Domain\JobOffer\Enums\Contract\ContractCurrency;
use App\Domain\JobOffer\Enums\Contract\ContractPer;
use App\Domain\JobOffer\Enums\Contract\ContractTime;
use App\Domain\JobOffer\Enums\Contract\ContractType;
use App\Domain\JobOffer\Enums\JobOfferLevel;
use App\Domain\JobOffer\Enums\JobOfferStatus;
use App\Domain\JobOffer\Models\JobOffer;
use App\Exceptions\CannotPublishJobOfferException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Enum;

class PublishJobOfferAction
{
    public function __invoke(JobOffer $jobOffer): JobOffer
    {
        if ($this->validate($jobOffer->toArray())) {
            throw new CannotPublishJobOfferException('Cannot publish job offer');
        }

        $jobOffer->update([
            'status' => JobOfferStatus::PUBLISHED->value,
            'expired_at' => now()->addDays(30)
        ]);

        return $jobOffer;
    }

    private function validate(array $jobOfferArray): bool
    {
        $validation = Validator::make($jobOfferArray, [
            'title' => 'required|string',
            'description' => 'required|string',
            'level' => ['required', new Enum(JobOfferLevel::class)],
            'contract' => 'required|array|min:2|max:2',
            'contract.currency' => ['required', new Enum(ContractCurrency::class)],
            'contract.time' => ['required', new Enum(ContractTime::class)],
            'salary' => 'required|array|min:1|max:3',
            'salary.*.type' => ['required', new Enum(ContractType::class)],
            'salary.*.from' => 'nullable|integer',
            'salary.*.to' => 'nullable|integer',
            'salary.*.exact' => 'nullable|integer',
            'salary.*.per' => ['required', new Enum(ContractPer::class)]
        ]);

        return $validation->fails();
    }
}
