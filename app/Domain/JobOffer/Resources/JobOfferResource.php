<?php

namespace App\Domain\JobOffer\Resources;

use App\Domain\Company\Resources\CompanyResource;
use App\Domain\JobOffer\Enums\JobOfferLevel;
use App\Domain\JobOffer\Enums\JobOfferStatus;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class JobOfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'company' => new CompanyResource($this->whenLoaded('company')),
            'title' => $this->title,
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'description' => $this->description,
            'level' => [
                'name' => JobOfferLevel::from($this->level)->text(),
                'value' => JobOfferLevel::from($this->level)->value
            ],
            'contract' => $this->contract,
            'salary' => $this->salary,
            'status' => JobOfferStatus::from($this->status)->text(),
            'expired_at' => (new Carbon($this->expired_at))->toFormattedDateString()
        ];
    }
}
