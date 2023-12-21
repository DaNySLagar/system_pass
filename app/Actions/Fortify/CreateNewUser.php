<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Charge;
use App\Models\Dependence;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'ncard' => ['string', 'unique:users'],
            'charge_id' => ['required'],
            'dependence_id' => ['required'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'ncard' => $input['ncard'],
            'charge_id' => $input['charge_id'],
            'dependence_id' => $input['dependence_id'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
