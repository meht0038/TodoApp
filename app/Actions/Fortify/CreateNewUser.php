<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Church;
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
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $churchId = null;
        if ($input["radAdmin"] == true) {
            $church = new Church;
            $church->active = true;
            $church->creator = $input['email'];
            $church->address = $input['address'];
            $church->name = $input['church_name'];
            $church->description = $input['description'];
            $church->save();

            $churchId = Church::where('creator', $input['email'])->first()->id;
        }
        
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'church_id' => $churchId,
        ]);
    }
}
