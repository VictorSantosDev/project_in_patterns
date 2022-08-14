@extends('login.layouts.basic')

@section('title')
@section('content')
    <div class="register-box">
    <div class="register-logo">
    <a style="color: #a7d02f;" href="{{ route('signin') }}"><b>NEXT</b>BANK</a>
    </div>
    <div class="card">
    <div class="card-body register-card-body">
    <p class="login-box-msg">Realizar novo cadastro</p>
    <form action="{{ route('register-user') }}" method="post">
        @csrf

    <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
    <div class="input-group mb-3">
    <input type="text" name="name" class="form-control" placeholder="Nome completo" value="{{ old('name')}}">
    <div class="input-group-append">
    <div class="input-group-text">
    <span class="fas fa-user"></span>
    </div>
    </div>
    </div>

    <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
    <div class="input-group mb-3">
    <input type="email" name="email" class="form-control" placeholder="Email"  value="{{ old('email')}}">
    <div class="input-group-append">
    <div class="input-group-text">
    <span class="fas fa-envelope"></span>
    </div>
    </div>
    </div>

    <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
    <div class="input-group mb-3">
    <input type="password" name="password" class="form-control" placeholder="Senha">
    <div class="input-group-append">
    <div class="input-group-text">
    <span class="fas fa-lock"></span>
    </div>
    </div>
    </div>
    
    <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
    <div class="input-group mb-3">
    <input type="password" name="password_confirmation" class="form-control" placeholder="Repetir senha">
    <div class="input-group-append">
    <div class="input-group-text">
    <span class="fas fa-lock"></span>
    </div>
    </div>
    </div>

    <div class="row">
    <div class="col-8">
    <div class="icheck-primary">
    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
    <label for="agreeTerms">
        Aceitar todos os <a href="#">termos</a>
    </label>
    </div>
    </div>
    
    <div class="col-4">
    <button type="submit" class="btn btn-primary btn-block">Registrar</button>
    </div>
    
    </div>
    </form>
    <a href="{{ route('signin') }}" class="text-center">Já sou cadastrado!</a>
    </div>
    
    </div>
    </div>
@endsection