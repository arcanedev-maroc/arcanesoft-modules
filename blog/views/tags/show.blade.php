@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-tag"></i> @lang("Tag's Details")
@endsection

<?php /** @var  \Arcanesoft\Blog\Models\Tag  $tag */ ?>

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-borderless shadow-sm mb-3">
                <div class="card-header">@lang('Tag')</div>
                <table class="table table-md table-borderless mb-0">
                    <tbody>
                        <tr>
                            <th class="text-muted">@lang('Name') :</th>
                            <td class="text-right">{{ $tag->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">@lang('Slug') :</th>
                            <td class="text-right">{{ $tag->slug }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">@lang('Created At') :</th>
                            <td class="text-right"><small>{{ $tag->created_at }}</small></td>
                        </tr>
                        <tr>
                            <th class="text-muted">@lang('Updated At') :</th>
                            <td class="text-right"><small>{{ $tag->updated_at }}</small></td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-footer text-right p-2">
                    @can(Arcanesoft\Blog\Policies\TagsPolicy::ability('update'), $tag)
                        {{ arcanesoft\ui\action_link('edit', route('admin::blog.tags.edit', [$tag]))->size('sm') }}
                    @endcan

                    @can(Arcanesoft\Blog\Policies\TagsPolicy::ability('delete'), $tag)
                        {{ arcanesoft\ui\action_button('delete')->size('sm')->setDisabled($tag->isNotDeletable()) }}
                    @endcan
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-borderless shadow-sm mb-3">
                <div class="card-header">@lang('Posts')</div>
                <table class="table table-borderless table-hover mb-0">
                    <thead>
                        <tr>
                            <th>@lang('Title')</th>
                            <th class="text-right">@lang('Actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tag->posts as $post)
                            <?php /** @var  Arcanesoft\Blog\Models\Post  $post */ ?>
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td class="text-right">
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">@lang('The list is empty !')</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
