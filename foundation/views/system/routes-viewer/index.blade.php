@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-map-signs"></i> @lang('Routes Viewer')
@endsection

@section('content')
    <div class="card card-borderless shadow-sm">
        <div class="card-header">@lang('Routes')</div>
        <table class="table table-hover table-md mb-0">
            <thead>
                <tr>
                    <th>@lang('Method')</th>
                    <th>@lang('Domain')</th>
                    <th>@lang('URI') / @lang('Name') / @lang('Action')</th>
                    <th>@lang('Middleware')</th>
                </tr>
            </thead>
            <tbody>
            @foreach($routes as $route)
                <?php /** @var  Arcanedev\RouteViewer\Entities\Route  $route */ ?>
                <tr>
                    <td>
                        @foreach ($route->methods as $method)
                            <span class="badge badge-outline-{{ $method['color'] }}">{{ $method['name'] }}</span>
                        @endforeach
                    </td>
                    <td>
                        <span class="badge badge-outline-secondary">{{ $route->domain ?? '--' }}</span>
                    </td>
                    <td>
                        <small>{!! preg_replace('#({[^}]+})#', '<span class="text-danger">$1</span>', $route->uri) !!}</small>
                        <br>
                        <small class="font-weight-semibold">{{ $route->hasName() ? $route->name : '--' }}</small>
                        <br>
                        <small>
                            @if ($route->isClosure())
                                <span class="label label-default">{{ $route->action }}</span>
                            @else
                                {!! preg_replace('#(@.*)$#', '<span class="text-success">$1</span>', $route->action) !!}
                            @endif
                        </small>
                    </td>
                    <td>
                        @foreach($route->middleware as $middleware)
                            <span class="badge badge-outline-secondary">{{ $middleware }}</span>
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
