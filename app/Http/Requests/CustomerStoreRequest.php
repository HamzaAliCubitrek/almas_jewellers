<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            'order_id' => 'required',
            'name' => 'required',
            'caller_id' => 'required',
            'notes' => 'required',
            'compaign_id' => 'required',
            'contact' => 'required',
            'email' => 'required',
        ];

        // if (in_array($this->method(), ['PUT', 'PATCH'])) {
        //     $user = $this->route()->parameter('id');

        //     $rules['name'] = [
        //         'required',
        //         'string',
        //         'max:255',
        //         Rule::unique('compaign_agent_customers')->ignore($user),
        //     ];
        // }

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
