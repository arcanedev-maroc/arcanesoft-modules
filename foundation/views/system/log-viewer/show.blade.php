@extends(arcanesoft\foundation()->template())

<?php
/**
 * @var  Arcanedev\LogViewer\Entities\Log            $log
 * @var  Illuminate\Pagination\LengthAwarePaginator  $entries
 */
?>

@section('page-title')
    <i class="fas fa-fw fa-clipboard-list"></i> @lang('LogViewer')
@endsection

@push('content-nav')
    <div class="mb-3 text-right">
        <a href="{{ route('admin::foundation.system.log-viewer.index') }}"
           class="btn btn-sm btn-secondary {{ active(['admin::foundation.system.log-viewer.index']) }}">@lang('Metrics')</a>
        <a href="{{ route('admin::foundation.system.log-viewer.logs.index') }}"
           class="btn btn-sm btn-secondary {{ active(['admin::foundation.system.log-viewer.logs.index']) }}">@lang('Logs')</a>
    </div>
@endpush

@section('content')
    {{-- Log Details --}}
    <div class="card card-borderless shadow-sm mb-3">
        <div class="card-header p-2">
            <span class="badge badge-outline-secondary">{{ $log->date }}</span>
        </div>
        <table class="table table-borderless table-md mb-0">
            <tbody>
                <tr>
                    <th>@lang('Path') :</th>
                    <td><small>{{ $log->getPath() }}</small></td>
                </tr>
                <tr>
                    <th>@lang('Size') :</th>
                    <td>{{ $log->size() }}</td>
                </tr>
                <tr>
                    <th>@lang('Created at') :</th>
                    <td>
                        <small>{{ $log->createdAt() }}</small>
                    </td>
                </tr>
                <tr>
                    <th>@lang('Updated at') :</th>
                    <td>
                        <small>{{ $log->updatedAt() }}</small>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="card-footer p-2 text-right">
            @can(Arcanesoft\Foundation\Policies\System\LogViewerPolicy::ability('download'))
            <a href="{{ route('admin::foundation.system.log-viewer.logs.download', [$log->date]) }}" class="btn btn-sm btn-success">
                <i class="fa fa-download"></i> @lang('Download')
            </a>
            @endcan

            @can(Arcanesoft\Foundation\Policies\System\LogViewerPolicy::ability('delete'))
            {{ arcanesoft\ui\action_button('delete')->attribute('onclick', "window.Foundation.\$emit('foundation::system.log-viewer.delete')")->size('sm') }}
            @endcan
        </div>
    </div>

    {{-- SEARCH FORM --}}
    <div class="card card-borderless shadow-sm mb-3">
        <div class="card-body p-2">
            <form action="{{ route('admin::foundation.system.log-viewer.logs.search', [$log->date, $level]) }}" method="GET">
                <div class=form-group">
                    <div class="input-group">
                        <input id="query" name="query" class="form-control"  value="{{ $query }}" placeholder="Type here to search">
                        <div class="input-group-append">
                            @unless (is_null($query))
                                <a href="{{ route('admin::foundation.system.log-viewer.logs.show', [$log->date]) }}" class="btn btn-secondary">
                                    ({{ $entries->count() }} results) <i class="fa fa-fw fa-times"></i>
                                </a>
                            @endunless
                            <button id="search-btn" class="btn btn-primary">
                                <span class="fa fa-fw fa-search"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Log Levels Menu --}}
    <nav class="log-levels-menu-nav mb-3">
        @foreach($log->menu() as $levelKey => $item)
            <a class="log-levels-menu-nav-item shadow-sm level-{{ $item['count'] === 0 ? 'empty disabled' : $levelKey }}{{ $level === $levelKey ? ' active' : ''}}"
                href="{{ $item['count'] === 0 ? '#' : $item['url'] }}">
                <span class="level-name mb-1">{{ $item['name'] }}</span>
                <span class="badge badge-light">{{ $item['count'] }}</span>
            </a>
        @endforeach
    </nav>

    {{-- Log Entries --}}
    <div class="mb-3">
        @if ($entries->hasPages())
            <span class="badge badge-info">
                @lang('Page :current of :last', ['current' => $entries->currentPage(), 'last' => $entries->lastPage()])
            </span>
        @endif
    </div>

    <section class="timeline-container">
        @foreach($entries as $key => $entry)
            <?php /** @var  Arcanedev\LogViewer\Entities\LogEntry  $entry */ ?>
            <div class="timeline-item card card-borderless shadow-sm mb-3">
                <div class="timeline-dot shadow-sm text-white bg-log-level-{{ $entry->level }}">{{ $entry->icon() }}</div>
                <div class="card-header d-flex px-3 py-2">
                    <div>
                        <span class="badge badge-outline-dark">{{ $entry->datetime->format('H:i:s') }}</span>
                        <span class="badge badge-log-level-outline-env">{{ $entry->env }}</span>
                        <span class="badge badge-log-level-outline-{{ $entry->level }}">{{ $entry->name() }}</span>
                    </div>

                    @if ($entry->hasStack())
                        <a class="btn btn-sm btn-light ml-auto" role="button" data-toggle="collapse" href="#log-entry-stack-{{ $key }}" aria-expanded="false" aria-controls="log-stack-{{ $key }}">
                            <i class="fa fa-toggle-on"></i> @lang('Stack')
                        </a>
                    @endif
                </div>
                <div class="card-body p-3">
                    {{ $entry->header }}

                    <div id="log-entry-stack-{{ $key }}" class="log-entry-stack-content small collapse">
                        {{ $entry->stack() }}
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    {{ $entries->appends(compact('query'))->render('foundation::_components.pagination', ['class' => 'justify-content-center mb-0']) }}
@endsection

