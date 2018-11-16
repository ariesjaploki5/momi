
<div class="container">
    
        <div class="row justify-content-center">
          <div class="col-md-10">

            @if ($approved_count > 0 && $scheduled_count === 0)
            <div class="card">
                <div class="card-body">
                    Please wait for approval
                </div>
            </div>
            @endif
            @if($approved_count > 0 && $scheduled_count > 0)
                <div class="card">
                <div class="card-body">
                    Your Schedule of Medical Test is
                    <br>
                    {{ $schedule->start_time }}
                    to 
                    {{ $schedule->finish_time }}

                </div>
            </div>
            @endif
            @if($approved_count === 0 && $scheduled_count === 0)
            <div class="card mt-3">
                <div class="card-body">
                    <form class="form-horizontal" action="senddonate" method="POST">
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
                        <div class="col-sm-12">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            Answer
                                        </td>
                                        <td>
                                            Question
                                        </td>
                                    </tr>
                                    @foreach ($questions as $q)
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="answer[{{ $q->id }}]" value="Yes {{ $q->id }}" required>
                                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="answer[{{ $q->id }}]" value="No {{ $q->id }}" required>
                                                <label class="form-check-label" for="inlineRadio2">No</label>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-capitalize">{{ $q->text }}</p>
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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

