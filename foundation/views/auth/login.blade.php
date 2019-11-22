@extends('foundation::auth._template.master')

<?php /** @var  Illuminate\Support\ViewErrorBag  $errors */ ?>

@section('title')
    @lang('Login')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <h4 class="card-header text-center">@lang('Login')</h4>
                <div class="card-body">
                    <form action="{{ route('admin-auth::login.post') }}" method="POST" class="form">
                        @csrf

                        <div class="form-label-group">
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                   class="form-control{{ $errors->first('email', ' is-invalid') }}"
                                   placeholder="@lang('E-Mail Address')" required autofocus autocomplete="username">
                            <label for="email">@lang('E-Mail Address')</label>
                            @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="password" name="password"
                                   class="form-control{{ $errors->first('email', ' is-invalid') }}"
                                   placeholder="@lang('Password')" required autocomplete="current-password">
                            <label for="password">@lang('Password')</label>
                            @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="checkbox mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                                       class="custom-control-input">
                                <label class="custom-control-label" for="remember">@lang('Remember Me')</label>
                            </div>
                        </div>

                        <button class="btn btn-lg btn-primary btn-block" type="submit">@lang('Login')</button>
                    </form>
                </div>

                @if (app('router')->has('admin-auth::password.request'))
                <div class="card-footer text-center">
                    <a class="btn btn-link" href="{{ route('admin-auth::password.request') }}">@lang('Forgot Your Password?')</a>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
