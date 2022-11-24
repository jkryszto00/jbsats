<?php declare(strict_types=1);

namespace App\Domain\User\Actions;

use App\Domain\User\Data\UserData;
use App\Domain\User\Mail\UserCreated;
use App\Domain\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CreateUserAction
{
    public function __invoke(UserData $userData): User
    {
        $user = User::create([
            'name' => $userData->name,
            'email' => $userData->email,
            'password' => Hash::make($userData->password),
            'is_employer' => $userData->is_employer,
        ]);

        if ($user) {
            $this->sendMail($user);
        }

        return $user;
    }

    private function sendMail(User $user): void
    {
        Mail::to($user->email)->send(new UserCreated($user->name));
    }
}
