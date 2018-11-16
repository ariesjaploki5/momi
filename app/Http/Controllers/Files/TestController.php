<?php

namespace App\Http\Controllers\Files;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Files\Test;
use Illuminate\Http\Response;

class TestController extends Controller
{

    public function index()
    {
        $tests = Test::paginate(10)->jsonSerialize();
        return response($tests, Response::HTTP_OK);
    }

    public function test2()
    {
        $tests = Test::whereSelected(1)->get()->jsonSerialize();
        return response($tests, Response::HTTP_OK);
    }

    public function test3()
    {
        $tests = Test::whereSelected(1)->select('id')->get()->jsonSerialize();
        return response($tests, Response::HTTP_OK);
    }

    public function archives()
    {
        $tests = Test::onlyTrashed()->paginate(10)->jsonSerialize();
        return response($tests, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:254',

        ]);

        $test = Test::create([
            'name' => $request['name'],
            'selected' => $request['selected'],
            
        ]);

        return response(null, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $test = Test::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|string|max:254',
            'selected' => 'sometimes',
        ]);

        $test->update($request->all());
        return response($test, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $test = Test::find($id);
        $test->delete();

        return response(null, Response::HTTP_OK);
    }

    public function restore($id)
    {
        $test = Test::onlyTrashed()->whereId($id)->first();
        $test->restore();

        return response(null, Response::HTTP_OK);
    }


}
