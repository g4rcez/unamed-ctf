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
                'name' => 'string | min:2 | max:64 | required | unique:categories,name,' . $this->input('name'),
                'color' => 'string|required',
                'description' => 'string|min:5|required|max:2048'
            ];
        }
        return [];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'name.min' => 'Número mínimo de caracteres: 02',
            'name.max' => 'Número máximo de caracteres: 64',
            'name.unique' => 'O nome da categoria deve ser único',
            'description.min' => 'Número mínimo de caracteres: 05',
            'description.required' => 'A desscriçao é obrigatória',
            'description.max' => 'Número máximo de caracteres: 2048'
        ];
    }
}
