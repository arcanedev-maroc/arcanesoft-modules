<?php namespace Arcanesoft\Blog\Http\Controllers\Datatables;

use Arcanesoft\Blog\Http\Transformers\TagTransformer;
use Arcanesoft\Blog\Repositories\TagsRepository;

/**
 * Class     TagsController
 *
 * @package  Arcanesoft\Blog\Http\Controllers\Datatables
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TagsController
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index(TagsRepository $tagsRepo)
    {
        $query = $tagsRepo->query()->withCount(['posts']);

        return datatables()->eloquent($query)
            ->setTransformer(new TagTransformer)
            ->make(true);
    }
}
