<?php

namespace App\Http\Requests\api\v1\admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreService extends FormRequest
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
            "name"=>"required|unique:services,name|string",
            "description"=>"nullable|string",
            "unit_name"=>"nullable|string",
            "cost_per_unit"=>"numeric"
        ];
    }
}
