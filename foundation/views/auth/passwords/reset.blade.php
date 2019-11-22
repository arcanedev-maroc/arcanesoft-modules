@extends('foundation::auth._template.master')

<?php /** @var  Illuminate\Support\ViewErrorBag  $errors */ ?>

@section('title')
    @lang('Reset Password')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <h4 class="card-header text-center">@lang('Reset Password')</h4>
                <div class="card-body">
                    <form action="{{ route('auth::password.update') }}" method="POST" class="form form-reset-password">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-label-group">
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                   class="form-control {{ $errors->first('email', 'is-invalid') }}"
                                   placeholder="@lang('E-Mail Address')" required autofocus>
                            <label for="email">@lang('E-Mail Address')</label>
                            @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="password" name="password"
                                   class="form-control {{ $errors->first('password', 'is-invalid') }}"
                                   placeholder="@lang('Password')" required>
                            <label for="password">@lang('Password')</label>
                            @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="password-confirm" name="password_confirmation"
                                   class="form-control {{ $errors->first('password_confirmation', 'is-invalid') }}"
                                   placeholder="@lang('Confirm Password')" required>
                            <label for="password-confirm">@lang('Confirm Password')</label>
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <button class="btn btn-lg btn-primary btn-block" type="submit">@lang('Reset Password')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
