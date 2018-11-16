<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//transaction's model
use App\Model\Requesting;
use App\Model\Screening;

//file's model
use App\Model\Files\Test;
use App\Model\Files\Condition;
use App\Model\Files\Milk;
use App\Model\Files\Question;

//user's model
use App\User;
use App\Model\Users\Nurse;
use App\Model\Users\Donor;
use App\Model\Users\Doctor;
use App\Model\Users\Candidate;
use App\Model\Users\Recipient;
use App\Model\Users\Disapproved;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function admin()
    {
        return view('dashboard');
    }

    public function candidate()
    {
        $questions = Question::whereSelected(1)->get();

        $user_id = Auth::user()->id;
        $candidate = Candidate::whereUser_id($user_id)->first();
        $candidate_id = $candidate->id;

        $approved_count = Screening::whereCandidate_id($candidate_id)

        ->whereApproved(0)
        ->count();
        
        $scheduled_count = Screening::whereCandidate_id($candidate_id)
        ->whereNotNull('start_time')
        ->whereNotNull('finish_time')
        ->whereApproved(0)
        ->whereMedical_test(0)
        ->count();
        
        $schedule = Screening::whereCandidate_id($candidate_id)->whereApproved(1)
        ->whereNotNull('start_time')->whereNotNull('finish_time')

        ->select('start_time', 'finish_time')
        ->orderBy('id', 'desc')
        ->first();
        
        $last_approved = Screening::whereCandidate_id($candidate_id)->where('approved', 1)->orderBy('id', 'desc')->first();

        return view('users/candidate/home', compact('questions' , 'last_approved', 'scheduled_count', 'schedule', 'approved_count', 'last_approved'));
    }

    public function donor()
    {
        return view('users/donor/home');
    }

    public function recipient()
    {
        $user_id = Auth::user()->id;
        $recipient = Recipient::where('user_id', $user_id)->first();
        $approved_count = Requesting::where('recipient_id', $recipient->id)->where('approved', 0)->count();

        
        return view('users/recipient/home', compact('approved_count'));
    }

    public function client()
    {
        return view('users/client/home');
    }
    
    public function milkstaff()
    {
        return view('users/milkstaff/home');
    }
    public function doctor()
    {
        return view('users/doctor/home');
    }
    public function nurse()
    {
        return view('users/nurse/home');
    }

}
