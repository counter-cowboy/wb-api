<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TokenRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'apiservice_id' => ['required', 'integer'],
            'token_type_id' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
