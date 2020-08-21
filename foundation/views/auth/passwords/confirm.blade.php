@extends('foundation::auth._template.master')

<?php /** @var  Illuminate\Support\ViewErrorBag  $errors */ ?>

@section('title')
    @lang('Confirm Password')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-5">
            <div class="card shadow-sm">
                <div class="card-header p-3">
                    <h3 class="h5 font-weight-light text-uppercase text-muted text-center m-0">@lang('Confirm Password')</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('auth::admin.password.confirm') }}" method="POST" class="form">
                        @csrf

                        <p>
                            @lang('Please confirm your password before continuing.')
                            @lang('We won\'t ask for your password again for a few hours.')
                        </p>

                        <div class="form-label-group">
                            <input type="password" id="password" name="password"
                                   class="form-control{{ $errors->first('password', ' is-invalid') }}"
                                   placeholder="@lang('Password')" required autofocus autocomplete="current-password">
                            <label for="password">@lang('Password')</label>
                            @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <button class="btn btn-lg btn-primary btn-block" type="submit">@lang('Confirm Password')</button>
                    </form>
                </div>

                @if (app('router')->has('auth::admin.password.request'))
                <div class="card-footer text-center">
                    <a class="btn btn-link" href="{{ route('auth::admin.password.request') }}">@lang('Forgot Your Password?')</a>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
