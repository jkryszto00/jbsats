<?php declare(strict_types=1);

namespace App\Domain\User\Factory;

use App\Domain\User\Data\UserData;
use Illuminate\Support\Facades\Hash;

abstract class UserDataFactory
{
    static function fromArray(array $data): UserData
    {
        return new UserData(
            name: $data['name'],
            email: $data['email'],
            password: Hash::make($data['password'])
        );
    }
}
