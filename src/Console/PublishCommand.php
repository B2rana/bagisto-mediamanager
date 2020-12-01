<?php

namespace Ridhima\MediaManager\Console;

use Barryvdh\Elfinder\Console\PublishCommand as Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mediamanager:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the mediamanager assets';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $package = 'mediamanager';
        $destination = $this->publishPath . "/vendor/{$package}";

        if ( ! is_null($path = $this->getElfinderPath())) {
            if ($this->files->exists($destination)) {
                $this->files->deleteDirectory($destination);
                $this->info('Old published Assets have been removed');
            }
            $copyElfinder = $this->copyElfinderFiles($destination);
        } else {
            $copyElfinder = false;
            $this->error('Could not find elfinder path');
        }

        if ( ! is_null($path = $this->getPath())) {
            $copyPublic = $this->files->copyDirectory($path, $destination);
        } else {
            $copyPublic = false;
            $this->error('Could not find public path');
        }

        if ($copyElfinder && $copyPublic) {
            $this->info('Published assets to: '.$package);
        } else {
            $this->error('Could not publish alles assets for '.$package);
        }
    }
}
