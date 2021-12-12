<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'unique:posts', 'max:255'],
            'published_date' => ['nullable', 'date'],
            'featured_img' => ['nullable','file','max:5000','mimes:jpg,jpeg,png'],
            'content' => ['required','string'],
            'tag[]' => ['nullable'],
            'category[]' => ['nullable']
        ];
    }
}
