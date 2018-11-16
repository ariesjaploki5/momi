<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Model\Screening;
use App\Model\Users\Client;
use App\Model\Users\Donor;
use App\Model\Users\Doctor;
use App\Model\Users\Nurse;
use App\Model\Files\Test;
use App\Model\Users\Disapproved;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use DB;

use App\Notifications\Approval;

class ScreeningController extends Controller
{

    public function index()
    {
        $screenings = Screening::with([
            'tests',
            'questions',
            'client.user',
            'doctor.user'
        ])
        ->whereMedical_test(0)
        ->whereApproved_for_medical_test(0)
        ->paginate(10)
        ->jsonSerialize();

        return response($screenings, Response::HTTP_OK);
    }
    public function approvedlist()
    {
        $screenings = Screening::with([
            'tests',
            'questions',
            'client.user',
            'doctor.user',
        ])->whereApproved_for_medical_test(1)->paginate(10)->jsonSerialize();

        return response($screenings, Response::HTTP_OK);
    }
    public function disapprovedlist()
    {
        $screenings = Screening::with([
            'tests',
            'questions',
            'client.user'
        ])->whereApproved_for_medical_test(2)->paginate(10)->jsonSerialize();

        return response($screenings, Response::HTTP_OK);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        
        

        $user = Auth::user();
        $user_id = $user->client->id; 


        $this->validate($request, [
            'child_firstname' => 'required|string|max:191',
            'child_lastname' => 'required|string|max:191',
            'birthdate' => 'required',
            'gender' => 'required',
            // 'reason_why' => 'required',
        ]);

        $screening = Screening::create([
            'child_firstname' => $request['child_firstname'],
            'child_lastname' => $request['child_lastname'],
            'birthdate' => $request['birthdate'],
            'gender' => $request['gender'],
            'client_id' => $user_id,
            'reason_why' => $request['reason_why'],
        ]);

        foreach ($request->answer as $a) {
            $qa = explode(" ", $a);
            $answer = $qa[0];
            $question_id = $qa[1];
            $screening->questions()->attach(
                $screening->id,
                ['question_id' => $question_id, 'answer' => $answer]
            );
        }

        if ($screening) {
            toast('Request Submitted Successfully', 'success', 'top-right');
            return redirect('clienthome');
        }

        
    }

    public function store2(Request $request)
    {


        $user = Auth::user();
        $user_id = $user->client->id;


        $this->validate($request, [
            'child_firstname' => 'required|string|max:191',
            'child_lastname' => 'required|string|max:191',
            'birthdate' => 'required',
            'gender' => 'required',
        ]);

        $screening = Screening::create([
            'child_firstname' => $request['child_firstname'],
            'child_lastname' => $request['child_lastname'],
            'birthdate' => $request['birthdate'],
            'gender' => $request['gender'],
            'client_id' => $user_id,
        ]);
        
        foreach ($request->answer as $a) {
            $qa = explode(" ", $a);
            $answer = $qa[0];
            $question_id = $qa[1];
            $screening->questions()->attach(
                $screening->id,
                ['question_id' => $question_id, 'answer' => $answer]
            );
        }

        $count = DB::table('question_screening')
        ->join('questions', 'question_screening.question_id', '=', 'questions.id')
        ->where('screening_id', $screening->id)
        ->where('answer', '<>', 'questions.correct')
        ->count();

        if($count > 0){
            $screening->approved_to_donate = 2;
            $screening->approved_for_medical_test = 0;

        } 
        else{
            $screening->approved_for_medical_test = 1;
        }
        $screening->save();

        return response(null, Response::HTTP_CREATED);
    }

    public function countwrongquestion()
    {
        $screening = Screening::where('client_id', Auth::user()->client->id)
        ->orderBy('id', 'desc')->first();

        $count = Screening::with('question')
        ->where('id', $screening->id)
        ->where('question_screening.answer', '<>', 'question.correct')
        ->count();

        return response($count, Response::HTTP_OK);
    }

    public function countwrongmedtest()
    {
        $screening = Screening::where('client_id', Auth::user()->client->id)
        ->orderBy('id', 'desc')
        ->first();

        $count = Screening::with('test')
        ->where('id', $screening->id)
        ->where('screening_test.answer', '<>', 'test.correct')
        ->count();

        return response($count, Response::HTTP_OK);
    }

    public function approved(Request $request, $id)
    {
       
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $user_type = Auth::user()->type;

        $screening = Screening::findOrFail($id);

        $screening->approved_for_medical_test = 1;
        
       

        if ($user_type == 'doctor') {
            $doctor = Doctor::whereUser_id($user_id)->first();
            $screening->doctor_id = $doctor->id;
        }
        else {
            $nurse = Nurse::whereUser_id($user_id)->first();
            $screening->nurse_id = $nurse->id;
        }

        $screening->save();
        $client = client::where('id', $screening->client_id)->first();
        $client_user = User::where('id', $client->user_id)->first();
        $donor = new Donor;
        $donor->user_id = $client_user->id;
        $donor->save();

        // $usernotify = User::find($donor->user_id);
        // Notification::send($usernotify->notify(new Approval()));

        return response(null, Response::HTTP_CREATED);
    }

