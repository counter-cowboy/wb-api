<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Apiservice_tokentypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'apiservice_id' => ['required'],
            'tokentype_id' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
