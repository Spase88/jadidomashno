<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Locations;
use App\Models\Location_cooks;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }
    public function createCooks(): View
    {
        return view('auth.register-cook');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:10'],
            'biography' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'municipality' => ['required', 'string', 'max:255'],
            'selectRole' => ['required'],
            'profile_image' => ['required', 'url'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'role_id' => $request->selectRole,
            'mobile' => $request->mobile,
            'profile_image' => $request->profile_image,
            'biography' => $request->biography,
            'password' => Hash::make($request->password),
        ]);

        $location = Locations::create([
            "user_id" => $user->id,
            "address" => $request->address,
            "municipality" => $request->municipality
        ]);

        if($request->has("pickup_instrucntions")){
            Location_cooks::create([
                "location_id" => $location->id,
                "pickup_instrucntions" => $request->pickup_instrucntions
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
