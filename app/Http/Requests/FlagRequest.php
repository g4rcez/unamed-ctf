<?php

namespace ctf\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlagRequest extends FormRequest
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
        if (explode('@', $this->route()->action['uses'])['1'] == 'submitFlag') {
            return [
                'flag' => 'string|required'
            ];
        } else if (explode('@', $this->route()->action['uses'])['1'] == 'submitFlagWithName') {
            return [
                'flag' => 'string | required',
                'nome' => 'string|required'
            ];
        }
        return [];
    }

    public function messages()
    {
        return [
            'flag.required' => 'Não esqueça de submeter sua flag'
        ];
    }
}
