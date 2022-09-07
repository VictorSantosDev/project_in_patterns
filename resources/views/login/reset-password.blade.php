@extends('login.layouts.basic')

@section('title')
@section('content')

    <div class="login-box">
    <div class="login-logo">
    <a style="color: #a7d02f;" href="#"><b>NEXT</b>BANK</a>
    </div>
    
    <div class="card">
    <div class="card-body login-card-body">
    <p class="login-box-msg">Recuperar conta!</p>
    <form action="{{ route('reset-password-user') }}" method="post">
        @csrf
        <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" value="{{ old('email')}}" placeholder="Email">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Recuperar</button>
            </div>
        </div>
    </form>
    
    <p class="mb-1">
    <a href="{{ route('signin') }}">Fazer login!</a>
    </p>
    <p class="mb-0">
    <a href="{{ route('form-register')}}" class="text-center">Crair uma nova conta!</a>
    </p>
    </div>
    
    </div>
    </div>
@endsection