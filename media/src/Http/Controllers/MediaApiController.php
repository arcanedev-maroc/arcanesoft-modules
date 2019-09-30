<?php namespace Arcanesoft\Media\Http\Controllers;

use Arcanesoft\Media\Entities\MediaItem;
use Arcanesoft\Media\Http\Requests\NewFolderRequest;
use Arcanesoft\Media\Http\Requests\RenameMediaRequest;
use Arcanesoft\Media\Http\Requests\UploadMediaRequest;
use Illuminate\Http\Request;

/**
 * Class     MediaApiController
 *
 * @package  Arcanesoft\Media\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MediaApiController extends Controller
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function all(Request $request)
    {
        // TODO: Add authorization check

        $location = $request->get('location', '/');

        if ( ! $this->manager->exists($location))
            return static::jsonResponseError(['message' => 'Location not found'], 404);

        return static::jsonResponse(
            $this->manager->all($location)->values()
        );
    }

    public function directories(Request $request)
    {
        // TODO: Add authorization check
        $location = $request->get('location', '/');

        if ( ! $this->manager->exists($location))
            return static::jsonResponseError(['message' => 'Location not found'], 404);

        return static::jsonResponse(
            $this->manager->directories($location)->values()
        );
    }

    public function upload(UploadMediaRequest $request)
    {
        // TODO: Add authorization check

        $url = $this->manager->putFile(
            $request->get('location'),
            $request->file('files')[0]
        );

        return static::jsonResponse(
            compact('url')
        );
    }

    public function newFolder(NewFolderRequest $request)
    {
        // TODO: Add authorization check

        $this->manager->makeDirectory(
            $path = $request->get('path')
        );

        return static::jsonResponse(
            compact('path')
        );
    }

    public function move(Request $request)
    {
        $from        = $request->get('path');
        $destination = $request->get('destination');

        $parts = explode('/', $from);
        $file  = array_pop($parts);
        $to    = implode('/', array_merge($parts, [$destination], [$file]));

        $this->manager->move($from, $to);

        return static::jsonResponse();
    }

    public function rename(RenameMediaRequest $request)
    {
        // TODO: Add authorization check

        $this->manager->rename(
            $request->get('old_path'),
            $request->get('new_path')
        );

        return static::jsonResponse();
    }

    public function delete(Request $request)
    {
        // TODO: Add authorization check

        $type = $request->get('type');
        $path = $request->get('path');

        if ($type === MediaItem::TYPE_FILE)
            $this->manager->deleteFile($path);
        elseif ($type === MediaItem::TYPE_DIRECTORY)
            $this->manager->deleteDirectory($path);
        else {
            // TODO: Throw an exception ?
        }

        return static::jsonResponse();
    }

    public function download(Request $request)
    {
        return $this->manager->download(
            $request->get('path')
        );
    }
}
