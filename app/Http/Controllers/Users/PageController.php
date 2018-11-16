<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

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
use App\Model\Users\Disapproved;
use Illuminate\Support\Facades\Auth;


class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    //
        public function donate()
        {
            return view('users/client/donate');
        }

        public function request()
        {
            return view('users/client/request');
        }

    //acount pages
        public function profile1()
        {
            return view('users/profile');
        }

        public function profile2()
        {
            return view('users/profile2');
        }
    //transaction's home pages
        public function screenings()
        {
            
            return view('files/screenings');
        }

        public function requestings()
        {
            return view('files/requestings');
        }
    
    //user's management
        public function adminadmins()
        {
            return view('users/fm/admin');
        }

        public function candidates()
        {
            return view('users/fm/candidate');
        }

        public function clients()
        {
            return view('users/fm/client');
        }

        public function doctors()
        {
            return view('users/fm/doctor');
        }

        public function donors()
        {
            return view('users/fm/donor');
        }

        public function nurses()
        {
            return view('users/fm/nurse');
        }
        public function recipients()
        {
            return view('users/fm/recipient');
        }
        public function staff()
        {
            return view('users/fm/staff');
        }


    //files management
        public function conditions()
        {
            return view('files.conditions');
        }

        public function questions()
        {
            return view('files.questions');
        }

        public function tests()
        {
            return view('files.tests');
        }

        public function milks(){
            return view('files.milks');
        }

    //reports
        public function requestreports()
        {
            return view('reports/request');
        }

        public function donationreports()
        {
            return view('reports/donation');
        }

        public function notclaimedmilk()
        {
            return view('reports/notclaimedmilk');
        }

        public function expiredmilk()
        {
            return view('reports/expiredmilk');
        }

        public function donatedmilk()
        {
            return view('reports/donatedmilk');
        }
}

