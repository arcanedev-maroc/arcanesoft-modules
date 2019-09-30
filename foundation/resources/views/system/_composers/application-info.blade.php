<div class="card card-borderless shadow-sm mb-3">
    <div class="card-header p-2">{{ __('Application') }}</div>
    <table class="table table-md mb-0">
        <tr>
            <th>{{ __('URL') }}: </th>
            <td class="text-right small">{{ $applicationInfo['url'] }}</td>
        </tr>
        <tr>
            <th>{{ __('Locale') }}: </th>
            <td class="text-right">
                <span class="badge badge-outline-primary">{{ $applicationInfo['locale'] }}</span>
            </td>
        </tr>
        <tr>
            <th>{{ __('Timezone') }}: </th>
            <td class="text-right">
                <span class="badge badge-outline-primary">{{ $applicationInfo['timezone'] }}</span>
            </td>
        </tr>
        <tr>
            <th>{{ __('Debug Mode') }}: </th>
            <td class="text-right">
                @if ($applicationInfo['debug_mode'])
                    <span class="badge badge-outline-danger">
                        <i class="fas fa-fw fa-exclamation-triangle text-danger"></i> {{ __('Enabled') }}
                    </span>
                @else
                    <span class="badge badge-outline-success">{{ __('Disabled') }}</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>{{ __('Maintenance Mode') }}: </th>
            <td class="text-right">
                @if ($applicationInfo['maintenance_mode'])
                    <span class="badge badge-outline-danger">
                        <i class="fas fa-fw fa-exclamation-triangle text-danger"></i> {{ __('Enabled') }}
                    </span>
                @else
                    <span class="badge badge-outline-success">{{ __('Disabled') }}</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>{{ __('PHP Version') }}: </th>
            <td class="text-right">
                <span class="badge badge-outline-primary">{{ $applicationInfo['php_version'] }}</span>
            </td>
        </tr>
        <tr>
            <th>{{ __('Laravel Version') }}: </th>
            <td class="text-right">
                <span class="badge badge-outline-primary">{{ $applicationInfo['laravel_version'] }}</span>
            </td>
        </tr>
        <tr>
            <th>{{ __('ARCANESOFT Version') }}: </th>
            <td class="text-right">
                <span class="badge badge-outline-primary">{{ $applicationInfo['foundation_version'] }}</span>
            </td>
        </tr>
        <tr>
            <th>{{ __('Database Driver') }}: </th>
            <td class="text-right">
                <span class="badge badge-outline-dark">{{ $applicationInfo['database_connection'] }}</span>
            </td>
        </tr>
        <tr>
            <th>{{ __('Cache Driver') }}: </th>
            <td class="text-right">
                <span class="badge badge-outline-dark">{{ $applicationInfo['cache_driver'] }}</span>
            </td>
        </tr>
        <tr>
            <th>{{ __('Session Driver') }}: </th>
            <td class="text-right">
                <span class="badge badge-outline-dark">{{ $applicationInfo['session_driver'] }}</span>
            </td>
        </tr>
    </table>
</div>
