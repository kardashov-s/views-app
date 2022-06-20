<?php

namespace App;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserManager
{
    private ?User $user;

    public function create(string $name, string $password): User
    {
        $this->user = new User();
        $this->user->api_token = Str::random(40);
        $this->user->name = $name;
        $this->user->password = Hash::make($password);
        $this->user->save();

        return $this->user;
    }
}
