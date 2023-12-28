<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Enums\ModuleEnum;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class UserService extends BaseService
{
    protected $folder;
    protected $route;

    public function __construct(User $user)
    {
        parent::__construct($user, ModuleEnum::User);
    }

    public function create(Object $request)
    {
        $data = new Request([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password,
            "role" => $request->role,
        ]);

        return parent::create($data);
    }

    public function update(Object $request, Model $user)
    {
        $data = new Request([
            "name" => $request->name,
            "email" => $request->email,
            "role" => $request->role,
        ]);
        if ($request->password) {
            $data->merge(["password" => $request->password]);
        }
        return parent::update($data, $user);
    }
}
