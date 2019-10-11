<div class="card card-borderless shadow-sm mb-3">
    <div class="card-header p-2">@lang('Required PHP Extensions')</div>
    <table class="table table-md mb-0">
        @foreach($requiredPhpExtensions as $extension => $loaded)
        <tr>
            <th>{{ $extension }}</th>
            <td class="text-right">
                @if ($loaded)
                    <span class="badge badge-outline-success">
                        <i class="fas fa-fw fa-check text-success"></i>
                    </span>
                @else
                    <span class="badge badge-outline-danger">
                        <i class="fas fa-fw fa-times text-danger"></i>
                    </span>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>
