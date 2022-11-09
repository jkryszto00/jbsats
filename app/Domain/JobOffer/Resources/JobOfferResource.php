<?php

namespace App\Domain\JobOffer\Resources;

use App\Domain\JobOffer\Enums\JobOfferLevel;
use App\Domain\JobOffer\Enums\JobOfferStatus;
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
            'title' => $this->title,
            'description' => $this->description,
            'level' => JobOfferLevel::from($this->level)->text(),
            'contract' => $this->contract,
            'salary' => $this->salary,
            'status' => JobOfferStatus::from($this->status)->text(),
            'expired_at' => $this->expired_at
        ];
    }
}
