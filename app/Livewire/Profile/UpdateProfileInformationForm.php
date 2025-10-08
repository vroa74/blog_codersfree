<?php

namespace App\Livewire\Profile;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class UpdateProfileInformationForm extends Component
{
    use InteractsWithBanner;

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * The new avatar for the user.
     *
     * @var mixed
     */
    public $photo;

    /**
     * Indicates if the application is managing profile photos.
     *
     * @var bool
     */
    public $managesProfilePhotos = false;

    /**
     * Indicates if the application is using a feature that requires email verification.
     *
     * @var bool
     */
    public $mustVerifyEmail = false;

    /**
     * Indicates if the application is confirming the user's password.
     *
     * @var bool
     */
    public $confirmingPassword = false;

    /**
     * The user's current password.
     *
     * @var string
     */
    public $password = '';

    /**
     * Determine if the application is managing profile photos.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->managesProfilePhotos = Features::managesProfilePhotos();

        $this->mustVerifyEmail = Features::optionEnabled(Features::emailVerification(), 'verify');

        $this->state = Auth::user()->withoutRelations()->toArray();

        if ($this->managesProfilePhotos) {
            $this->photo = null;
        }
    }

    /**
     * Update the user's profile information.
     *
     * @return void
     */
    public function updateProfileInformation(): void
    {
        $this->resetErrorBag();

        $this->photo
            ? $this->validate(['photo' => ['mimes:jpg,jpeg,png', 'max:1024']])
            : Validator::make($this->state, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
                'rfc' => ['nullable', 'string', 'max:14'],
                'curp' => ['nullable', 'string', 'max:22'],
                'sexo' => ['nullable', 'in:f,m'],
                'theme' => ['nullable', 'in:dark,light'],
            ])->validateWithBag('updateProfileInformation');

        if ($this->managesProfilePhotos && $this->photo) {
            Auth::user()->updateProfilePhoto($this->photo);
        }

        if ($this->mustVerifyEmail && $this->state['email'] !== Auth::user()->email) {
            $this->updateVerifiedUser();

            return;
        }

        Auth::user()->forceFill([
            'name' => $this->state['name'],
            'email' => $this->state['email'],
            'rfc' => $this->state['rfc'] ?? null,
            'curp' => $this->state['curp'] ?? null,
            'sexo' => $this->state['sexo'] ?? null,
            'theme' => $this->state['theme'] ?? 'dark',
        ])->save();

        $this->banner('Profile updated.');
    }

    /**
     * Update the given verified user's profile information.
     *
     * @return void
     */
    protected function updateVerifiedUser(): void
    {
        Auth::user()->forceFill([
            'name' => $this->state['name'],
            'email' => $this->state['email'],
            'email_verified_at' => null,
            'rfc' => $this->state['rfc'] ?? null,
            'curp' => $this->state['curp'] ?? null,
            'sexo' => $this->state['sexo'] ?? null,
            'theme' => $this->state['theme'] ?? 'dark',
        ])->save();

        Auth::user()->sendEmailVerificationNotification();

        $this->banner('Profile updated.');
    }

    /**
     * Delete user's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto(): void
    {
        if (! Features::managesProfilePhotos()) {
            return;
        }

        Auth::user()->deleteProfilePhoto();

        $this->banner('Profile photo deleted.');
    }

    /**
     * Send an email verification notification to the current user.
     *
     * @return void
     */
    public function sendEmailVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        $this->banner('A new verification link has been sent to your email address.');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('profile.update-profile-information-form');
    }
}
