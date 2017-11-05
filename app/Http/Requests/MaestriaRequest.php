<?php

namespace ctf\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class MaestriaRequest extends FormRequest
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
        if ($this->method() == 'POST') {
            return [
                'maestria' => 'string|min:2|required',
            ];
        }
        return [];

    }

    public function messages()
    {
        return [
            'maestria.required' => 'O nome é obrigatório',
            'maestria.min' => 'Número mínimo de caracteres: 02',
            'maestria.unique' => 'O nome da maestria deve ser único',
        ];
    }
}
