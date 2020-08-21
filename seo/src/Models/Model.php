<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * Class     AbstractModel
 *
 * @package  Arcanesoft\Seo\Models
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
        $this->setConnection(config('arcanesoft.seo.database.connection'));

        parent::__construct($attributes);
    }
}