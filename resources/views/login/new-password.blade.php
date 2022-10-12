@extends('login.layouts.basic')

@section('title')
@section('content')
    @if(session('msg'))
    <div class="alert {{ session('not_active') || session('not_exist') ? 'alert-warning' : 'alert-success' }} alert-dismissible fade show" role="alert">
        {{ session('msg') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    
    <div class="login-box">
    <div class="login-logo">
    <a style="color: #a7d02f;" href="#"><b>NEXT</b>BANK</a>
    </div>
    
    <div class="card">
    <div class="card-body login-card-body">
    <p class="login-box-msg">Nova senha!</p>
    <form action="{{ route('reset-new-password-user', ['hash' => $hash]) }}" method="post">
        @csrf
        <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" value="{{ old('password')}}" placeholder="Nova senha">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation')}}" placeholder="Digite a senha novamente">
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