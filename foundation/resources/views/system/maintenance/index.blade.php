@extends(foundation()->template())

@section('page-title')
    <i class="far fa-fw fa-stop-circle"></i> {{ __('Maintenance') }}
@endsection

<?php
/**
 * @var  Arcanesoft\Foundation\Helpers\MaintenanceMode  $maintenance
 * @var  Illuminate\Support\ViewErrorBag                $errors
 */
$maintenanceData = $maintenance->data();
?>

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-borderless shadow-sm mb-3">
                <div class="card-header p-2">{{ __('Maintenance Mode') }}</div>
                @if ($maintenance->isDown())
                    <table class="table table-borderless table-md mb-0">
                        <tr>
                            <th>{{ __('Status') }} :</th>
                            <td class="text-right">
                                <span class="badge badge-outline-danger">
                                    <i class="fas fa-fw fa-exclamation-triangle text-danger"></i> {{ __('Enabled') }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('Time') }} :</th>
                            <td class="text-right">
                                <small>{{ $maintenanceData['time'] }}</small>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('Message') }} :</th>
                            <td class="text-right">
                                <small>{{ $maintenanceData['message'] ?? 'null' }}</small>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('Allowed') }} :</th>
                            <td class="text-right">
                                @forelse($maintenanceData['allowed'] as $allowed)
                                    <span class="badge badge-outline-secondary">{{ $allowed }}</span>
                                @empty
                                    <span class="badge badge-outline-warning">NO ONE IS ALLOWED</span>
                                @endforelse
                            </td>
                        </tr>
                        @if ($maintenanceData['retry'])
                        <tr>
                            <th>{{ __('Retry') }} :</th>
                            <td class="text-right">
                                {{ $maintenanceData['retry'] }}
                            </td>
                        </tr>
                        @endif
                    </table>
                    @can (Arcanesoft\Foundation\Policies\System\MaintenancePolicy::ability('toggle'))
                    <div class="card-footer p-2 text-right">
                        <form action="{{ route('admin::foundation.system.maintenance.stop') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fa fa-fw fa-stop"></i> {{ __('Stop') }}
                            </button>
                        </form>
                    </div>
                    @endcan
                @else
                    <table class="table table-borderless table-md mb-0">
                        <tr>
                            <th>{{ __('Status') }} :</th>
                            <td class="text-right">
                                <span class="badge badge-outline-success">{{ __('Disabled') }}</span>
                            </td>
                        </tr>
                    </table>
                @endif
            </div>
        </div>

        @can (Arcanesoft\Foundation\Policies\System\MaintenancePolicy::ability('toggle'))
        @if ($maintenance->isUp())
        <div class="col-lg-4">
            <div class="card card-borderless shadow-sm mb-3">
                <form action="{{ route('admin::foundation.system.maintenance.start') }}" method="POST">
                    <div class="card-body p-2">
                        <div class="form-group {{ $errors->first('allowed', 'is-invalid') }}">
                            <label for="allowed">{{ __('Allowed') }} :</label>
                            {{ form()->textarea('allowed', old('allowed'), ['class' => 'form-control', 'rows' => 3]) }}
                            <small id="allowedHelp" class="form-text text-muted">You can add multiple IP Addresses using newlines.</small>

                            @error('allowed')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group {{ $errors->first('allow_current_ip', 'is-invalid') }}">
                            {{ form()->checkbox('allow_current_ip', old('allow_current_ip', 1), ['class' => 'form-check-input']) }}
                            <label class="form-check-label" for="CurrentIp">Allow my current IP Address</label>

                            @error('allow_current_ip')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group {{ $errors->first('allowed', 'message') }}">
                            <label for="message">{{ __('Message') }} :</label>
                            {{ form()->text('message', old('message'), ['class' => 'form-control']) }}

                            @error('message')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group {{ $errors->first('allowed', 'retry') }}">
                            <label for="retry">{{ __('Retry') }} :</label>
                            {{ form()->number('retry', old('retry', 0), ['class' => 'form-control', 'min' => 0]) }}

                            @error('retry')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer p-2 text-right">
                        @csrf
                        <button class="btn btn-outline-danger" type="submit">
                            <i class="fa fa-fw fa-play"></i> {{ __('Start') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif
        @endcan
    </div>
@endsection

@push('scripts')
@endpush
