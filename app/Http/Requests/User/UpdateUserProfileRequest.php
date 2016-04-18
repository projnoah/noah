<?php

namespace Noah\Http\Requests\User;

use Noah\Http\Requests\User\UserRequest as Request;

class UpdateUserProfileRequest extends Request {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @author Cali
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:users,username,' . $this->user()->id,
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,' . $this->user()->id
        ];
    }
}
