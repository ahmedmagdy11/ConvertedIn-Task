<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createTask extends FormRequest
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
            "title" => ["string", "required", "min:1", "max:100"],
            "description" => ["string", "required", "min:1"],
            "assigned_to_id" => ["required", "exists:users,id"],
            "assigned_by_id" => ["required", "exists:users,id"]
        ];
    }
}
