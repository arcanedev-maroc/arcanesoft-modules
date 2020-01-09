@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-tag"></i> @lang('Edit Tag')
@endsection

<?php /** @var  Arcanesoft\Blog\Models\Tag  $tag */ ?>

@section('content')
    {{ form()->open(['route' => ['admin::blog.tags.update', $tag], 'method' => 'PUT']) }}
        <div class="row">
            <div class="col-md-6">
                <div class="card card-borderless shadow-sm mb-3">
                    <div class="card-header">@lang('Tag')</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class="control-label">@lang('Name') :</label>
                            {{ form()->text('name', old('name', $tag->name), ['class' => 'form-control'.$errors->first('name', ' is-invalid'), 'placeholder' => __('Name'), 'required']) }}
                            @error('name')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name" class="control-label">@lang('Slug') :</label>
                            {{ form()->text('slug', old('slug', $tag->slug), ['class' => 'form-control'.$errors->first('slug', ' is-invalid'), 'placeholder' => __('Slug')]) }}
                            @error('slug')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        {{ arcanesoft\ui\action_link('cancel', route('admin::blog.tags.show', [$tag]))->size('sm') }}
                        {{ arcanesoft\ui\action_button('update')->size('sm')->submit() }}
                    </div>
                </div>
            </div>
        </div>
    {{ form()->close() }}
@endsection
