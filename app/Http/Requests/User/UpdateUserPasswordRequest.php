<?php

namespace Noah\Http\Requests\User;

use Noah\Http\Requests\User\UserRequest as Request;

class UpdateUserPasswordRequest extends Request {
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|confirmed|min:3|max:50',
        ];
    }
}
