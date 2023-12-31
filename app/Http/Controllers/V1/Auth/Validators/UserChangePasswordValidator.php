<?php

namespace  App\Http\Controllers\V1\Auth\Validators;


use App\Http\Validators\ValidatorBase;
use App\Supports\Message;

class UserChangePasswordValidator extends ValidatorBase
{
    protected function rules()
    {
        return [
            'password'                  => 'required|min:8',
            'new_password'              => 'bail|required|min:8',
            'password_new_confirmation' => 'bail|required',
        ];
    }

    protected function attributes()
    {
        return [
            'password'                  => Message::get("password"),
            'new_password'              => Message::get("new_password"),
            'password_new_confirmation' => Message::get("password_new_confirmation"),
        ];
    }
}