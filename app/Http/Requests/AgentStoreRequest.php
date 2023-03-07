<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AgentStoreRequest extends FormRequest
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
            'name' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'password' => 'required_if:id,==,null|same:confirm_password',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $user = $this->route()->parameter('id');

            $rules['name'] = [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user),
            ];
        }

    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'contact.required' => 'Contact is required!',
            'email.required' => 'Email is required!',
            // 'user_name.required' => 'Username is required!',
        ];
    }
}
