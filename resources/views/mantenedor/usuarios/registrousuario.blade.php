@extends('layouts.app')


@section('title')
	Registro de usuarios
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>{{ __('Registro usuarios') }}</h5></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="iniciales" class="col-md-4 col-form-label text-md-right">{{ __('Iniciales') }}</label>

                            <div class="col-md-6">
                                <input id="iniciales" type="text" class="form-control @error('iniciales') is-invalid @enderror" name="iniciales" value="{{ old('iniciales') }}" required autocomplete="name" autofocus>

                                @error('iniciales')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                                                    
                    <div class="card-header"><h5>Asignación de Roles</h5></div>

                    
                    <div class="form-group row">
                        <label for="administrador" class="col-md-4 col-form-label text-md-right">{{ __('Administrador') }}</label>

                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="role" id="administrador" value="administrador">
                          
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="vendedor" class="col-md-4 col-form-label text-md-right">{{ __('Vendedor') }}</label>

                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="role" id="vendedor" value="vendedor">                      
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="disenador" class="col-md-4 col-form-label text-md-right">{{ __('Diseñador') }}</label>

                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="role" id="disenador" value="disenador">                          
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="taller" class="col-md-4 col-form-label text-md-right">{{ __('Taller') }}</label>   
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="role" id="taller" value="taller">
                          
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="supervisor" class="col-md-4 col-form-label text-md-right">{{ __('Supervisor') }}</label>   
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="role" id="supervisor" value="supervisor">
                          
                        </div>
                    </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection