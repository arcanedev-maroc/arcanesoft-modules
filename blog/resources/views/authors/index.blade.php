@extends(foundation()->template())

@section('page-title')
    <i class="far fa-fw fa-user-edit"></i> {{ __('Authors') }}
@endsection

@push('content-nav')
    <div class="mb-3 text-right">
        <a href="{{ route('admin::blog.authors.metrics') }}" class="btn btn-sm btn-secondary {{ active(['admin::blog.authors.metrics']) }}">{{ __('Metrics') }}</a>
        <a href="{{ route('admin::blog.authors.index') }}" class="btn btn-sm btn-secondary {{ active(['admin::blog.authors.index']) }}">{{ __('All') }}</a>
        {{ ui\action_link('add', route('admin::blog.authors.create'))->size('sm') }}
    </div>
@endpush

@section('content')
    <div class="card card-borderless shadow-sm">
        <div class="table-responsive">
            <table id="authors-table" class="table table-hover table-md mb-0">
                <thead>
                    <tr>
                        <th>{{ __('Username') }}</th>
                        <th class="text-center">{{ __('Posts') }}</th>
                        <th class="text-center">{{ __('Created at') }}</th>
                        <th class="text-right">{{ __('Actions') }}</th>
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
                    { data: 'username' },
                    { data: 'posts', class: 'text-center', orderable: false, searchable: false },
                    { data: 'created_at', class: 'text-center'},
                    { data: 'actions', class: 'text-right', orderable: false, searchable: false }
                ],
            })
        })
    </script>
@endpush
