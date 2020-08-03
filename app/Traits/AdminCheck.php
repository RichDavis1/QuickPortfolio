<?php

namespace App\Traits;

use App\User;

trait AdminCheck
{
    /**
     * Redirect 403 if not admin.
     *
     * @param \App\User|null $user
     */
    public function adminCheck(?User $user) : void
    {
        if (!$user instanceof User || !$user->isAdmin()) {
            header('HTTP/1.0 403 Forbidden', true, 403);
            exit();
        }
    }
}
