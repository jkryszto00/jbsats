<?php declare(strict_types=1);

namespace App\Domain\User\Actions;

use App\Domain\User\Data\UserData;
use App\Domain\User\Models\User;

class CreateUserAction
{
    public function __invoke(UserData $userData): User
    {
        return User::create([
            'name' => $userData->name,
            'email' => $userData->email,
            'password' => $userData->password
        ]);
    }
}
