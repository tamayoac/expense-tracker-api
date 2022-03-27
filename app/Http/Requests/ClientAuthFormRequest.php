<?php

namespace App\Http\Requests;

use App\Rules\CheckIsClient;
use App\Rules\CheckUserActive;
use Illuminate\Foundation\Http\FormRequest;

class ClientAuthFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "email" => ["required", "email", new CheckUserActive, new CheckIsClient],
            "password" => "required"
        ];
    }
}
