<?php

namespace App\Http\Controllers\Auth;

use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Model\Users\Client;


class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'firstname' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/'],
            'middlename' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/'],
            'lastname' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/'],
            'password' => 'required|string|min:6|confirmed',
            'birthdate' => 'required',
            'contact' => 'required',
            'city' => 'required',
            'address' => 'required',

        ]);
    }


    protected function create(array $data)
    {
        $user = User::create([
            'firstname' => $data['firstname'],
            'middlename' => $data['middlename'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => 'client',
            'address' => $data['address'],
            'city' => $data['city'],
            'contact' => $data['contact'],
        ]);

        $client = Client::create([
            'user_id' => $user->id,
        ]);

        return $user;
    }
}
