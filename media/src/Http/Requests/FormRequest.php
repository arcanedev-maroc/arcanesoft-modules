<?php namespace Arcanesoft\Media\Http\Requests;

use Arcanedev\Support\Http\FormRequest as BaseFormRequest;
use Arcanesoft\Media\MediaManager;

/**
 * Class     FormRequest
 *
 * @package  Arcanesoft\Media\Http\Requests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class FormRequest extends BaseFormRequest
{
    /* -----------------------------------------------------------------
     |  Common Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the media manager instance.
     *
     * @return \Arcanesoft\Media\MediaManager
     */
    protected static function getMediaManager()
    {
        return app(MediaManager::class);
    }
}
