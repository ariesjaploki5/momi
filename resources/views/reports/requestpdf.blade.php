@extends('layouts.simple')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Recipient's Name</th>
                <th>Doctor/Nurse</th>
                <th>Milk Number</th>
                <th>Date Received</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
            <tr>
                <td>
                    {{ $d->id }}
                </td>
                <td class="text-capitalized">
                    {{ $d->recipient->user->lastname }}, {{ $d->recipient->user->firstname }}
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
                    @foreach ($d->milks as $milk)
                        {{ $milk->batch_number }}
                        {{ $milk->container_number }}
                    @endforeach
                </td>
                <td>
                    {{ $d->updated_at }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
    
    