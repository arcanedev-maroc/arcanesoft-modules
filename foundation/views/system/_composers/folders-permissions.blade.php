<div class="card card-borderless shadow-sm mb-3">
    <div class="card-header p-2">@lang('Folders Permissions')</div>
    <table class="table table-md mb-0">
        @foreach($foldersPermissions as $folder => $permission)
        <tr>
            <th>{{ $folder }}</th>
            <td class="text-right">
                @if ($permission['writable'])
                    <span class="badge badge-outline-success">{{ $permission['chmod'] }}</span>
                    <span class="badge badge-outline-success"><i class="fa fa-fw fa-check text-success"></i></span>
                @else
                    <span class="badge badge-outline-danger">{{ $permission['chmod'] }}</span>
                    <span class="badge badge-outline-danger"><i class="fa fa-fw fa-times text-danger"></i></span>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>
