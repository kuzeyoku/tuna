<?php

namespace App\Policies;

use App\Enums\UserRole;

class UserPolicy
{

    public function before()
    {
        if (auth()->user()->role === UserRole::ADMIN) {
            return true;
        }
        return false;
    }

    public function index()
    {
        return $this->before();
    }

    public function create()
    {
        return $this->before();
    }

    public function store()
    {
        return $this->before();
    }

    public function edit()
    {
        return $this->before();
    }

    public function update()
    {
        return $this->before();
    }

    public function destroy()
    {
        return $this->before();
    }
}
