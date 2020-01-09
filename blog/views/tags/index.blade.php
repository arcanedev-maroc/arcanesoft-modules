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
    <div class="card card-borderless shadow-sm">
        <div class="table-responsive">
            <table id="tags-table" class="table table-hover table-md mb-0">
                <thead>
                    <tr>
                        <th>@lang('Name')</th>
                        <th class="text-center">@lang('Posts')</th>
                        <th class="text-center">@lang('Created at')</th>
                        <th class="text-right">@lang('Actions')</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.ready(() => {
            window.plugins.datatable('table#tags-table', {
                ajax: "{{ route('admin::blog.tags.datatables.index') }}",
                serverSide: true,
                processing: true,
                columns: [
                    {data: 'name'},
                    {data: 'posts', class: 'text-center', searchable: false},
                    {data: 'created_at', class: 'text-center'},
                    {data: 'actions', class: 'text-right', orderable: false, searchable: false}
                ],
            });
        });
    </script>
@endpush
