<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
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
            'name' => 'required|unique:categories,name,'.$this->id
        ];
    }

    public function messages()
    {
        return [
          'name.required' => __('admin.category.messages.name_required'),
          'name.unique' => __('admin.category.messages.name_unique')
        ];
    }
}
