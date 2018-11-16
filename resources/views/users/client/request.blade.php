@extends('layouts.client')

@section('content')
<div class="container mb-2">
    <div class="row justify-content-center">
        <div class="col-8 text-right">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
<request></request>
@endsection
