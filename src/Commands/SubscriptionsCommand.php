<?php

namespace Samehdoush\Subscriptions\Commands;

use Illuminate\Console\Command;

class SubscriptionsCommand extends Command
{
    public $signature = 'subscriptions';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
