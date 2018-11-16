@extends('layouts.simple')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Donor's Name</th>
                <th>Doctor/Nurse</th>
                <th>Date Donated</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
            <tr>
                <td>
                    {{ $d->id }}
                </td>
                <td class="text-capitalized">
                    {{ $d->candidate->user->lastname }}, {{ $d->candidate->user->firstname }}
                </td>
                <td>
                    @if($d->doctor_id !== null)
                        {{ $d->doctor->user->lastname }}, {{ $d->doctor->user->firstname }}
                    @endif
                    @if($d->nurse_id !== null)
                        {{ $d->nurse->user->lastname }}, {{ $d->nurse->user->firstname }}
                    @endif
                </td>
                <td>
                    {{ $d->updated_at }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
    
    