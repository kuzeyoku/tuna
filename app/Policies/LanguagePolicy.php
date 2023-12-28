<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Language;
use App\Models\User;

class LanguagePolicy extends BasePolicy
{
    public function fileProcess(User $user)
    {
        return $user->getRole() === UserRole::ADMIN;
    }
}
