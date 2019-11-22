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
                    <form action="{{ route('auth::password.email') }}" method="POST" class="form form-reset-password">
                        @csrf

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="form-label-group">
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                   class="form-control {{ $errors->first('email', 'is-invalid') }}"
                                   placeholder="@lang('E-Mail Address')" required autofocus>
                            <label for="email">@lang('E-Mail Address')</label>
                            @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <button class="btn btn-lg btn-primary btn-block" type="submit">@lang('Send Password Reset Link')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
