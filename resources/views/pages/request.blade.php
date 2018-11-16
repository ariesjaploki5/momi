@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
          <div class="col-md-10">


            @if ($approved_count > 0)
            <div class="card">
                <div class="card-body">
                    Please wait for the approval
                </div>
            </div>

            @else
                <div class="card mt-3">
                <div class="card-body">
                    <form class="form-horizontal" action="sendrequest" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="inputName" class="col-sm-12 control-label">Child Firstname</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control form-control-sm" name="child_firstname" id="child_firstname" placeholder="Child Firstname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-12 control-label">Child Lastname</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control form-control-sm" name="child_lastname" id="child_lastname" placeholder="Child Lastname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-12 control-label">Birthdate</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control form-control-sm text-uppercase" name="birthdate" id="birthdate" placeholder="Birthdate" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-12 control-label">Gender</label>
                        <div class="col-sm-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" 
                                name="gender" id="male" value="male" required>
                                <label class="form-check-label" for="boy">Boy</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" 
                                name="gender" id="female" value="female" required>
                                <label class="form-check-label" for="girl">Girl</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-12 control-label">Reason Why</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control form-control-sm form-control-sm" name="reason_why" id="reason_why" placeholder="Reason Why" required>
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
                </div>
                
            <!-- /.card -->
            </div>
            @endif
            
          </div>
        </div>
        
    </div>
@endsection