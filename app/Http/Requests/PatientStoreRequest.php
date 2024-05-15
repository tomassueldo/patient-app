<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientStoreRequest extends FormRequest
{

    /**
     * Set the attributes name
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'address' => 'Address',
            'phone_number' => 'Phone Number',
            'document_photo' => 'Photo Of Document'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|max:50|required',
            'email' => [
                'string',
                'max:50',
                'required',
                Rule::unique('patients')->where(function ($query) {
                    return $query->where('phone_number', $this->input('phone_number'));
                }),
            ],
            'address' => 'string|max:50|required',
            'phone_number' => 'string|max:50|required',
            'document_photo.*' => 'file|max:5120|mimes:jpg,png',
        ];
    }
}
