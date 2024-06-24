@extends('layouts.app')
@section('main')
<div class="conatiner mt-5">
    <div class="row">
        <div class="col-md-3 offset-md-4 border rounded bg-dark">
            {{Auth::guard('apiadmin')->user()->email}}
        </div>
    </div>
</div>
@endsection