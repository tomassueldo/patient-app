<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientUpdateRequest extends FormRequest
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
            'name' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:100',
            'phone_number' => 'nullable|string|max:16|regex:/^\d+$/',
            'document_image' => 'nullable|image|max:2048|mimes:png,jpg,jpeg',
        ];
    }


    public function messages()
    {
        return [
            'phone_number.regex' => 'The phone number must be a valid number with a maximum of 16 digits.',
            'document_image.image' => 'The document image must be a valid image file (png, jpg, jpeg) with a maximum size of 2MB.',
        ];
    }


}
