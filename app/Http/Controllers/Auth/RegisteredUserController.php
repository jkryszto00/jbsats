<?php

namespace App\Http\Controllers\Auth;

use App\Domain\User\Actions\CreateUserAction;
use App\Domain\User\Factory\UserDataFactory;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $isEmployer = request()->get('as') == 'employer';

        return Inertia::render('Auth/Register', [
            'isEmployer' => $isEmployer
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, CreateUserAction $createUserAction)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'is_employer' => 'required|boolean'
        ]);

        $userData = UserDataFactory::fromArray($validated);
        $user = $createUserAction($userData);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::redirectUser());
    }
}
