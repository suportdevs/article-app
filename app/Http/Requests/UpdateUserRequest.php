<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $user = User::where('id', decrypt($this->route('user')))->first();
        return [
            'name'          => 'required|string',
            'username'      => [
                'required',
                'string',
                Rule::unique('users')->ignore($user->id)
            ],
            'email'         => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
            'avatar'         => 'image|mimes:jpeg,jpg,png|max:1024',
        ];
    }
}
