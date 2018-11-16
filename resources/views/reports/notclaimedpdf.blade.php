@extends('layouts.simple')
@section('content')
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Donor's Name</th>
                <th>Expiration Date</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
            <tr>
                <td>{{ $d->id }}</td>
                <td>{{ $d->donor->name }}</td>
                <td>{{ $d->expiration_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
    
    