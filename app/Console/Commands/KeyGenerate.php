<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class KeyGenerate extends Command
{
    /**
     * @var string
     */
    protected $signature = 'key:generate';

    /**
     * @var string
     */
    protected $description = 'Generate private keys';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Start');

        $keyPair = openssl_pkey_new(array(
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        ));

        openssl_pkey_export($keyPair, $privateKey);

        $details = openssl_pkey_get_details($keyPair);
        $publicKey = $details['key'];

        Storage::disk('local')->put(env('PRIVATE_FILENAME'), $privateKey);
        Storage::disk('local')->put(env('PUBLIC_FILENAME'), $publicKey);



        $this->info('End');
    }
}
