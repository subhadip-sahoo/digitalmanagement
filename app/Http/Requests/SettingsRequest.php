<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class SettingsRequest extends Request {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'password' => 'required|confirmed|min:6',
        ];
    }

}
