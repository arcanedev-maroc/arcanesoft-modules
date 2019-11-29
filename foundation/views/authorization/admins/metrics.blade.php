@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fa fa-fw fa-user-secret"></i> @lang('Administrators') <small>@lang('Metrics')</small>
@endsection

@push('content-nav')
    <div class="mb-3 text-right">
        <a href="{{ route('admin::auth.administrators.metrics') }}"
           class="btn btn-sm btn-secondary {{ active(['admin::auth.administrators.metrics']) }}">
            @lang('Metrics')
        </a>
        <a href="{{ route('admin::auth.administrators.index') }}"
           class="btn btn-sm btn-secondary {{ active(['admin::auth.administrators.index']) }}">
            @lang('Users')
        </a>
        {{ arcanesoft\ui\action_link('add', route('admin::auth.administrators.create'))->size('sm') }}
    </div>
@endpush

@push('metrics')
@endpush

@section('content')
@endsection
