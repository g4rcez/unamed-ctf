<?php namespace ctf\Http\Requests;

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
                'nickname' => 'required|string|max:64|min:2|alpha_num|unique:users',
                'email' => 'required|string|email|max:128|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'avatar' => 'active_url|string|max:512|required',
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
            'nickname.alpha_num' => 'Somente letras e números para o nickname',
            'nickname.unique' => 'Já existe esse login no sistema',
            'email.email' => "Não é um email válido",
            'email.max' => "Número máximo de caracteres: 128",
            'email.unique' => "Este email já está cadastrado",
            'password.min' => "Número mínimo de caracteres: 08",
            'password.required' => "A senha é obrigatória",
        ];
    }
}
