<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    public function profile()
    {
        $id = Auth::user()->id;

        $user = User::where('id', $id)->first();

        $profile = $user;

        return $profile;
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'email' => 'required|string|email|max:191|unique:users,email,' .$user->id,
            'password' => 'sometimes|min:5',
        ]);

        if (!empty($request->password)) {
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        $user->update($request->all());

        return response(null, Response::HTTP_OK);
        
    }
    public function update2(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'firstname' => ['required', 'string', 'max:191', 'regex:/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/'],
            'middlename' => ['required', 'string', 'max:191', 'regex:/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/'],
            'lastname' => ['required', 'string', 'max:191', 'regex:/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/'],
            'contact' => 'required|numeric|contact',
            'address' => 'required|string|max:191',
            'birthdate' => 'required',
            'city' => 'required',
        ]);

        $user->update($request->all());

        return response(null, Response::HTTP_OK);
    }
}
