<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class CheckIsClient implements Rule
{
    public function passes($attribute, $value)
    {
        $user = User::where('email', $value)->firstOrFail();

        if ($user->roles()->first()->id != 3) {
            return false;
        }
        return true;
    }
    public function message()
    {
        return 'Unauthorized';
    }
}
