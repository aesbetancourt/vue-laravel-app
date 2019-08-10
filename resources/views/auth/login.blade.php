@extends('layouts.app')

@section('content')
    <div class="register-photo">
        <div class="form-container">
          <div class="image-holder" ></div>
          <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
            @csrf
            <h2 class="text-center"><strong>Inicia</strong>&nbsp;sesión.</h2>
            <div class="form-group">
                <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input id="password" type="password" placeholder="Contraseña" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" style="background-color: rgb(37,55,102);">
                    Iniciar Sesión
                </button>
            </div>
            <a class="already" href="/register">
                No tienes cuenta? Crea una!
            </a>
          </form>
        </div>
      </div>
@endsection
