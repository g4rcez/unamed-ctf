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
        return [
            'flag' => 'string|required'
        ];
    }

    public function messages()
    {
        return [
          'flag.required' => 'Não esqueça de submeter sua flag'
        ];
    }
}
