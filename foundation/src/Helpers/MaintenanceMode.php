<?php namespace Arcanesoft\Foundation\Helpers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Carbon;

/**
 * Class     MaintenanceMode
 *
 * @package  Arcanesoft\Foundation\Helpers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MaintenanceMode
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Illuminate\Contracts\Foundation\Application */
    protected $app;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * MaintenanceMode constructor.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the file path.
     *
     * @return string
     */
    public function path(): string
    {
        return storage_path('framework/down');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the down file data.
     *
     * @return array
     */
    public function data(): array
    {
        if ( ! $this->isDown())
            return [];

        $data = json_decode(file_get_contents($this->path()), true);

        if ($data['time'])
            $data['time'] = Carbon::createFromTimestamp($data['time']);

        return $data;
    }

    /**
     * Enabled the maintenance mode.
     *
     * @param  array        $allowed
     * @param  string|null  $message
     * @param  int|null     $retry
     */
    public function down(array $allowed, string $message = null, $retry = null)
    {
        $payload = [
            'time'    => Carbon::now()->getTimestamp(),
            'message' => $message,
            'retry'   => is_numeric($retry) && $retry > 0 ? (int) $retry : null,
            'allowed' => $allowed,
        ];

        file_put_contents(
            storage_path('framework/down'),
            json_encode($payload, JSON_PRETTY_PRINT)
        );
    }

    /**
     * Disable the maintenance mode.
     */
    public function up()
    {
        @unlink($this->path());
    }

    /**
     * Check if the maintenance mode is enabled.
     *
     * @return bool
     */
    public function isDown(): bool
    {
        return file_exists($this->path());
    }

    /**
     * Check if the maintenance mode is disabled.
     *
     * @return bool
     */
    public function isUp()
    {
        return ! $this->isDown();
    }
}
