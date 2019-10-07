<div class="card shadow-sm mb-3">
    <div class="card-body p-2">
        <nav class="nav nav-pills nav-justified">
            <a href="{{ route('admin::foundation.system.index') }}" class="nav-item nav-link {{ active(['admin::foundation.system.index']) }}">Information</a>
            <a href="{{ route('admin::foundation.system.maintenance.index') }}" class="nav-item nav-link {{ active(['admin::foundation.system.maintenance.index']) }}">Maintenance</a>
            <a href="{{ route('admin::foundation.system.abilities.index') }}" class="nav-item nav-link {{ active(['admin::foundation.system.abilities.index']) }}">Abilities</a>
        </nav>
    </div>
</div>
