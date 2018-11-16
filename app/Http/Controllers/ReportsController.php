<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

use Illuminate\Http\Response;
use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReportsController extends Controller
{
    
    public function displaydonation()
    {
        $donation = Screening::with([
            'candidate.user', 'doctor.user', 'nurse.user'
        ])->paginate(1000)->jsonSerialize();
        return response($donation, Response::HTTP_OK);
    }

    public function displaymilkrequest()
    {
        $requesting = Requesting::with([
            'milks.donors.user',
            'recipient.user',
        ])->paginate(10)->jsonSerialize();

        $milk = Milk::with([
            'requesting.doctor.user', 'requesting.recipient.user', 'donors.user', 
        ])->whereNotNull('requesting_id')->paginate(100)->jsonSerialize();
        return response($milk, Response::HTTP_OK);
    }

    public function excelmilkrequest()
    {

        $excel = Excel::download(new ExcelExport, 'milks.xlsx');
        return $excel;

    }


    public function requestpdf(Request $request)
    {
        // $month = $request->month;
        // $year = $request->year;

        $data = Milk::with('requesting.recipient.user', 'donors.user', 'requesting.doctor.user', 'requesting.nurse.user')
        ->whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->get();
        $pdf = PDF::loadView('reports.requestpdf', compact('data'));
        return $pdf->download('milkrequest.pdf');
    }

    public function donationpdf(Request $request)
    {

        $data = Milk::with('requesting.recipient.user', 'donors.user', 'requesting.doctor.user', 'requesting.nurse.user')
        ->whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->get();
        $pdf = PDF::loadView('reports.donationpdf', compact('data'));
        return $pdf->download('milkdonation.pdf');
    }

    public function postrequestpdf(Request $request)
    {
        $month = $request->month;
        $year = $request->year;

        $data = Requesting::with([
            'recipient.user', 'doctor.user', 'nurse.user', 'milks'
        ])->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get();
        $pdf = PDF::loadView('reports.requestpdf', compact('data'));
        return $pdf->download('milkrequest.pdf');
    }

    public function postdonationpdf(Request $request)
    {

        $month = $request->month;
        $year = $request->year;

        $data = Screening::with([
            'candidate.user', 'doctor.user', 'nurse.user'
        ])->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get();


        $pdf = PDF::loadView('reports.donationpdf', compact('data'));
        return $pdf->download('milkdonation.pdf');
    }

    public function postnotclaimedmilk(Request $request)
    {
        $month = $request->month;
        $year = $request->year;

        $data = Milk::with('containers.requesting.doctor.user', 'containers.reque','donors.user', '')
        ->whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->get();

        $pdf = PDF::loadView('reports.notclaimedpdf', compact('data'));
        return $pdf->download('notclaimed.pdf');
    }

    public function postexpiredmilk(Request $request)
    {
        $month = $request->month;
        $year = $request->year;

        $data = Milk::with('containers.requesting.doctor.user', 'containers.reque', 'donors.user', '')
            ->whereExpired(1)
            ->get();

        $pdf = PDF::loadView('reports.notclaimedpdf', compact('data'));
        return $pdf->download('notclaimed.pdf');
    }

    public function postdonatedmilk(Request $request)
    {
        $month = $request->month;
        $year = $request->year;

        $data = Milk::with('containers.requesting.doctor.user', 'containers.reque', 'donors.user', '')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get();

        $pdf = PDF::loadView('reports.notclaimedpdf', compact('data'));
        return $pdf->download('notclaimed.pdf');
    }

    public function claimed()
    {

    }

    public function expired()
    {

    }

    public function donated()
    {

    }
}
