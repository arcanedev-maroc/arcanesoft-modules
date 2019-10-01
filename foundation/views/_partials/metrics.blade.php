<div class="card-columns metric-cards">
    @foreach($foundationMetrics as $metric)
        {{ $metric }}
    @endforeach

    @stack('metrics')
</div>
