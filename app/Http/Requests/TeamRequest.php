<?php

namespace ctf\Http\Requests;

use ctf\Utils\RuleValidation;
use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
            'name' => RuleValidation::nickname() . 'unique:team',
            'tag' => 'required | string | max:5',
            'avatar' => 'max:128 | required | url',
        ];
    }
}
