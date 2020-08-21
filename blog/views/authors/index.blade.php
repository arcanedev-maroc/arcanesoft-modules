@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-user-edit"></i> @lang('Authors')
@endsection

@push('content-nav')
    <div class="mb-3 text-right">
        {{ arcanesoft\ui\action_link('add', route('admin::blog.authors.create'))->size('sm') }}
    </div>
@endpush

@section('content')
    <div class="card card-borderless shadow-sm">
        <div class="table-responsive">
            <table id="authors-table" class="table table-hover table-md mb-0">
                <thead>
                    <tr>
                        <th class="font-weight-light text-uppercase text-muted">@lang('Full Name')</th>
                        <th class="font-weight-light text-uppercase text-muted">@lang('Username')</th>
                        <th class="font-weight-light text-uppercase text-muted text-center">@lang('Posts')</th>
                        <th class="font-weight-light text-uppercase text-muted text-center">@lang('Created at')</th>
                        <th class="font-weight-light text-uppercase text-muted text-right">@lang('Actions')</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
    </script>
@endpush
