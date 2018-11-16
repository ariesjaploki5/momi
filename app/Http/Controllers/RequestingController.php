<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Model\Requesting;
use App\Model\Users\Recipient;
use App\Model\Users\Client;
use App\Model\Users\Doctor;
use App\Model\Users\Nurse;
use App\Model\Users\Disapproved;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;

class RequestingController extends Controller
{
    public function index()
    {
        $requestings = Requesting::with([
            'client.user',
            'doctor.user'
        ])->whereApproved(0)->paginate(10)->jsonSerialize();

        return response($requestings, Response::HTTP_OK);
    }

    public function approvedlist()
    {
        $requestings = Requesting::with([
            'client.user',
            'doctor.user',
            'containers.milk.donors'
        ])->whereApproved(1)->latest()->paginate(10)->jsonSerialize();

        return response($requestings, Response::HTTP_OK);
    }
    
    public function disapprovedlist()
    {
        $requestings = Requesting::with([
            'client.user',
            'doctor.user'
        ])->whereApproved(2)->paginate(10)->jsonSerialize();

        return response($requestings, Response::HTTP_OK);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $client = Client::where('user_id', $user->id)->first();

        $this->validate($request, [
            'child_firstname' => 'required|string|max:191', 
            'child_lastname' => 'required|string|max:191',
            'birthdate' => 'required', 
            'gender' => 'required', 
            'reason_why' => 'required',
        ]);

        $requesting = Requesting::create([
            'child_firstname' => $request['child_firstname'], 
            'child_lastname' => $request['child_lastname'], 
            'birthdate' => $request['birthdate'], 'gender' => $request['gender'], 
            'client' => $client->id,  'reason_why' => $request['reason_why'],
        ]);
        if ($requesting) {
            toast('Request Submitted Successfully', 'success', 'top-right');
            return redirect('clienthome');
        }
    }

    public function store2(Request $request)
    {
        $user = Auth::user();
        $client = Client::where('user_id', $user->id)->first();

        $this->validate($request, [
            'child_firstname' => 'required|string|max:191', 'child_lastname' => 'required|string|max:191',
            'birthdate' => 'required', 'gender' => 'required', 'reason_why' => 'required',
        ]);

        $requesting = Requesting::create([
            'child_firstname' => $request['child_firstname'],
            'child_lastname' => $request['child_lastname'],
            'birthdate' => $request['birthdate'], 'gender' => $request['gender'],
            'client_id' => $client->id, 'reason_why' => $request['reason_why'],
        ]);

        return response(null, Response::HTTP_OK);
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }

    public function approved(Request $request, $id)
    {
        $type = Auth::user()->type;
        $user_id = Auth::user()->id;
        $doctor = Doctor::whereUser_id($user_id)->first();

        $nurse = Nurse::whereUser_id($user_id)->first();

        $schedule = Carbon::now();

        $requesting = Requesting::findOrFail($id);

        $requesting->approved = 1;

        if ($type == 'doctor') {
            $requesting->doctor_id = $doctor->id;
        }
        else {
            $requesting->nurse_id = $nurse->id;
        }

        $requesting->save();
        return response(null, Response::HTTP_OK);
    }

    public function disapproved(Request $request, $id)
    {
        $schedule = Carbon::now();
        
        $requesting = Requesting::findOrFail($id);

        $requesting->approved = 2;
        $requesting->save();


        return response(null, Response::HTTP_CREATED);
    }

    public function schedule(Request $request, $id)
    {

        $schedule = Requesting::findOrFail($id);
        $schedule->start_time = "".$request->date." ".$request->starting_hour .":".$request->starting_minute.":00";
        $schedule->finish_time = "".$request->date." ".$request->finish_hour .":".$request->finish_minute.":00";
        $schedule->update();

        return response(null, Response::HTTP_OK);
    }

    public function schedulelist()
    {
        $requestings = Requesting::with([
            'tests',
            'questions',
            'candidate.user'
            
        ])->whereNotNull('start_time')->orWhereNotNull('finish_time')->whereApproved(0)->paginate(10)->jsonSerialize();

        return response($requestings, Response::HTTP_OK);
    }

    public function check_approved()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $client = Client::where('user_id', $user_id)->first();
        $client_id = $client->id;
        $requesting = Requesting::whereClient_id($client_id)->whereNull('received_at')->orderBy('id', 'desc')->first();

         if($requesting->approved === 0){
            $requestings = 0;
        }
        if ($requesting->approved === 1) {
            $requestings = 1;
        }

        return response($requestings, Response::HTTP_OK);
    }
}
