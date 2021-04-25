<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use UserValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, $this->userRules())->validate();

        return User::create([
            'first_name'  => $input['first_name'],
            'last_name'   => $input['last_name'],
            'email'       => $input['email'],
            'password'    => Hash::make($input['password']),
            'district_id' => $input['district'],
        ]);
    }
}
