@extends('layouts.simple')
@section('content')
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Donor's Name</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
            <tr>
                <td>$d</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
    
    