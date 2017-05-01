<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddContentsFormRequest extends FormRequest
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
            'title' => 'required',
            'slug' => 'unique:contents,slug,'.$this->id
        ];
    }

    public function messages()
    {
        return [
            'title.required' => __('admin.contents.messages.title_required'),
            'slug.unique' => __('admin.contents.messages.slug_unique')
        ];
    }
}
