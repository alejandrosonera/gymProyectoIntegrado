<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  array<string, string>  $input
     */
   public function update($user, array $input)
    {
        $isTempPassword = session('password_is_temporary');

        $rules = [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        if (!$isTempPassword) {
            $rules['current_password'] = ['required'];
        }

        Validator::make($input, $rules)->after(function ($validator) use ($input, $user, $isTempPassword) {
            if (!$isTempPassword && !Hash::check($input['current_password'], $user->password)) {
                $validator->errors()->add('current_password', __('La contraseña actual no es correcta.'));
            }
        })->validate();

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();

        session()->forget('password_is_temporary');
    }
}
