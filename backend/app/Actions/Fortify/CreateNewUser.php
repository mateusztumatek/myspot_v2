<?php

namespace App\Actions\Fortify;

use App\Consts\Locale;
use App\Consts\UserSource;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

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
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'source' => [Rule::in(UserSource::values()), 'nullable'],
            'locale' => [Rule::in(Locale::values()) , 'nullable'],
            'avatar' => ['url', 'nullable']
        ])->validate();


        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'source' => $input['source'] ?? UserSource::DEFAULT->value,
            'uuid' => Str::uuid(),
            'locale' => ($locale = Arr::get($input, 'locale'))? $locale : app()->getLocale(),
        ]);

        if($avatar_url = Arr::get($input, 'avatar')) $user->addMediaFromUrl($avatar_url)->toMediaCollection('avatar');
        return $user;
    }
}
