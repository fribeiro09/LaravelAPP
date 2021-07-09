<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUser extends FormRequest
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
        $id = $this->segment(3);

        $rules = [
            'name' => ['required', 'string', 'min:5', 'max:100'],
            'email' => ['required', 'string', 'email', 'min:5', 'max:100', "unique:users,email,{$id},id"],
            'password' => ['required', 'string', 'min:5', 'max:20'],
            'picture' => ['required', 'image'],
            'status' => ['required', 'in:A,I'],
        ];

        if ($this->method() == 'PUT') {
            $rules['password'] = ['nullable', 'string', 'min:5', 'max:20'];
            $rules['picture'] = ['nullable', 'image'];
        }

        return $rules;
    }
}
