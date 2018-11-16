<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Model\Users\Admin;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        // return User::whereType('admin')->latest()->paginate(1);
        $users = User::whereType('admin')->paginate(10)->jsonSerialize();

        return response($users, Response::HTTP_OK);
    }

    public function archives()
    {
        $users = User::onlyTrashed()->whereType('admin')->paginate(10)->jsonSerialize();

        return response($users, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|string|max:191',
            'lastname' => 'required|string|max:191',
            'middlename' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:5',
        ]);
        $user = User::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'middlename' => $request['middlename'],
            'email' => $request['email'],
            'type' => 'admin',
            'password' => Hash::make($request['password']),
        ]);
        $admin = admin::create([
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
            'firstname' => 'required|string|max:191',
            'lastname' => 'required|string|max:191',
            'middlename' => 'sometimes|string|max:191',
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
