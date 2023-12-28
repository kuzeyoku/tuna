<?php

namespace App\Policies;

class SettingPolicy extends BasePolicy
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): bool
    {
        return in_array("settingIndex", $this->permissions, true);
    }

    public function update(): bool
    {
        return in_array("settingUpdate", $this->permissions, true);
    }
}
