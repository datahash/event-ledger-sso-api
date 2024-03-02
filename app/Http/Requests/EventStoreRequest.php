<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventStoreRequest extends FormRequest
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
            'uuid' => 'required',
            'account_id' => 'required',
            'organisation_id' => 'required',
            'created_by' => 'required',
            'message_id' => 'required',
            'message' => 'required',
            'hash_message' => 'required',
            'reference' => 'nullable',
            'topic_id' => 'nullable',
            'transaction_id' => 'nullable',
            'consensus_timestamp' => 'nullable',
        ];
    }
}
