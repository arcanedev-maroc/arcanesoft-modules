<div class="card card-borderless shadow-sm mb-3">
    <div class="card-header p-2">@lang('Application')</div>
    <table class="table table-md mb-0">
        <tr>
            <th>@lang('URL') :</th>
            <td class="text-right small">{{ $applicationInfo['url'] }}</td>
        </tr>
        <tr>
            <th>@lang('Locale') :</th>
            <td class="text-right">
                <span class="badge badge-outline-primary">{{ $applicationInfo['locale'] }}</span>
            </td>
        </tr>
        <tr>
            <th>@lang('Timezone') :</th>
            <td class="text-right">
                <span class="badge badge-outline-primary">{{ $applicationInfo['timezone'] }}</span>
            </td>
        </tr>
        <tr>
            <th>@lang('Debug Mode') :</th>
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
            <th>@lang('Maintenance Mode') :</th>
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
            <th>@lang('PHP Version') :</th>
            <td class="text-right">
                <span class="badge badge-outline-primary">{{ $applicationInfo['php_version'] }}</span>
            </td>
        </tr>
        <tr>
            <th>@lang('Laravel Version') :</th>
            <td class="text-right">
                <span class="badge badge-outline-primary">{{ $applicationInfo['laravel_version'] }}</span>
            </td>
        </tr>
        <tr>
            <th>@lang('ARCANESOFT Version') :</th>
            <td class="text-right">
                <span class="badge badge-outline-primary">{{ $applicationInfo['foundation_version'] }}</span>
            </td>
        </tr>
        <tr>
            <th>@lang('Database Driver') :</th>
            <td class="text-right">
                <span class="badge badge-outline-dark">{{ $applicationInfo['database_connection'] }}</span>
            </td>
        </tr>
        <tr>
            <th>@lang('Cache Driver') :</th>
            <td class="text-right">
                <span class="badge badge-outline-dark">{{ $applicationInfo['cache_driver'] }}</span>
            </td>
        </tr>
        <tr>
            <th>@lang('Session Driver') :</th>
            <td class="text-right">
                <span class="badge badge-outline-dark">{{ $applicationInfo['session_driver'] }}</span>
            </td>
        </tr>
    </table>
</div>
