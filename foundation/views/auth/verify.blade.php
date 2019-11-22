@extends('foundation::auth._template.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <h4 class="card-header text-center">@lang('Verify Your Email Address')</h4>
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            @lang('A fresh verification link has been sent to your email address.')
                        </div>
                    @endif

                    @lang('Before proceeding, please check your email for a verification link.')
                    @lang('If you did not receive the email'), <a href="{{ route('auth::verification.resend') }}">@lang('click here to request another')</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
