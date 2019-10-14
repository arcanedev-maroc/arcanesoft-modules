@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fa fa-fw fa-database"></i> @lang('Backups')
@endsection

@section('content')
    <div class="card card-borderless shadow-sm">
        <div class="card-header">
            @lang('Monitor Statuses')

            @can(Arcanesoft\Backups\Policies\StatusesPolicy::ability('create'))
                <a href="#run-backups-modal" class="btn btn-xs btn-success">
                    <i class="fa fa-fw fa-floppy-o"></i> @lang('Run Backup')
                </a>
            @endcan

            @can(Arcanesoft\Backups\Policies\StatusesPolicy::ability('delete'))
                <a href="#clear-backups-modal" class="btn btn-xs btn-warning">
                    <i class="fa fa-fw fa-eraser"></i> @lang('Clear Backups')
                </a>
            @endcan
        </div>
        <table class="table table-condensed table-hover mb-0">
            <thead>
                <tr>
                    <th>@lang('Disk')</th>
                    <th>@lang('Name')</th>
                    <th class="text-center">@lang('Reachable')</th>
                    <th class="text-center">@lang('Healthy')</th>
                    <th class="text-center">@lang('Backups')</th>
                    <th class="text-center">@lang('Newest Backup')</th>
                    <th class="text-center">@lang('Used Storage')</th>
                    <th class="text-right">@lang('Actions')</th>
                </tr>
            </thead>
            <tbody>
            @forelse($statuses as $index => $status)
                <?php
                /** @var  Spatie\Backup\Tasks\Monitor\BackupDestinationStatus  $status */
                $destination = $status->backupDestination()
                ?>
                <tr>
                    <td>
                        <span class="badge badge-outline-primary">{{ $destination->diskName() }}</span>
                    </td>
                    <td>
                        <span class="badge badge-outline-dark">{{ $destination->backupName() }}</span>
                    </td>
                    <td class="text-center">
                        @if ($destination->isReachable())
                            <span class="badge badge-outline-success">Yes</span>
                        @else
                            <span class="badge badge-outline-danger">No</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($status->isHealthy())
                            <span class="badge badge-outline-success">Yes</span>
                        @else
                            <span class="badge badge-outline-danger">No</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($destination->isReachable())
                            {{ arcanesoft\ui\count_pill($destination->backups()->count()) }}
                        @else
                            <span class="badge badge-default">/</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($destination->isReachable() && $destination->newestBackup())
                            <small>{{ $destination->newestBackup()->date()->diffForHumans() ?: 'No backups present' }}</small>
                        @else
                            <span class="badge badge-default">/</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($destination->isReachable())
                            <span class="badge badge-light">
                                {{ Spatie\Backup\Helpers\Format::humanReadableSize($destination->usedStorage()) }}
                            </span>
                        @else
                            <span class="badge badge-light">/</span>
                        @endif
                    </td>
                    <td class="text-right">
                        @can(Arcanesoft\Backups\Policies\StatusesPolicy::ability('show'))
                            {{ arcanesoft\ui\action_link_icon('show', route('admin::backups.statuses.show', [$index]))->size('sm') }}
                        @endcan
                    </td>
                </tr>
            @empty
            @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('modals')
    @can(Arcanesoft\Backups\Policies\StatusesPolicy::ability('create'))
        <div id="run-backups-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ form()->open(['route' => 'admin::backups.statuses.backup', 'method' => 'POST', 'id' => 'run-backups-form', 'class' => '', 'autocomplete' => 'off']) }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">{{ trans('backups::statuses.modals.backup.title') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! trans('backups::statuses.modals.backup.message') !!}
                    </div>
                    <div class="modal-footer justify-content-between">
                        {{ \arcanesoft\ui\action_button('cancel')->attribute('data-dismiss', 'modal') }}
                        <button class="btn btn-success" type="submit">
                            @lang('Run Backup')
                        </button>
                    </div>
                </div>
                {{ form()->close() }}
            </div>
        </div>
    @endcan

    @can(Arcanesoft\Backups\Policies\StatusesPolicy::ability('delete'))
        <div id="clear-backups-modal" class="modal fade">
            <div class="modal-dialog">
                {{ form()->open(['route' => 'admin::backups.statuses.clear', 'method' => 'POST', 'id' => 'clear-backups-form', 'class' => '', 'autocomplete' => 'off']) }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">{{ trans('backups::statuses.modals.clear.title') }}</h4>
                        </div>
                        <div class="modal-body">
                            <p>{!! trans('backups::statuses.modals.clear.message') !!}</p>
                        </div>
                        <div class="modal-footer">
                            {{ \arcanesoft\ui\action_button('cancel')->attribute('data-dismiss', 'modal') }}
                            {{ \arcanesoft\ui\action_button('backup', 'submit') }}
                        </div>
                    </div>
                {{ form()->close() }}
            </div>
        </div>
    @endcan
@endpush

@push('scripts')
    {{-- RUN BACKUPS MODAL --}}
    @can(Arcanesoft\Backups\Policies\StatusesPolicy::ability('create'))
        <script>
            $(function () {
                var $runBackupsModal = $('div#run-backups-modal'),
                    $runBackupsForm  = $('form#run-backups-form');

                $('a[href="#run-backups-modal"]').on('click', function (event) {
                    event.preventDefault();

                    $runBackupsModal.modal('show');
                });

                $runBackupsForm.on('submit', function (event) {
                    event.preventDefault();

                    var $submitBtn = $runBackupsForm.find('button[type="submit"]');
                        $submitBtn.button('loading');

                    request().post($runBackupsForm.attr('action'))
                         .then(function (response) {
                             if (response.data.code === 'success') {
                                 $runBackupsModal.modal('hide');
                                 location.reload();
                             }
                             else {
                                 alert('ERROR ! Check the console !');
                                 $submitBtn.button('reset');
                             }
                         })
                         .catch(function (error) {
                             alert('AJAX ERROR ! Check the console !');
                             console.log(error);
                             $submitBtn.button('reset');
                         });
                });
            });
        </script>
    @endcan

    {{-- CLEAR BACKUPS MODAL --}}
    @can(Arcanesoft\Backups\Policies\StatusesPolicy::ability('delete'))
        <script>
            $(function () {
                var $clearBackupsModal = $('div#clear-backups-modal'),
                    $clearBackupsForm  = $('form#clear-backups-form');

                $('a[href="#clear-backups-modal"]').on('click', function (event) {
                    event.preventDefault();

                    $clearBackupsModal.modal('show');
                });

                $clearBackupsForm.on('submit', function (event) {
                    event.preventDefault();

                    var $submitBtn = $clearBackupsForm.find('button[type="submit"]');
                        $submitBtn.button('loading');

                    request().post($clearBackupsForm.attr('action'))
                         .then(function (response) {
                             if (response.data.code === 'success') {
                                 $clearBackupsModal.modal('hide');
                                 location.reload();
                             }
                             else {
                                 alert('ERROR ! Check the console !');
                                 $submitBtn.button('reset');
                             }
                         })
                         .catch(function (error) {
                             alert('AJAX ERROR ! Check the console !');
                             console.log(error);
                             $submitBtn.button('reset');
                         });
                });
            });
        </script>
    @endcan
@endpush
