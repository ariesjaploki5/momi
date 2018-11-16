@extends('layouts.adminlte')

@section('content')
<div class="container">
        <div class="row justify-content-center">
          <div class="col-md-10">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="card-title">
                        Medical Test
                    </div>
                </div>
                <div class="card-body py-0">
                    Firstname: {{ $screening->candidate->user->firstname }}
                </br>
                    Lastname: {{ $screening->candidate->user->lastname }}
                </br>
                    Address: {{ $screening->candidate->user->address }}
                </div>
                    

                <div class="card-body py-0">
                    <form class="form-horizontal" action="/postmedtest" method="POST">
                        @csrf
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Test</th>
                                    <th>Result</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               <input type="hidden" name="screening_id" value="{{ $screening->id }}">
                                @foreach ($tests as $test)
                                    <tr>
                                        <td>
                                            {{ $test->name }}
                                            <input type="hidden" id="{{ $test->id }}" name="tests[]" value="{{ $test->id }}">
                                        </td>
                                        <td>
                                            
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="results[{{ $test->id }}]" value="positive" required>
                                                <label class="form-check-label" for="inlineRadio1">Positive</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="results[{{ $test->id }}]" value="negative" required>
                                                <label class="form-check-label" for="inlineRadio2">Negative</label>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                
            <!-- /.card -->
            </div>
          </div>
        </div>
        
    </div>

@endsection