@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="far fa-fw fa-stop-circle"></i> @lang('Maintenance')
@endsection

<?php
/**
 * @var  Arcanesoft\Foundation\Helpers\MaintenanceMode  $maintenance
 * @var  Illuminate\Support\ViewErrorBag                $errors
 */
$maintenanceData = $maintenance->data();
?>

@section('content')
    @include('foundation::system._includes.system-nav')

    <div class="row">
        <div class="col-lg-4">
            <div class="card card-borderless shadow-sm mb-3">
                <div class="card-header p-2">@lang('Maintenance Mode')</div>
                @if ($maintenance->isEnabled())
                    <table class="table table-borderless table-md mb-0">
                        <tr>
                            <th>@lang('Status') :</th>
                            <td class="text-right">
                                <span class="badge badge-outline-danger">
                                    <i class="fas fa-fw fa-exclamation-triangle text-danger"></i> @lang('Enabled')
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('Time') :</th>
                            <td class="text-right">
                                <small>{{ $maintenanceData['time'] }}</small>
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('Message') :</th>
                            <td class="text-right">
                                <small>{{ $maintenanceData['message'] ?? 'null' }}</small>
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('Allowed') :</th>
                            <td class="text-right">
                                @forelse($maintenanceData['allowed'] as $allowed)
                                    <span class="badge badge-outline-secondary">{{ $allowed }}</span>
                                @empty
                                    <span class="badge badge-outline-warning">@lang('No one is allowed')</span>
                                @endforelse
                            </td>
                        </tr>
                        @if ($maintenanceData['retry'])
                        <tr>
                            <th>@lang('Retry') :</th>
                            <td class="text-right">
                                {{ $maintenanceData['retry'] }}
                            </td>
                        </tr>
                        @endif
                    </table>
                    @can (Arcanesoft\Foundation\System\Policies\MaintenancePolicy::ability('toggle'))
                    <div class="card-footer p-2 text-right">
                        <form action="{{ route('admin::system.maintenance.stop') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-success" type="submit">
                                <i class="fa fa-fw fa-stop"></i> @lang('Stop Maintenance Mode')
                            </button>
                        </form>
                    </div>
                    @endcan
                @else
                    <table class="table table-borderless table-md mb-0">
                        <tr>
                            <th>@lang('Status') :</th>
                            <td class="text-right">
                                <span class="badge badge-outline-success">@lang('Disabled')</span>
                            </td>
                        </tr>
                    </table>
                @endif
            </div>

            @if ($maintenance->isDisabled())
                @can (Arcanesoft\Foundation\System\Policies\MaintenancePolicy::ability('toggle'))
                    <div class="card card-borderless shadow-sm mb-3">
                        <form action="{{ route('admin::system.maintenance.start') }}" method="POST">
                            @csrf
                            <div class="card-body p-2">
                                <div class="form-group {{ $errors->first('allowed', 'is-invalid') }}">
                                    <label for="allowed">@lang('Allowed') :</label>
                                    {{ form()->textarea('allowed', old('allowed'), ['class' => 'form-control', 'rows' => 3]) }}
                                    <small id="allowedHelp" class="form-text text-muted">@lang('You can add multiple IP Addresses using newlines.')</small>

                                    @error('allowed')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group {{ $errors->first('allow_current_ip', 'is-invalid') }}">
                                    {{ form()->checkbox('allow_current_ip', old('allow_current_ip', 1), ['class' => 'form-check-input']) }}
                                    <label class="form-check-label" for="CurrentIp">@lang('Allow my current IP Address')</label>

                                    @error('allow_current_ip')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group {{ $errors->first('message', 'is-invalid') }}">
                                    <label for="message">@lang('Message') :</label>
                                    {{ form()->text('message', old('message'), ['class' => 'form-control']) }}

                                    @error('message')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group {{ $errors->first('retry', 'is-invalid') }}">
                                    <label for="retry">@lang('Retry') :</label>
                                    {{ form()->number('retry', old('retry', 0), ['class' => 'form-control', 'min' => 0]) }}

                                    @error('retry')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer p-2 text-right">
                                <button class="btn btn-outline-danger" type="submit">
                                    <i class="fa fa-fw fa-play"></i> @lang('Start Maintenance Mode')
                                </button>
                            </div>
                        </form>
                    </div>
                @endcan
            @endif
        </div>
    </div>
@endsection

