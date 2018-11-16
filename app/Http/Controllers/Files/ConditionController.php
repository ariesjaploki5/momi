<?php

namespace App\Http\Controllers\Files;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Files\Condition;
use Illuminate\Http\Response;

class ConditionController extends Controller
{

    public function index()
    {
        $conditons = Condition::paginate(10)->jsonSerialize();
        return response($conditons, Response::HTTP_OK);
    }
    
    public function archives()
    {
        $conditons = Condition::onlyTrashed()->paginate(10)->jsonSerialize();
        return response($conditons, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191', 
            'type' => 'required|string|max:191', 
        ]);

        $condition = Condition::create([
            'name' => $request['name'],
            'type' => $request['type'],
        ]);

        return response(null, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        $condition = Condition::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|string|max:191',
            'type' => 'required|string|max:191',
        ]);

        $user->update($request->all());

        return response(null, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $condition = Condition::find($id);
        $condition->delete();

        return response(null, Response::HTTP_OK);
    }

    public function restore($id)
    {
        $condition = Condition::onlyTrashed()->whereId($id)->first();
        $condition->restore();

        return response(null, Response::HTTP_OK);
    }

    public function forcedelete($id)
    {
        $condition = Condition::onlyTrashed()->whereId($id)->first();
        $condition->delete();

        return response(null, Response::HTTP_OK);
    }
    
}
