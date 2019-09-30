@extends(foundation()->template())

@section('page-title')
    <i class="far fa-fw fa-user-edit"></i> {{ __('Authors') }}
@endsection

<?php
/** @var  Arcanesoft\Blog\Models\Author  $author */
?>

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-borderless shadow-sm mb-3">
                <div class="card-header">{{ __('Author') }}</div>
                <table class="table table-md table-borderless mb-0">
                    <tbody>
                        <tr>
                            <th>{{ __('Username') }} :</th>
                            <td class="text-right">{{ $author->username }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Slug') }} :</th>
                            <td class="text-right">{{ $author->slug }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">{{ __('Bio') }} :</th>
                        </tr>
                        <tr>
                            <td>
                                {{ $author->bio }}
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('Created at') }} :</th>
                            <td class="text-right"><small class="text-muted">{{ $author->created_at }}</small></td>
                        </tr>
                        <tr>
                            <th>{{ __('Updated at') }} :</th>
                            <td class="text-right"><small class="text-muted">{{ $author->updated_at }}</small></td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-footer p-2 text-right">
                    @can(Arcanesoft\Blog\Policies\AuthorsPolicy::ability('update'), $author)
                        {{ ui\action_link('edit', route('admin::auth.users.edit', [$author]))->size('sm') }}
                    @endcan

                    @can(Arcanesoft\Blog\Policies\AuthorsPolicy::ability('delete'), $author)
                        {{ ui\action_button('delete')->attribute('onclick', "window.Foundation.\$emit('blog::authors.delete')")->size('sm')->setDisabled($author->isNotDeletable()) }}
                    @endcan
                </div>
            </div>
        </div>
        <div class="col-md-6">
            @include('auth::_partials.users.card-details', ['user' => $author->user])
        </div>
    </div>
@endsection
