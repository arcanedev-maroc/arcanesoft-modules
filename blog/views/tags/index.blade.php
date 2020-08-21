@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-tags"></i> @lang('Tags')
@endsection

@push('content-nav')
    <div class="mb-3 text-right">
        <a href="{{ route('admin::blog.tags.metrics') }}" class="btn btn-sm btn-secondary {{ active(['admin::blog.tags.metrics']) }}">@lang('Metrics')</a>
        <a href="{{ route('admin::blog.tags.index') }}" class="btn btn-sm btn-secondary {{ active(['admin::blog.tags.index']) }}">@lang('All')</a>
        {{ arcanesoft\ui\action_link('add', route('admin::blog.tags.create'))->size('sm') }}
    </div>
@endpush

@section('content')
    <v-datatable name="{{ Arcanesoft\Blog\Views\Components\TagsDatatable::NAME }}"></v-datatable>
@endsection
