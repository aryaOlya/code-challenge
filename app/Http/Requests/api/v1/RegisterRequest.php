<?php

namespace App\Http\Requests\api\v1;

use App\Http\Controllers\api\v1\ApiController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|unique:users,name",
            "phone_number" => "required|unique:users,phone_number",
            "password" => "required|string",
            "passConf" => "required|same:password"
        ];
    }

}
