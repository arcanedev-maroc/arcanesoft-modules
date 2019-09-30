<?php namespace Arcanesoft\Blog\Base;

use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * Class     Model
 *
 * @package  Arcanesoft\Blog\Base
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Model extends BaseModel
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setConnection(config('arcanesoft.blog.database.connection'));

        parent::__construct($attributes);
    }
}
