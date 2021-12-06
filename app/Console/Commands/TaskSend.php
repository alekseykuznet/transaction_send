<?php

namespace App\Console\Commands;

use App\Classes\Settings;
use App\Models\TaskRpc;
use App\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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

        $privateKey = Settings::get();
        if ($privateKey === '') {
            return;
        }

        $privateKey = openssl_pkey_get_private($privateKey);

        $taskRpcs = TaskRpc::where('send', TaskRpc::STATUS_NOT_SEND)
            ->get();

        $this->info(sprintf('%s: %s', 'All transaction: ', count($taskRpcs)));
        foreach ($taskRpcs as $taskRpc) {

            $getSignature = openssl_sign($taskRpc->request, $signature, $privateKey, OPENSSL_ALGO_SHA256);
            if ($getSignature == false) {
                continue;
            }

            $decode = json_decode($taskRpc->request);
            if ($decode === null) {
                continue;
            }

            $response = Http::withBody($signature, 'application/text')
                ->get($taskRpc->url, (array) $decode);

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
