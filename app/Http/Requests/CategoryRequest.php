<?php

namespace ctf\Http\Requests;

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
                'nome' => 'string|min:2|max:64|required|unique:categories,id,' . $this->input('id'),
                'color' => 'string|required',
                'descricao' => 'string|min:5|required|max:2048'
            ];
        }
        return [];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome é obrigatório',
            'nome.min' => 'Número mínimo de caracteres: 02',
            'nome.max' => 'Número máximo de caracteres: 64',
            'nome.unique' => 'O nome da categoria deve ser único',
            'descricao.min' => 'Número mínimo de caracteres: 05',
            'descricao.required' => 'A desscriçao é obrigatória',
            'descricao.max' => 'Número máximo de caracteres: 2048'
        ];
    }
}
