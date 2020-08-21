@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="far fa-fw fa-newspaper"></i> @lang('Posts')
@endsection

@push('content-nav')
    <div class="mb-3 text-right">
        <a href="{{ route('admin::blog.posts.metrics') }}" class="btn btn-sm btn-secondary {{ active(['admin::blog.posts.metrics']) }}">@lang('Metrics')</a>
        <a href="{{ route('admin::blog.posts.index') }}" class="btn btn-sm btn-secondary {{ active(['admin::blog.posts.index']) }}">@lang('All')</a>
        {{ arcanesoft\ui\action_link('add', route('admin::blog.posts.create'))->size('sm') }}
    </div>
@endpush

@section('content')
    <v-datatable name="{{ Arcanesoft\Blog\Views\Components\PostsDatatable::NAME }}"></v-datatable>
@endsection
