@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="far fa-fw fa-user-edit"></i> {{ __('Authors') }}
@endsection

@section('content')
    {{ form()->open(['route' => 'admin::blog.authors.store', 'method' => 'POST']) }}
    <div class="row">
        <div class="col-md-6">
            <div class="card card-borderless shadow-sm mb-3">
                <div class="card-header">{{ __('Author') }}</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="username" class="control-label">{{ __('Username') }} :</label>
                        {{ form()->text('username', old('username'), ['class' => 'form-control'.$errors->first('username', ' is-invalid'), 'placeholder' => __('Username'), 'required']) }}
                        @error('username')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="slug" class="control-label">{{ __('Slug') }} :</label>
                        {{ form()->text('slug', old('slug'), ['class' => 'form-control'.$errors->first('slug', ' is-invalid'), 'placeholder' => __('Slug')]) }}
                        @error('slug')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="bio" class="control-label">{{ __('Bio') }} :</label>
                        {{ form()->textarea('bio', old('bio'), ['class' => 'form-control'.$errors->first('bio', ' is-invalid'), 'placeholder' => __('Bio'), 'required']) }}
                        @error('bio')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    {{ ui\action_link('cancel', route('admin::blog.authors.index'))->size('sm') }}
                    {{ ui\action_button('create')->size('sm')->submit() }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-borderless shadow-sm mb-3">
                <div class="card-header">{{ __('User Account') }}</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="first_name" class="control-label">{{ __('First Name') }} :</label>
                        {{ form()->text('first_name', old('first_name'), ['class' => 'form-control'.$errors->first('first_name', ' is-invalid'), 'placeholder' => __('First Name'), 'required']) }}
                        @error('first_name')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="control-label">{{ __('Last Name') }} :</label>
                        {{ form()->text('last_name', old('last_name'), ['class' => 'form-control'.$errors->first('last_name', ' is-invalid'), 'placeholder' => __('First Name'), 'required']) }}
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="control-label">{{ __('Email') }} :</label>
                        {{ form()->email('email', old('email'), ['class' => 'form-control'.$errors->first('email', ' is-invalid'), 'placeholder' => __('Email'), 'required']) }}
                        @error('email')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="control-label">{{ __('Password') }} :</label>
                        {{ form()->password('password', ['class' => 'form-control'.$errors->first('password', ' is-invalid'), 'placeholder' => __('Password')]) }}
                        @error('password')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label for="password_confirmation" class="control-label">{{ __('Confirm Password') }} :</label>
                        {{ form()->password('password_confirmation', ['class' => 'form-control'.$errors->first('password_confirmation', ' is-invalid'), 'placeholder' => __('Confirm Password')]) }}
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ form()->close() }}
@endsection
