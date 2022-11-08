<?php

namespace App\Domain\Company\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string',
            'founded' => 'required|numeric',
            'size' => 'required|string',
            'industry' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string'
        ];
    }
}