    public function disapproved(Request $request, $id)
    {
        $schedule = Carbon::now();
        
        $screening = Screening::findOrFail($id);
        // $screening->schedule = $schedule;
        $screening->approved_for_medical_test = 2;
        $screening->save();

        $donor = Disapproved::create([
            'user_id' => $screening->client_id,
        ]);

        return response(null, Response::HTTP_CREATED);
    }
    
    public function schedule(Request $request, $id)
    {

        $schedule = Screening::findOrFail($id);
        $schedule->start_time = "".$request->date." ".$request->starting_hour .":".$request->starting_minute.":00";
        $schedule->finish_time = "".$request->date." ".$request->finish_hour .":".$request->finish_minute.":00";
        $schedule->update();

        return response(null, Response::HTTP_OK);
    }

    public function schedulelist()
    {
        $screenings = Screening::with([
            'tests',
            'questions',
            'client.user'
            
        ])
        ->whereApproved_for_medical_test(1)
        ->paginate(10)
        ->jsonSerialize();

        return response($screenings, Response::HTTP_OK);
    }
    public function show($id)
    {
        
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        $test = Screening::findOrFail($id);

        $this->validate($request, [
            'child_firstname' => 'required|string|max:191',
            'child_lastname' => 'required|string|max:191',
            'birthdate' => 'required',
            'gender' => 'required',
        ]);

        $test->update($request->all());

        return ['message' => 'Updated the Donor Screening'];
    }

    public function destroy($id)
    {
        
    }

    public function medtestshow($id)
    {
        $screening = Screening::findOrFail($id);

        $tests = Test::whereSelected(1)->get();

        return view('pages.medtestshow', compact('screening', 'tests'));
    }

    public function medtest(Request $request)
    {


        $screening = Screening::findOrFail($request->screening_id);

        $screening->medical_test = 1;

        $screening->update();

        foreach ($request->tests as $id) {
            $screening->tests()->attach(
                $screening->id,
                ['test_id' => $id, 'result' => $request->results[$id]]
            );
        }
    
        if ($screening) {
            toast('Medical Test Successfully Submitted', 'success', 'top-right');
            return redirect('screenings');
        }
    }

    public function medtest2(Request $request)
    {
        $screening = Screening::findOrFail($request->screening_id);
        $screening->medical_test = 1;
        $screening->update();

        foreach ($request->results as $r) {
            $tr = explode(" ", $r);
            $result = $tr[0];
            $test_id = $tr[1];
            $screening->tests()->attach(
                $screening->id,
            ['test_id' => $test_id, 'result' => $result]
            );
        }

        $count = DB::table('screening_test')
        ->join('tests', 'screening_test.test_id', '=', 'tests.id')
        ->where('screening_id', $screening->id)
        ->where('result', '<>', 'tests.correct')
        ->count();

        
        if($count > 0){
            $screening->approved_to_donate = 0;

        } 
        else{
            $screening->approved_to_donate = 1;
            $donor = new Donor;
            $donor->user_id = $screening->client->user_id;
            $donor->save();
        }
        $screening->save();
        
        return response(null, Response::HTTP_OK);
    }



    public function check_approved_for_medical_test()
    {
        $client_id = Auth::user()->client->id;

        $screening = Screening::where('client_id', $client_id)->orderBy('id', 'desc')->first();

        if($screening->approved_for_medical_test === 1){
            $screening_approved_for_medical_test = 1;
        }else{
            $screening_approved_for_medical_test = 0;
        }

        return response($screening_approved_for_medical_test, Response::HTTP_OK);
    }

    public function checkmedtest()
    {
        $client_id = Auth::user()->client->id;
        $screening = Screening::where('client_id', $client_id)->orderBy('id', 'desc')->first();

        if($screening->medical_test === 1){
            $screening_medical_test = 1;
        }else{
            $screening_medical_test = 0;
        }

        return response($screening_medical_test, Response::HTTP_OK);
    }

    public function loadschedule()
    {
        $client_id = Auth::user()->client->id;
        $screening = Screening::where('client_id', $client_id)->orderBy('id', 'desc')->first();
        
        return response($screening, Response::HTTP_OK);
    }

    public function check_approved_to_donate()
    {
        $client_id = Auth::user()->client->id;
        $screening = Screening::where('client_id', $client_id)->orderBy('id', 'desc')->first();

        if($screening->approved_to_donate === 0){
            $screening_approved_to_donate = 0;
        }
        if ($screening->approved_to_donate === 1) {
            $screening_approved_to_donate = 1;
        }
        if ($screening->approved_to_donate === 2) {
            $screening_approved_to_donate = 2;
        }


        return response($screening_approved_to_donate, Response::HTTP_OK);
    }
}
