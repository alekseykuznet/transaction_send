<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Illuminate\Console\Command;

class TransactionGenerate extends Command
{
    /**
     * @var string
     */
    protected $signature = 'transaction:generate';

    /**
     * @var string
     */
    protected $description = 'Generate transactions';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Start generate');

        $transactionCount = rand(1, 10);

        for ($i = 0; $i < $transactionCount; $i++) {
            $transaction = Transaction::generateTransaction();

            if ($transaction === null) {
                continue;
            }

            $transaction->addToTask();
        }

        $this->info('End');
    }
}
