@extends('foundation::auth._template.master')

<?php /** @var  Illuminate\Support\ViewErrorBag  $errors */ ?>

@section('title')
    @lang('Login')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header p-3">
                    <h3 class="h5 font-weight-light text-uppercase text-muted text-center m-0">@lang('Login')</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin::auth.login.post') }}" method="POST" class="form">
                        @csrf

                        <div class="row g-3">
                            <div class="col-lg-12">
                                {{-- EMAIL --}}
                                <div class="form-label-group">
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                           class="form-control{{ $errors->first('email', ' is-invalid') }}"
                                           placeholder="@lang('E-Mail Address')" required autofocus autocomplete="username">
                                    <label for="email">@lang('E-Mail Address')</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                {{-- PASSWORD --}}
                                <div class="form-label-group">
                                    <input type="password" id="password" name="password"
                                           class="form-control{{ $errors->first('email', ' is-invalid') }}"
                                           placeholder="@lang('Password')" required autocomplete="current-password">
                                    <label for="password">@lang('Password')</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                {{-- REMEMBER ME --}}
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="yes" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">@lang('Remember Me')</label>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <button class="btn btn-lg btn-primary btn-block" type="submit">@lang('Login')</button>
                            </div>
                        </div>
                    </form>
                </div>

                @if (app('router')->has('admin::auth.password.request'))
                <div class="card-footer text-center">
                    <a class="btn btn-link" href="{{ route('admin::auth.password.request') }}">@lang('Forgot Your Password?')</a>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
