<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmsSendRequest extends FormRequest
{
    /**
     * Set the attributes name
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'message' => 'Message'
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
            'message' => 'string|max:50|required',
        ];
    }
}
