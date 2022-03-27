<?php

namespace App\Listeners;

class RevokeExistingTokens
{
    public function handle($event)
    {
        $latest = auth()->user()->tokens()->latest()->first();

        auth()->user()->tokens()
            ->where('created_at', '<', $latest->created_at)
            ->delete();
    }
}
