<?php

namespace Rawilk\LaravelCasters\Commands;

use Illuminate\Console\Command;

class LaravelCastersCommand extends Command
{
    public $signature = 'laravel-casters';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
