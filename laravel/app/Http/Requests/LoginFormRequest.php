<?php

namespace App\Http\Requests;

class LoginFormRequest extends CustomFormRequest
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
            'user_email'    => 'required',
            'user_password' => 'required'
        ];
    }

    public function messages()
    {
        return [
          'user_email.required'    => 'L\'adresse email est obligatoire',
          'user_password.required' => 'Le mot de passe est obligatoire'
        ];
    }
}
