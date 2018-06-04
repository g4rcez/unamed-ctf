<?php namespace ctf\Http\Requests;

use ctf\Utils\RuleValidation;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                'nickname' => RuleValidation::nickname() . "|unique:users",
                'email' => 'required | string | email | max:128 | unique:users',
                'password' => 'required|string|min:8|confirmed',
                'avatar' => 'string | max:512 | required | url',
                'categoria_favorita' => 'string|max:64'
            ];
        }
        return [];
    }

    public function messages()
    {
        return [
            'nickname.required' => 'O nickname é obrigatório',
            'nickname.max' => 'Número máximo de caracteres: 64',
            'nickname.min' => 'Número mínimo de caracteres: 02',
            'nickname.regex' => 'Fora do padrão',
            'nickname.unique' => 'Já existe esse login no sistema',
            'email.email' => "Não é um email válido",
            'email.max' => "Número máximo de caracteres: 128",
            'email.unique' => "Este email já está cadastrado",
            'password.min' => "Número mínimo de caracteres: 08",
            'password.required' => "A senha é obrigatória",
        ];
    }
}
