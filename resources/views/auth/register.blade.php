@extends('layouts.app')

@section('content')
      <div>
        <div class="register-photo">
          <div class="form-container">
            <div class="image-holder"></div>
            <form method="POST" action="{{ route('register') }}">
              @csrf
              <h2 class="text-center"><strong>Crea</strong>&nbsp;una cuenta.</h2>
              <div class="form-group">
                <input id="name" placeholder="Nombre" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <input class="form-control @error('ci') is-invalid @enderror" type="text" name="ci" placeholder="Cédula" id="ci">
                @error('ci')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
               </div>

              <div class="form-group">
                <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" placeholder="Telefono" id="phone">
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

              </div>
              <div class="form-group">
                <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <input id="password" placeholder="Contraseña" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <input id="password-confirm" placeholder="Confirmar Contraseña" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
              </div>
              <div class="form-group">
                <button id="btn_register" class="btn btn-primary btn-block" type="submit" style="background-color: rgb(37,55,102);">
                    Registrate!
                </button>
              </div>
                <a class="already" href="/login">
                    Ya tienes una cuenta? Inicia aqui.
                </a>
            </form>
          </div>
        </div>
      </div>
@endsection
