<?php namespace Arcanesoft\Blog\Http\Transformers;

use Arcanesoft\Blog\Models\Post;
use Arcanesoft\Blog\Policies\PostsPolicy;
use function ui\action_button_icon;
use function ui\action_link_icon;

/**
 * Class     PostTransformer
 *
 * @package  Arcanesoft\Blog\Http\Transformers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PostTransformer extends AbstractTransformer
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the posts for datatable.
     *
     * @param  \Arcanesoft\Blog\Models\Post  $post
     *
     * @return array
     */
    public function transform(Post $post): array
    {
        $actions = static::getActions($post);

        return [
            'title'      => $post->title,
            'created_at' => $post->created_at->format('Y-m-d H:i:s'),
            'published'  => '<span class="status '.($post->isPublished() ? 'status-success status-animated' : 'status-secondary').'" data-toggle="tooltip" data-placement="top" title="'.($post->isPublished() ? __('Published') : __('Draft')).'"></span>',
            'actions'    => static::renderActions($actions),
        ];
    }

    private static function getActions(Post $post)
    {
        $actions = [];

        if (static::can(PostsPolicy::ability('show'), [$post]))
            $actions[] = action_link_icon('show', route('admin::blog.posts.show', [$post->id]))
                ->size('sm');

        if (static::can(PostsPolicy::ability('update'), [$post]))
            $actions[] = action_link_icon('edit', route('admin::blog.posts.edit', [$post->id]))
                ->size('sm');

        if (static::can(PostsPolicy::ability('delete'), [$post]))
            $actions[] = action_button_icon('delete')
                ->attributeIf($post->isDeletable(), 'onclick', "window.Foundation.\$emit('auth::posts.delete', ".json_encode(['id' => $post->id]).")")
                ->size('sm')
                ->setDisabled($post->isNotDeletable());

        return $actions;
    }
}
