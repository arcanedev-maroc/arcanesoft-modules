@extends('foundation::auth._template.master')

<?php /** @var  Illuminate\Support\ViewErrorBag  $errors */ ?>

@section('title')
    @lang('Confirm Password')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-5 col-lg-4">
            <div class="card shadow-sm">
                <h4 class="card-header text-center">@lang('Confirm Password')</h4>
                <div class="card-body">
                    <form action="{{ route('auth::password.confirm') }}" method="POST" class="form">
                        @csrf

                        <p class="text-justify">
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

                @if (app('router')->has('auth::password.request'))
                <div class="card-footer text-center">
                    <a class="btn btn-link" href="{{ route('auth::password.request') }}">@lang('Forgot Your Password?')</a>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
