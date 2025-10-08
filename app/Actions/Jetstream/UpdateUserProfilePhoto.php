<?php

namespace App\Actions\Jetstream;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfilePhoto implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input): void
    {
        \Log::info('UpdateUserProfilePhoto::update llamado', [
            'input_keys' => array_keys($input),
            'has_photo' => isset($input['photo']),
            'photo_type' => isset($input['photo']) ? get_class($input['photo']) : 'null'
        ]);
        
        $validated = validator($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'rfc' => ['nullable', 'string', 'max:14'],
            'curp' => ['nullable', 'string', 'max:22'],
            'sexo' => ['nullable', 'in:f,m'],
            'theme' => ['nullable', 'in:dark,light'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            \Log::info('Llamando a updateProfilePhoto', ['photo' => get_class($input['photo'])]);
            $user->updateProfilePhoto($input['photo']);
        } else {
            \Log::warning('No hay photo en input');
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'rfc' => $input['rfc'] ?? null,
                'curp' => $input['curp'] ?? null,
                'sexo' => $input['sexo'] ?? null,
                'theme' => $input['theme'] ?? 'dark',
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
            'rfc' => $input['rfc'] ?? null,
            'curp' => $input['curp'] ?? null,
            'sexo' => $input['sexo'] ?? null,
            'theme' => $input['theme'] ?? 'dark',
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
