<?php

namespace App\Console\Commands;

use App\Models\TaskRpc;
use App\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TaskSend extends Command
{
    /**
     * @var string
     */
    protected $signature = 'task:send';

    /**
     * @var string
     */
    protected $description = 'send transactions';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Start send');

        $taskRpcs = TaskRpc::where('send', TaskRpc::STATUS_NOT_SEND)
            ->get();

        $this->info(sprintf('%s: $s', 'All transaction: ', count($taskRpcs)));
        foreach ($taskRpcs as $taskRpc) {

            $decode = json_decode($taskRpc->request);
            if ($decode === null) {
                continue;
            }

            $response = Http::post($taskRpc->url, (array) $decode);
            $taskRpc->response = $response->body();

            if ($response->status() !== TaskRpc::STATUS_SEND_OK) {
                $taskRpc->attemp_count += 1;
            } else {
                $taskRpc->send = TaskRpc::STATUS_SEND;
            }

            $taskRpc->save();
        }

        $this->info('End');
    }
}
