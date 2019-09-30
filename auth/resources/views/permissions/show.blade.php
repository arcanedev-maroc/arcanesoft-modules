@extends(foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-shield-alt"></i> @lang("Permission's details")
@endsection

<?php
/** @var  Arcanesoft\Auth\Models\Permission  $permission */
?>

@section('content')
    <div class="row">
        <div class="col-lg-5 col-lg-4">
            <div class="card card-borderless shadow-sm mb-3">
                <div class="card-header p-2">@lang('Permission')</div>
                <table class="table table-borderless table-md mb-0">
                    <tbody>
                        <tr>
                            <th class="text-muted">@lang('Group') :</th>
                            <td class="text-right">{{ $permission->group->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">@lang('Category') :</th>
                            <td class="text-right">{{ $permission->category }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">@lang('Name') :</th>
                            <td class="text-right">{{ $permission->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">@lang('Description') :</th>
                            <td class="text-right"><small>{{ $permission->description }}</small></td>
                        </tr>
                        <tr>
                            <th class="text-muted">@lang('Roles') :</th>
                            <td class="text-right">
                                {{ ui\count_pill($permission->roles->count()) }}
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted">@lang('Users') :</th>
                            <td class="text-right">
                                {{ ui\count_pill($permission->users_count) }}
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted">@lang('Created at') :</th>
                            <td class="text-right"><small class="text-muted">{{ $permission->created_at }}</small></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('modals')
@endpush

@push('scripts')
@endpush
