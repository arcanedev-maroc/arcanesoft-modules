@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fa fa-fw fa-users"></i> @lang('Edit User')
@endsection

<?php /** @var  App\Models\User|mixed  $user */ ?>

@section('content')
    {{ form()->open(['route' => ['admin::auth.users.update', $user], 'method' => 'PUT']) }}
        <div class="row">
            <div class="col-md-6">
                <div class="card card-borderless">
                    <div class="card-header">@lang('User')</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="first_name" class="control-label">@lang('First Name') :</label>
                            {{ form()->text('first_name', old('first_name', $user->first_name), ['class' => 'form-control'.$errors->first('first_name', ' is-invalid'), 'placeholder' => __('First Name'), 'required']) }}
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="last_name" class="control-label">@lang('Last Name') :</label>
                            {{ form()->text('last_name', old('last_name', $user->last_name), ['class' => 'form-control'.$errors->first('last_name', ' is-invalid'), 'placeholder' => __('First Name'), 'required']) }}
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="control-label">@lang('Email') :</label>
                            {{ form()->email('email', old('email', $user->email), ['class' => 'form-control'.$errors->first('email', ' is-invalid'), 'placeholder' => __('Email'), 'required']) }}
                            @error('email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        {{ arcanesoft\ui\action_link('cancel', route('admin::auth.users.show', [$user]))->size('sm') }}
                        {{ arcanesoft\ui\action_button('update')->size('sm')->submit() }}
                    </div>
                </div>
            </div>
        </div>
    {{ form()->close() }}
@endsection
