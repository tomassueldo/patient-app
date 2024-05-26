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
            'document_image' => 'Image Of Document'
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
            'email' => 'string|max:50|required|unique:App\Models\Patient,email',
            'address' => 'string|max:100|required',
            'phone_number' => 'required|string|max:16|regex:/^\d+$/',
            'document_image' => 'required|image|max:2048|mimes:png,jpg,jpeg'
        ];
    }

    public function messages()
    {
        return [
            'phone_number.regex' => 'The phone number must be a valid number with a maximum of 16 digits.',
            'document_image.image' => 'The document image must be a valid image file (png, jpg, jpeg) with a maximum size of 2MB.'
        ];
    }

}
