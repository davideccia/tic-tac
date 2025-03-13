<?php

namespace Davideccia\TicTac\Commands;

use Illuminate\Console\Command;

class TicTacCommand extends Command
{
    public $signature = 'tic-tac';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
