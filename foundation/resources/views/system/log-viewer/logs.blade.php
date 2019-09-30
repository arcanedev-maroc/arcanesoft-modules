@extends(foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-clipboard-list"></i> {{ __('LogViewer') }}
@endsection

@push('content-nav')
    <div class="mb-3 text-right">
        <a href="{{ route('admin::foundation.system.log-viewer.index') }}" class="btn btn-sm btn-secondary {{ active(['admin::foundation.system.log-viewer.index']) }}">{{ __('Metrics') }}</a>
        <a href="{{ route('admin::foundation.system.log-viewer.logs.index') }}" class="btn btn-sm btn-secondary {{ active(['admin::foundation.system.log-viewer.logs.index']) }}">{{ __('Logs') }}</a>
    </div>
@endpush

@section('content')
    <div class="card card-borderless shadow-sm">
        <div class="table-responsive">
            <table class="table table-sm table-hover mb-0">
                <thead>
                    <tr>
                        @foreach($headers as $key => $header)
                            <th scope="col" class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                                @if ($key == 'date')
                                    <span class="badge badge-info">{{ $header }}</span>
                                @else
                                    <span class="badge badge-log-level bg-log-level-{{ $key }}">{{ $header }}</span>
                                @endif
                            </th>
                        @endforeach
                        <th scope="col" class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rows as $date => $row)
                        <tr>
                            @foreach($row as $key => $value)
                                <td class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                                    @if ($key == 'date')
                                        <span class="badge badge-outline-primary">{{ $value }}</span>
                                    @elseif ($value == 0)
                                        <span class="badge badge-pill badge-light">{{ $value }}</span>
                                    @else
                                        <a href="{{ route('admin::foundation.system.log-viewer.logs.filter', [$date, $key]) }}" class="text-white border-0">
                                            <span class="badge badge-pill bg-log-level-{{ $key }}">{{ $value }}</span>
                                        </a>
                                    @endif
                                </td>
                            @endforeach
                            <td class="text-right">
                                @can(\Arcanesoft\Foundation\Policies\System\LogViewerPolicy::ability('show'))
                                <a href="{{ route('admin::foundation.system.log-viewer.logs.show', [$date]) }}" class="btn btn-sm btn-info">
                                    <i class="fa fa-search"></i>
                                </a>
                                @endcan

                                @can(\Arcanesoft\Foundation\Policies\System\LogViewerPolicy::ability('download'))
                                <a href="{{ route('admin::foundation.system.log-viewer.logs.download', [$date]) }}" class="btn btn-sm btn-success">
                                    <i class="fa fa-download"></i>
                                </a>
                                @endcan

                                @can(\Arcanesoft\Foundation\Policies\System\LogViewerPolicy::ability('delete'))
                                {{ ui\action_button_icon('delete')->attribute('onclick', "window.Foundation.\$emit('foundation::system.log-viewer.delete', ['{$date}'])")->size('sm') }}
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center">
                                <span class="badge badge-secondary">{{ trans('log-viewer::general.empty-logs') }}</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('modals')
    {{-- DELETE MODAL --}}
    @can(\Arcanesoft\Foundation\Policies\System\LogViewerPolicy::ability('delete'))
    <div class="modal modal-danger fade" id="delete-log-modal" data-backdrop="static"
         tabindex="-1" role="dialog" aria-labelledby="deleteLogTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin::foundation.system.log-viewer.logs.delete', [':id']) }}" id="delete-log-form">
                @csrf
                @method('DELETE')

                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="deleteLogTitle">{{ __('Delete Log') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ __('Are you sure you want to delete this log ?') }}
                    </div>
                    <div class="modal-footer justify-content-between">
                        {{ ui\action_button('cancel')->attribute('data-dismiss', 'modal') }}
                        {{ ui\action_button('delete')->submit() }}
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endcan
@endpush

@push('scripts')
    <script>
        ready(() => {
            {{-- DELETE SCRIPT --}}
            @can(\Arcanesoft\Foundation\Policies\System\LogViewerPolicy::ability('delete'))
            let $deleteLogModal = $('div#delete-log-modal'),
                $deleteLogForm  = $('form#delete-log-form'),
                deleteLogAction = $deleteLogForm.attr('action');

            window.Foundation.$on('foundation::system.log-viewer.delete', (date) => {
                $deleteLogForm.attr('action', deleteLogAction.replace(':id', date));
                $deleteLogModal.modal('show');
            });

            $deleteLogForm.on('submit', (event) => {
                event.preventDefault();

                let submitBtn = window.Foundation.ui.loadingButton(
                    $deleteLogForm[0].querySelector('button[type="submit"]')
                );
                submitBtn.loading();

                window.axios.delete($deleteLogForm.attr('action'))
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

            $deleteLogModal.on('hidden.bs.modal', () => {
                $deleteLogForm.attr('action', deleteLogAction);
            });
            @endcan
        });
    </script>
@endpush
