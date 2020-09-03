<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Console;

use Arcanesoft\Foundation\Support\Console\PublishCommand as Command;

/**
 * Class     PublishCommand
 *
 * @package  Arcanesoft\Foundation\Console
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PublishCommand extends Command
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'arcanesoft:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish all the ARCANESOFT modules';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the command.
     */
    public function handle()
    {
        $this->line('');
        $this->info('Publishing the modules...');

        foreach ($this->getTags() as $tag) {
            $this->comment("Publishing [{$tag}]");
            $this->callSilent('vendor:publish', ['--tag' => $tag]);
        }
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get tags to publish.
     *
     * @return array
     */
    protected function getTags(): array
    {
        return $this->laravel
            ->get('config')
            ->get('arcanesoft.foundation.modules.commands.publish.tags', []);
    }
}