@push('modals')
    {{-- DELETE MODAL --}}
    @can(Arcanesoft\Foundation\Policies\System\LogViewerPolicy::ability('delete'))
    <div class="modal modal-danger fade" id="delete-log-modal" data-backdrop="static"
         tabindex="-1" role="dialog" aria-labelledby="deleteLogTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin::foundation.system.log-viewer.logs.delete', [$log->date]) }}" id="delete-log-form">
                @csrf
                @method('DELETE')

                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="deleteLogTitle">@lang('Delete Log')</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="@lang('Close')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @lang('Are you sure you want to delete this log ?')
                    </div>
                    <div class="modal-footer justify-content-between">
                        {{ arcanesoft\ui\action_button('cancel')->attribute('data-dismiss', 'modal') }}
                        {{ arcanesoft\ui\action_button('delete')->submit() }}
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endcan
@endpush

@push('scripts')
    <script>
        window.ready(() => {
            {{-- DELETE SCRIPT --}}
            @can(Arcanesoft\Foundation\Policies\System\LogViewerPolicy::ability('delete'))
            let $deleteLogModal = $('div#delete-log-modal'),
                $deleteLogForm  = $('form#delete-log-form');

            window.Foundation.$on('foundation::system.log-viewer.delete', () => {
                $deleteLogModal.modal('show');
            });

            $deleteLogForm.on('submit', (event) => {
                event.preventDefault();

                let submitBtn = window.Foundation.ui.loadingButton(
                    $deleteLogForm[0].querySelector('button[type="submit"]')
                );
                submitBtn.loading();

                window.request().delete($deleteLogForm.attr('action'))
                    .then((response) => {
                        if (response.data.code === 'success') {
                            $deleteLogModal.modal('hide');
                            location.replace("{{ route('admin::foundation.system.log-viewer.logs.index') }}");
                        }
                        else {
                            alert('ERROR ! Check the console !');
                            submitBtn.button('reset');
                        }
                    })
                    .catch((error) => {
                        alert('AJAX ERROR ! Check the console !');
                        console.log(error);
                        submitBtn.button('reset');
                    });

                return false;
            });
            @endcan
        });
    </script>
@endpush
