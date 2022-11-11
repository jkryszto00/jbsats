<?php

namespace App\Http\Requests;

use App\Domain\JobOffer\Enums\Contract\ContractCurrency;
use App\Domain\JobOffer\Enums\Contract\ContractPer;
use App\Domain\JobOffer\Enums\Contract\ContractTime;
use App\Domain\JobOffer\Enums\Contract\ContractType;
use App\Domain\JobOffer\Enums\JobOfferLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateJobOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|array|min:1',
            'category.*' => 'required|exists:categories,id',
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
        ];
    }
}
