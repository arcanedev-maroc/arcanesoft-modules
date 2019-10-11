<div class="card shadow-sm mb-3">
    <div class="card-body p-2">
        <nav class="nav nav-pills nav-justified">
            <a href="{{ route('admin::system.index') }}" class="nav-item nav-link {{ active(['admin::system.index']) }}">@lang('Information')</a>

            @can(Arcanesoft\Foundation\System\Policies\MaintenancePolicy::ability('index'))
            <a href="{{ route('admin::system.maintenance.index') }}" class="nav-item nav-link {{ active(['admin::system.maintenance.*']) }}">@lang('Maintenance')</a>
            @endcan

            @can(Arcanesoft\Foundation\System\Policies\AbilitiesPolicy::ability('index'))
            <a href="{{ route('admin::system.abilities.index') }}" class="nav-item nav-link {{ active(['admin::system.abilities.*']) }}">@lang('Abilities')</a>
            @endcan
        </nav>
    </div>
</div>
