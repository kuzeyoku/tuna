<?php

namespace App\Policies;

use App\Enums\UserRole;

class MessagePolicy extends BasePolicy
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): bool
    {
        return in_array("messageIndex", $this->permissions, true);
    }

    public function show(): bool
    {
        return in_array("messageShow", $this->permissions, true);
    }

    public function reply(): bool
    {
        return in_array("messageReply", $this->permissions, true);
    }

    public function sendReply(): bool
    {
        return in_array("messageReply", $this->permissions, true);
    }

    public function destroy(): bool
    {
        return in_array("messageDestroy", $this->permissions, true);
    }
}
