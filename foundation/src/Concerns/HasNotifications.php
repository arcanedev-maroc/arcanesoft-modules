<?php namespace Arcanesoft\Foundation\Concerns;

/**
 * Trait     HasNotifications
 *
 * @package  Arcanesoft\Foundation\Concerns
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasNotifications
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make a success notification.
     *
     * @param  string  $message
     * @param  string  $content
     * @param  array   $extra
     *
     * @return \Arcanedev\Notify\Contracts\Notify
     */
    protected function notifySuccess(string $message, string $content, array $extra = [])
    {
        return $this->notify($message, 'success', array_merge($extra, compact('content')));
    }

    /**
     * Make a danger notification.
     *
     * @param  string  $message
     * @param  string  $content
     * @param  array   $extra
     *
     * @return \Arcanedev\Notify\Contracts\Notify
     */
    protected function notifyError(string $message, string $content, array $extra = [])
    {
        return $this->notify($message, 'danger', array_merge($extra, compact('content')));
    }

    /**
     * Make a warning notification.
     *
     * @param  string  $message
     * @param  string  $content
     * @param  array   $extra
     *
     * @return \Arcanedev\Notify\Contracts\Notify
     */
    protected function notifyWarning(string $message, string $content, array $extra = [])
    {
        return $this->notify($message, 'warning', array_merge($extra, compact('content')));
    }

    /**
     * Make a info notification.
     *
     * @param  string  $message
     * @param  string  $content
     * @param  array   $extra
     *
     * @return \Arcanedev\Notify\Contracts\Notify
     */
    protected function notifyInfo(string $message, string $content, array $extra = [])
    {
        return $this->notify($message, 'info', array_merge($extra, compact('content')));
    }

    /**
     * Make a notification.
     *
     * @param  string  $message
     * @param  string  $type
     * @param  array   $extra
     *
     * @return \Arcanedev\Notify\Contracts\Notify
     */
    protected function notify(string $message, string $type, array $extra = [])
    {
        return notify()->flash($message, $type, $extra);
    }
}
