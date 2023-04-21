<?php

namespace App\Http\Requests\api\v1\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateService extends FormRequest
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
            "name"=>['required','string',Rule::unique("services","name")->ignore($this->id)],
            "description"=>"nullable|string",
            "unit_name"=>"nullable|string",
            "cost_per_unit"=>"numeric"
        ];
    }
}
