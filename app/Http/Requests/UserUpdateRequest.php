<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $id=$this->user;

        return [
            'pseudo'=>'required|max:255|unique:users,pseudo,' . $id,
            'email'=>'required|email|max:255|unique:users,email,' . $id
        ];
    }
}
