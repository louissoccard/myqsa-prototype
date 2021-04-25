<?php

namespace App\Actions\Fortify;

use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;

trait UserValidationRules
{
    /**
     * Get the validation rules used to validate users.
     *
     * @return array
     */
    protected function userRules($exceptIdForEmail = null)
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'   => ['required', 'string', new Password, 'confirmed'],
            'district'   => ['required', 'exists:districts,id'],
        ];

        if ($exceptIdForEmail !== null) {
            $rules['email'] = [
                'required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($exceptIdForEmail)
            ];
        }

        return $rules;
    }
}
