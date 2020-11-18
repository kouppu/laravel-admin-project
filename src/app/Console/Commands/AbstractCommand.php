<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

abstract class AbstractCommand extends Command
{
    protected function start()
    {
        $this->info("START");
        Log::info(get_class($this), ['message' => 'START']);
    }

    protected function end()
    {
        $this->info("END");
        Log::info(get_class($this), ['message' => 'END']);
        exit();
    }
}
