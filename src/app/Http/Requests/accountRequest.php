<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class accountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'company_id' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
