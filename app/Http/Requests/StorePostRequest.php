<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'         => 'required|string',
            'intro'         => 'required|string',
            'description'   => 'required',
            'image'         => 'image|mimes:jpeg,jpg,png|max:1024',
            'category_id'   => 'required|integer',
            'type'          => 'required',
            'is_featured'   => 'required',
            'tag_id'        => 'required',
            'status'        => 'required',
        ];
    }
}
