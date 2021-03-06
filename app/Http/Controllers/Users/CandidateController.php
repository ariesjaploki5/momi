<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Users\Candidate;
use Illuminate\Http\Response;
use App\User;
use Illuminate\Support\Facades\Hash;

class CandidateController extends Controller
{
    public function index()
    {
        // return User::whereType('candidate')->latest()->paginate(1);
        $users = User::whereType('candidate')->paginate(10)->jsonSerialize();

        return response($users, Response::HTTP_OK);
    }

    public function archives()
    {
        $users = User::onlyTrashed()->whereType('candidate')->paginate(10)->jsonSerialize();

        return response($users, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => ['required', 'string', 'max:191', 'regex:/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/'],
            'middlename' => ['required', 'string', 'max:191', 'regex:/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/'],
            'lastname' => ['required', 'string', 'max:191', 'regex:/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/'],
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:5',
        ]);
        $user = User::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'middlename' => $request['middlename'],
            'email' => $request['email'],
            'type' => 'candidate',
            'password' => Hash::make($request['password']),
        ]);
        $candidate = Candidate::create([
            'user_id' => $user->id,
        ]);

        return response(null, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'firstname' => ['required', 'string', 'max:191', 'regex:/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/'],
            'middlename' => ['required', 'string', 'max:191', 'regex:/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/'],
            'lastname' => ['required', 'string', 'max:191', 'regex:/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/'],
            'email' => 'required|string|email|max:191|unique:users,email,' . $user->id,
            'password' => 'sometimes|min:5',
        ]);
        if (!empty($request->password)) {
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        $user->update($request->all());

        return response(null, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response(null, Response::HTTP_OK);
    }
    public function restore($id)
    {
        $user = User::onlyTrashed()->whereId($id)->first();
        $user->restore();

        return response(null, Response::HTTP_OK);
    }

    public function forcedelete($id)
    {
        $user = User::onlyTrashed()->whereId($id)->first();
        $user->forceDelete();

        return response(null, Response::HTTP_OK);
    }
}