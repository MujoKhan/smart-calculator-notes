@extends('layouts.app')
@section('main')
<div class="conatiner mt-5">
    <div class="row">
        <div class="col-md-3 offset-md-4 border rounded bg-dark">
            <form action="" method="post" class="mt-3 mb-3 ms-3 me-3 text-white">
                @csrf
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group mt-2">
                    <button class="btn btn-success" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
