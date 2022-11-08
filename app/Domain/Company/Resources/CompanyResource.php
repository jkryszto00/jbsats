<?php

namespace App\Domain\Company\Resources;

use App\Domain\Company\Enums\CompanyStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'founded' => $this->founded,
            'size' => $this->size,
            'industry' => $this->industry,
            'location' => $this->when($request->route()->getName() != 'panel.company.edit', $this->location),
            'city' => $this->when($request->route()->getName() == 'panel.company.edit', $this->city),
            'country' => $this->when($request->route()->getName() == 'panel.company.edit', $this->country),
            'status' => CompanyStatus::from($this->status)->text()
        ];
    }
}
