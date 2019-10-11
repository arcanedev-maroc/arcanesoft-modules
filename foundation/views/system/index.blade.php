@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-info-circle"></i> @lang('System Information')
@endsection

@section('content')
    @include('foundation::system._includes.system-nav')

    <div class="row">
        <div class="col-lg-4">
            @include(Arcanesoft\Foundation\System\ViewComposers\ApplicationInfoComposer::VIEW)
        </div>
        <div class="col-lg-4">
            @include(Arcanesoft\Foundation\System\ViewComposers\FoldersPermissionsComposer::VIEW)
        </div>
        <div class="col-lg-4">
            @include(Arcanesoft\Foundation\System\ViewComposers\RequiredPhpExtensionsComposer::VIEW)
        </div>
    </div>
@endsection

@section('scripts')
@endsection
