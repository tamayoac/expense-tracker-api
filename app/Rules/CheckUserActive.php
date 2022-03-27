<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class CheckUserActive implements Rule
{
    public function passes($attribute, $value)
    {
        $user = User::where('email', $value)->firstOrFail();

        if (isset($user) && $user->status) {
            return true;
        }
        return false;
    }
    public function message()
    {
        return 'Account is not active.';
    }
}
