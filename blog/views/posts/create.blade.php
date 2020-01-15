@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="far fa-fw fa-newspaper"></i> @lang('New Post')
@endsection

@section('content')
    {{ form()->open(['route' => 'admin::blog.posts.store', 'method' => 'POST']) }}
        <div class="card card-borderless mb-3">
            <div class="card-header">@lang('Post')</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="title" class="control-label">@lang('Title') :</label>
                            {{ form()->text('title', old('title'), ['class' => 'form-control'.$errors->first('title', ' is-invalid'), 'placeholder' => __('Title'), 'required']) }}
                            @error('title')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="slug" class="control-label">@lang('Slug') :</label>
                            {{ form()->text('slug', old('slug'), ['class' => 'form-control'.$errors->first('slug', ' is-invalid'), 'placeholder' => __('Slug')]) }}
                            @error('slug')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="excerpt" class="control-label">@lang('Excerpt') :</label>
                    {{ form()->text('excerpt', old('excerpt'), ['class' => 'form-control'.$errors->first('excerpt', ' is-invalid'), 'placeholder' => __('Excerpt'), 'required']) }}
                    @error('body')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="body" class="control-label">@lang('Body') :</label>
                    <tui-editor name="body" value="{{ old('body') }}"></tui-editor>
                    @error('body')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tags" class="control-label">@lang('Tags') :</label>
                    {{ form()->select('tags[]', $tags, old('tags'), ['class' => 'form-control'.$errors->first('tags', ' is-invalid')]) }}
                    @error('tags')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                {{ arcanesoft\ui\action_link('cancel', route('admin::blog.posts.index'))->size('sm') }}
                {{ arcanesoft\ui\action_button('create')->size('sm')->submit() }}
            </div>
        </div>
    {{ form()->close() }}
@endsection

@push('scripts')
    <script>
        window.ready(() => {
            //
        })
    </script>
@endpush
