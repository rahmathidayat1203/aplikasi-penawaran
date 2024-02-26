@extends('layouts.auth.main')
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <div class="card-body">
                <form method="POST" action="{{route('login.post')}}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                        <div class="invalid-feedback">
                            Please fill in your email
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Password</label>
                        </div>
                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                        <div class="invalid-feedback">
                            please fill in your password
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                            Login
                        </button>
                    </div>
                    <div class="form-group">
                        <div class="mt-5 text-muted text-center">
                           Don't Have Account ? <a href="{{route('register')}}">Create One</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
