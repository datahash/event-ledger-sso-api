<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganisationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|required',
            'organisation_role_id' => 'required',
            'account_id' => 'required',
            'created_by' => 'required',
            'abn' => 'nullable',
            'address_1' => 'nullable',
            'address_2' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'postcode' => 'nullable',
            'country' => 'nullable',
            'phone' => 'nullable',
            'mobile' => 'nullable',
            'email' => 'nullable',
            'delivery_address_1' => 'nullable',
            'delivery_address_2' => 'nullable',
            'delivery_city' => 'nullable',
            'delivery_state' => 'nullable',
            'delivery_postcode' => 'nullable',
            'organisation_type_id' => 'nullable',
        ];
    }
}
