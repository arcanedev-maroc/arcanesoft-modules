<?php namespace Arcanesoft\Blog\Http\Transformers;

use Arcanesoft\Blog\Models\Author;
use Arcanesoft\Blog\Policies\AuthorsPolicy;
use Arcanesoft\Foundation\Helpers\UI\Actions\ButtonAction;
use Arcanesoft\Foundation\Helpers\UI\Actions\LinkAction;
use function arcanesoft\ui\action_link_icon;

/**
 * Class     AuthorTransformer
 *
 * @package  Arcanesoft\Blog\Http\Transformers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthorTransformer extends AbstractTransformer
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the authors for datatable.
     *
     * @param  \Arcanesoft\Blog\Models\Author  $author
     *
     * @return array
     */
    public function transform(Author $author): array
    {
        $actions = static::getActions($author);

        return [
            'full_name'  => $author->full_name,
            'username'   => $author->username,
            'posts'      => $author->posts_count,
            'created_at' => $author->created_at->format('Y-m-d H:i:s'),
            'actions'    => static::renderActions($actions),
        ];
    }

    /**
     * Get the datatable's actions.
     *
     * @param  \Arcanesoft\Blog\Models\Author  $author
     *
     * @return array
     */
    private static function getActions(Author $author): array
    {
        $actions = [];

        if (static::can(AuthorsPolicy::ability('show'), [$author]))
            $actions[] = LinkAction::action('show', route('admin::blog.authors.show', [$author]), false)
                ->size('sm');

        if (static::can(AuthorsPolicy::ability('update'), [$author]))
            $actions[] = LinkAction::action('edit', route('admin::blog.authors.edit', [$author]), false)
                ->size('sm');

        if (static::can(AuthorsPolicy::ability('delete'), [$author]))
            $actions[] = ButtonAction::action('delete', false)
                ->attributeIf($author->isDeletable(), 'onclick', "window.Foundation.\$emit('auth::authors.delete', ".json_encode(['id' => $author]).")")
                ->size('sm')
                ->setDisabled($author->isNotDeletable());

        return $actions;
    }
}
