<?php

namespace App\Policies;

use App\Enums\UserRole;

class BasePolicy
{
    protected $userRole;
    protected $permissions;

    public function __construct()
    {
        $this->userRole = auth()->user()->role;
        $this->permissions = json_decode(auth()->user()->permissions);
    }

    public function before(): ?bool
    {
        if (UserRole::ADMIN->in($this->userRole->value)) {
            return true;
        }
        return null;
    }

    public function index(): bool
    {
        return in_array("index", $this->permissions, true);
    }

    public function show(): bool
    {
        return in_array("show", $this->permissions, true);
    }

    public function create(): bool
    {
        return in_array("create", $this->permissions, true);
    }

    public function store(): bool
    {
        return in_array("store", $this->permissions, true);
    }

    public function edit(): bool
    {
        return in_array("edit", $this->permissions, true);
    }

    public function update(): bool
    {
        return in_array("update", $this->permissions, true);
    }

    public function destroy(): bool
    {
        return in_array("destroy", $this->permissions, true);
    }

    public function image(): bool
    {
        return in_array("image", $this->permissions, true);
    }

    public function imageStore(): bool
    {
        return in_array("imageStore", $this->permissions, true);
    }

    public function imageDelete(): bool
    {
        return in_array("imageDelete", $this->permissions, true);
    }

    public function imageAllDelete()
    {
        return in_array("imageAllDelete", $this->permissions, true);
    }
}
