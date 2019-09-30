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
<?php
$total = Illuminate\Support\Arr::pull($percents, 'all');
?>
@section('content')
    <div class="card card-borderless card-log-level flex-row shadow-sm mb-3">
        <div class="card-log-icon {{ $total['value'] > 0 ? "bg-log-level-all" : 'bg-log-level-empty' }}">
            {!! log_styler()->icon('all') !!}
        </div>
        <div class="card-body p-2">
            <h6 class="font-weight-bold text-muted small mb-1">{{ $total['name'] }}</h6>
            <h4>
                {{ $total['value'] }} <small>{{ __('entries') }} <small>({{ $total['percent'] }} %)</small></small>
            </h4>

            <div class="progress progress-xs progress-flat">
                <div class="progress-bar {{ $total['value'] > 0 ? "bg-log-level-all" : 'bg-log-level-empty' }}" role="progressbar" style="width: {{ $total['percent'] }}%;" aria-valuenow="{{ $total['percent'] }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-lg-9">
            <div class="row">
                @foreach($percents as $level => $log)
                <div class="col-sm-6 col-xl-4">
                    <div class="card card-borderless card-log-level flex-row shadow-sm mb-3">
                        <div class="card-log-icon {{ $log['value'] > 0 ? "bg-log-level-{$level}" : 'bg-log-level-empty' }}">
                            {!! log_styler()->icon($level) !!}
                        </div>
                        <div class="card-body p-2">
                            <h6 class="font-weight-bold text-muted small mb-1">{{ $log['name'] }} <small>({{ $log['percent'] }} %)</small></h6>
                            <h4>
                                {{ $log['value'] }} <small>{{ __('entries') }}</small>
                            </h4>

                            <div class="progress progress-xs progress-flat">
                                <div class="progress-bar {{ $log['value'] > 0 ? "bg-log-level-{$level}" : 'bg-log-level-empty' }}" role="progressbar" style="width: {{ $log['percent'] }}%;" aria-valuenow="{{ $log['percent'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="card card-borderless">
                <div class="card-header">
                    {{ __('Ratios') }}
                </div>
                <div class="card-body p-2">
                    <canvas id="log-stats-chart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        ready(() => {
            plugins.chartJs('log-stats-chart', {
                type: 'doughnut',
                data: @json($chartData),
                options: {
                    legend: {
                        display: false
                    }
                }
            })
        });
    </script>
@endpush
