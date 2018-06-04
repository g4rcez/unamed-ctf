<?php

namespace ctf\Http\Requests;

use ctf\Utils\RuleValidation;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed maestrias
 */
class ChallsRequest extends FormRequest
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
            'name' => 'string | min:2 | max:64 | required | unique:categories,id,'.$this->input('id'),
            'flag' => 'string',
            'author' => RuleValidation::nickname(),
            'points' => 'string',
            'description' => 'string',
            'categories_id' => '',
        ];
    }
}
