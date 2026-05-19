<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     *
     * @throws ValidationException
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' =>  ['required', 'string', 'max:255'],
        ])->validate();

        return User::create([
            'firstname'     =>  $input['firstname'],
            'lastname'      =>  $input['lastname'],
            'middlename'    =>  $input['middlename'],
            'gender'        =>  $input['gender'],
            'maritalstatus' =>  $input['maritalstatus'],
            'facebookurl'   =>  $input['facebookurl'],
            'youtubeurl'    =>  $input['youtubeurl'],
            'region_id'     =>  $input['region_id'],
            'province_id'   =>  $input['province_id'],
            'citymun_id'    =>  $input['citymun_id'],
            'email'         =>  $input['email'],
            'password'      => Hash::make($input['password']),
            'status'=>1
            //'birthdate'     =>  $input['birthdate'],
        ]);
    }
}
