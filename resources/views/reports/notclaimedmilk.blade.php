@extends('layouts.adminlte')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Not Claimed Milk
                        </div>
                        <div class="card-tools">
                            <!-- <a :href="'donationpdf'" class="btn btn-danger">PDF</a> -->
                            <form class="form-inline" action="postdonationpdf" method="POST">
                                @csrf
                                    <div>
                                        <select name="month" id="month" class="form-control text-capitalize" required>
                                            <option value="" hidden>Month</option>
                                            <option  value="1">January</option>
                                            <option  value="2">Febuary</option>
                                            <option  value="3">March</option>
                                            <option  value="4">April</option>
                                            <option  value="5">May</option>
                                            <option  value="6">June</option>
                                            <option  value="7">July</option>
                                            <option  value="8">August</option>
                                            <option  value="9">September</option>
                                            <option  value="10">October</option>
                                            <option  value="11">November</option>
                                            <option  value="12">December</option>
                                        </select>
                                    </div>
                                    <div class="mx-2">
                                        <select name="year" id="year" class="form-control" required>
                                            <option value="" hidden>Year</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                        </select>
                                    </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                    <claimed></claimed>
                </div>
            </div>
        </div>
    </div>
@endsection
