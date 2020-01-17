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
                        <th>@lang('Full Name')</th>
                        <th>@lang('Username')</th>
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
        ready(() => {
            window.plugins.datatable('table#authors-table', {
                ajax: "{{ route('admin::blog.authors.datatables.index') }}",
                serverSide: true,
                processing: true,
                columns: [
                    { data: 'full_name', orderable: false, searchable: false },
                    { data: 'username' },
                    { data: 'posts', class: 'text-center', orderable: false, searchable: false },
                    { data: 'created_at', class: 'text-center'},
                    { data: 'actions', class: 'text-right', orderable: false, searchable: false }
                ],
            })
        })
    </script>
@endpush
