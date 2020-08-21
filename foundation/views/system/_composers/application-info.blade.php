<div class="card card-borderless shadow-sm">
    <div class="card-header px-2 font-weight-light text-uppercase text-muted">
        @lang('Application')
    </div>
    <table class="table table-borderless mb-0">
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('URL')</td>
            <td class="text-right small">{{ $applicationInfo['url'] }}</td>
        </tr>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('Locale')</td>
            <td class="text-right">
                <span class="badge badge-outline-primary">{{ $applicationInfo['locale'] }}</span>
            </td>
        </tr>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('Timezone')</td>
            <td class="text-right">
                <span class="badge badge-outline-primary">{{ $applicationInfo['timezone'] }}</span>
            </td>
        </tr>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('Debug Mode')</td>
            <td class="text-right">
                @if ($applicationInfo['debug_mode'])
                    <span class="badge badge-outline-danger">
                        <i class="fas fa-fw fa-exclamation-triangle text-danger"></i> @lang('Enabled')
                    </span>
                @else
                    <span class="badge badge-outline-success">@lang('Disabled')</span>
                @endif
            </td>
        </tr>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('Maintenance Mode')</td>
            <td class="text-right">
                @if ($applicationInfo['maintenance_mode'])
                    <span class="badge badge-outline-danger">
                        <i class="fas fa-fw fa-exclamation-triangle text-danger"></i> @lang('Enabled')
                    </span>
                @else
                    <span class="badge badge-outline-success">@lang('Disabled')</span>
                @endif
            </td>
        </tr>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('PHP Version')</td>
            <td class="text-right">
                <span class="badge badge-outline-primary">{{ $applicationInfo['php_version'] }}</span>
            </td>
        </tr>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('Laravel Version')</td>
            <td class="text-right">
                <span class="badge badge-outline-primary">{{ $applicationInfo['laravel_version'] }}</span>
            </td>
        </tr>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('ARCANESOFT Version')</td>
            <td class="text-right">
                <span class="badge badge-outline-primary">{{ $applicationInfo['foundation_version'] }}</span>
            </td>
        </tr>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('Database Driver')</td>
            <td class="text-right">
                <span class="badge badge-outline-dark">{{ $applicationInfo['database_connection'] }}</span>
            </td>
        </tr>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('Cache Driver')</td>
            <td class="text-right">
                <span class="badge badge-outline-dark">{{ $applicationInfo['cache_driver'] }}</span>
            </td>
        </tr>
        <tr>
            <td class="font-weight-light text-uppercase text-muted">@lang('Session Driver')</td>
            <td class="text-right">
                <span class="badge badge-outline-dark">{{ $applicationInfo['session_driver'] }}</span>
            </td>
        </tr>
    </table>
</div>
