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
        return [
            'nickname' => 'required|string|max:64|min:3|alpha_num|unique:users',
            'email' => 'required|string|email|max:128|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
//        if($this->isMethod('put')) {
//            return [
//                'nickname' => 'required|string|max:64|alpha_num|unique:users',
//                'email' => 'required|string|email|max:128|unique:users',
//                'password' => 'required|string|min:8|confirmed',
//            ];
//        }else if($this->isMethod('post')){
//            return [
//                'nickname' => 'required|string|max:64|alpha_num|unique:users',
//                'email' => 'required|string|email|max:128|unique:users',
//                'password' => 'required|string|min:8|confirmed',
//            ];
//        }
    }

    public function messages()
    {
        return [
            'nickname.required' => 'O nickname é obrigatório',
            'nickname.max' => 'Número máximo de caracteres: 64',
            'nickname.min' => 'Número mínimo de caracteres: 03',
            'nickname.alpha_num' => 'Somente letras e números para o nickname',
            'nickname.unique' => 'Já existe esse login no sistema'
        ];
    }
}
