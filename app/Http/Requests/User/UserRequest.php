<?php

namespace Noah\Http\Requests\User;

use Noah\Http\Requests\Request;

class UserRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @author Cali
     */
    public function authorize()
    {
        return ($this->user()->id === auth()->user()->id) || $this->user()->isAdmin();
    }
}