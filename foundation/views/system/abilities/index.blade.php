@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-user-shield"></i> @lang('Abilities')
@endsection

<?php /** @var  Illuminate\Support\Collection  $abilities */ ?>

@section('content')
    @include('foundation::system._includes.system-nav')

    <div class="card card-borderless shadow-sm">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>@lang('Ability')</th>
                    <th>@lang('Name')</th>
                    <th>@lang('Description')</th>
                    <th class="text-center">@lang('Registered')</th>
                    <th class="text-right">@lang('Action')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($abilities as $key => $ability)
                    <?php /** @var  Arcanedev\LaravelPolicies\Ability  $ability */ ?>
                    <tr>
                        <td>
                            <span class="badge badge-outline-dark">{{ $key }}</span>
                        </td>
                        <td>{{ $ability->meta('name', '') }}</td>
                        <td>
                            <small>{{ $ability->meta('description', '') }}</small>
                        </td>
                        <td class="text-center">
                            @if ($ability->meta('is_registered', false))
                                <span class="status status-success status-animated" data-toggle="tooltip" data-placement="top" title="@lang('Yes')"></span>
                            @else
                                <span class="status status-secondary" data-toggle="tooltip" data-placement="top" title="@lang('No')"></span>
                            @endif
                        </td>
                        <td class="text-right">
                            @can(Arcanesoft\Foundation\System\Policies\AbilitiesPolicy::ability('show'))
                            {{ arcanesoft\ui\action_link_icon('show', route('admin::system.abilities.show', $ability->key()))->size('sm') }}
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">@lang('The list is empty !')</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
