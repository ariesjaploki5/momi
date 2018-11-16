<?php

namespace App\Http\Controllers\Files;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Files\Question;
use Illuminate\Http\Response;

class QuestionController extends Controller
{

    public function index()
    {
        $questions = Question::latest()->paginate(10)->jsonSerialize();
        return response($questions, Response::HTTP_OK);
    }

    public function archives()
    {
        $questions = Question::onlyTrashed()->paginate(10)->jsonSerialize();
        
        return response($questions, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required|string|max:254',
            
        ]);

        $question = Question::create([
            'text' => $request['text'],
            'selected' => $request['selected'],
        ]);

        return response(null, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $this->validate($request, [
            'text' => 'required|string|max:254',
            'selected' => 'sometimes',
        ]);

        $question->update($request->all());
        return response($question, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $question = Question::find($id);
        $question->delete();

        return response($question, Response::HTTP_OK);
    }

    public function restore($id)
    {
        $question = Question::onlyTrashed()->whereId($id)->first();
        $question->restore();

        return response($question, Response::HTTP_OK);
    }

    public function forcedelete($id)
    {
        $question = Question::onlyTrashed()->whereId($id)->first();
        $question->delete();

        return response(null, Response::HTTP_OK);
    }


    public function selectedquestion()
    {
        $question = Question::whereSelected(1)->get();

        return response()->json($question);
    }
}
