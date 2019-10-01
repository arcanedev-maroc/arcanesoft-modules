@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="far fa-fw fa-newspaper"></i> {{ __('Posts') }}
@endsection

@push('content-nav')
    <div class="mb-3 text-right">
        <a href="{{ route('admin::blog.posts.metrics') }}" class="btn btn-sm btn-secondary {{ active(['admin::blog.posts.metrics']) }}">{{ __('Metrics') }}</a>
        <a href="{{ route('admin::blog.posts.index') }}" class="btn btn-sm btn-secondary {{ active(['admin::blog.posts.index']) }}">{{ __('All') }}</a>
        {{ ui\action_link('add', route('admin::blog.posts.create'))->size('sm') }}
    </div>
@endpush

@section('content')
    <div class="card card-borderless shadow-sm">
        <div class="table-responsive">
            <table id="posts-table" class="table table-hover table-md mb-0">
                <thead>
                    <tr>
                        <th>{{ __('Title') }}</th>
                        <th class="text-center">{{ __('Created at') }}</th>
                        <th class="text-center">{{ __('Published') }}</th>
                        <th class="text-right">{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('modals')
@endpush

@push('scripts')
    <script>
        ready(() => {
            window.plugins.datatable('table#posts-table', {
                ajax: "{{ route('admin::blog.posts.datatables.index') }}",
                serverSide: true,
                processing: true,
                columns: [
                    { data: 'title' },
                    { data: 'created_at', class: 'text-center'},
                    { data: 'published', class: 'text-center', orderable: false, searchable: false },
                    { data: 'actions', class: 'text-right', orderable: false, searchable: false }
                ],
            })
        })
    </script>
@endpush
