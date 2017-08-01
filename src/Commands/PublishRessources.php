<?php

namespace Naoray\Larablog\Commands;

use Illuminate\Console\Command;

class PublishRessources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larablog:publish {--force : Overwrite any existing files.}
                    {--tag=* : One or many tags that have assets you want to publish.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publishes all of Larablog and Larablog\'s dependent on 
                    package ressources, which includes public assets, configs and migrations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tag = $this->option('tag') ?: null;
        $force = $this->option('force') ?: false;

        $providers = collect(config('larablog.providers') ?: [])->push('Naoray\Larablog\LarablogServiceProvider');
        $providers->each(function ($provider) use ($tag, $force) {
            $this->call('vendor:publish', [
                '--provider' => $provider,
                '--tag' => $tag,
                '--force' => $force
            ]);
        });
    }
}
