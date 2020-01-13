@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-cog"></i> @lang('Settings')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header">@lang('Authentication')</div>
                <table class="table table-borderless mb-0">
                    <tr>
                        <th class="table-th">@lang('Login') :</th>
                        <td class="text-right">
                            @if ($authentication['login']['enabled'])
                                <span class="badge badge-outline-success">Enabled</span>
                            @else
                                <span class="badge badge-outline-danger">Disabled</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="table-th">@lang('Register') :</th>
                        <td class="text-right">
                            @if ($authentication['register']['enabled'])
                                <span class="badge badge-outline-success">Enabled</span>
                            @else
                                <span class="badge badge-outline-danger">Disabled</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="table-th">@lang('Socialite') :</th>
                        <td class="text-right">
                            @if ($authentication['socialite']['enabled'])
                                <span class="badge badge-outline-success">Enabled</span>
                            @else
                                <span class="badge badge-outline-danger">Disabled</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            @if ($authentication['socialite']['enabled'])
            <div class="card shadow-sm mb-4">
                <div class="card-header">@lang('Socialite')</div>
                <table class="table table-borderless mb-0">
                    @foreach($authentication['socialite']['drivers'] as $driver)
                    <tr>
                        <th class="table-th">{{ $driver }}</th>
                        <td class="text-right">
                            <span class="badge badge-outline-success">Enabled</span>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            @endif
        </div>
    </div>
@endsection
