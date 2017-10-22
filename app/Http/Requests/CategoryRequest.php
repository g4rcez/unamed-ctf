<?php

namespace ctf\Http\Requests;

use ctf\Models\Category;
use ctf\Models\Challenge;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                'nome' => 'string|min:2|required',
                'color' => 'string|required',
                'descricao' => 'string|min:5|required'
            ];
        }
        return [];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome é obrigatório',
            'nome.min' => 'Número mínimo de caracteres: 02',
            'nome.unique' => 'O nome da categoria deve ser único',
            'descricao.min' => 'Somente letras e números para o nickname',
            'descricao.required' => 'A desscriçao é obrigatória'
        ];
    }
}
