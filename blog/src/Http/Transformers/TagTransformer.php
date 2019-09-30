<?php namespace Arcanesoft\Blog\Http\Transformers;

use Arcanesoft\Blog\Policies\TagsPolicy;
use Arcanesoft\Blog\Models\Tag;
use function ui\action_button_icon;
use function ui\action_link_icon;

/**
 * Class     TagTransformer
 *
 * @package  Arcanesoft\Blog\Http\Transformers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TagTransformer extends AbstractTransformer
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the posts for datatable.
     *
     * @param  \Arcanesoft\Blog\Models\Tag  $tag
     *
     * @return array
     */
    public function transform(Tag $tag): array
    {
        $actions = static::getActions($tag);

        return [
            'name'       => $tag->name,
            'posts'      => $tag->posts_count,
            'created_at' => $tag->created_at->format('Y-m-d H:i:s'),
            'actions'    => static::renderActions($actions),
        ];
    }

    /**
     * Get the actions.
     *
     * @param  \Arcanesoft\Blog\Models\Tag  $tag
     *
     * @return array
     */
    private static function getActions(Tag $tag): array
    {
        $actions = [];

        if (static::can(TagsPolicy::ability('show'), [$tag]))
            $actions[] = action_link_icon('show', route('admin::blog.tags.show', [$tag]))
                ->size('sm');

        if (static::can(TagsPolicy::ability('update'), [$tag]))
            $actions[] = action_link_icon('edit', route('admin::blog.tags.edit', [$tag]))
                ->size('sm');

        if (static::can(TagsPolicy::ability('delete'), [$tag]))
            $actions[] = action_button_icon('delete')
                ->size('sm')
                ->attributeIf($tag->isDeletable(), 'onclick', "window.Foundation.\$emit('blog::tags.delete', ".json_encode(['id' => $tag->getRouteKey()]).")")
                ->setDisabled($tag->isNotDeletable());

        return $actions;
    }
}
