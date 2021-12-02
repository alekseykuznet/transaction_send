<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * @package App\Models
 * @property int $id
 * @property int $client_id
 * @property double $sum
 * @property double $commision
 * @property string $order_number
 * @property string $created_at
 * @property string $updated_at
 */
class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    protected $dates = [
        'create_at',
        'updated_at',
    ];

    protected $fillable = [
        'client_id',
        'sum',
        'commision',
        'order_number',
        'send'
    ];

    public const ORDER_NUMBER_PREFIX = 'TS';
    public const ORDER_NUMBER_START_NUMBER = 1;
    public const ORDER_NUMBER_LENGTH = 5;

    /**
     * @return mixed
     */
    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    public static function generateTransaction()
    {
        $orderNumber = self::getLastNumber();
        $commisionPercent = rand(0.5, 2);

        $transaction = new Transaction();

        $transaction->client_id = rand(0, 20);
        $transaction->sum = rand(10, 500);
        $transaction->commision = $commisionPercent;
        $transaction->order_number = $orderNumber;

        if ($transaction->save() === null) {
            return null;
        }

        return $transaction;
    }

    /**
     * @return string
     */
    private static function getLastNumber(): string
    {
        $lastTransaction = self::orderByDesc('id')->first();

        $number = self::ORDER_NUMBER_START_NUMBER;
        if ($lastTransaction !== null) {
            $number = intval(str_replace(self::ORDER_NUMBER_PREFIX, '', $lastTransaction->order_number)) + 1;
        }

        $digitArray = array_reverse(preg_split('//', $number, -1, PREG_SPLIT_NO_EMPTY));

        return self::ORDER_NUMBER_PREFIX . implode('', array_reverse(array_pad($digitArray, self::ORDER_NUMBER_LENGTH, 0)));
    }

    /**
     * @return bool
     */
    public function addToTask(): bool
    {

        $new_key_pair = openssl_pkey_new(array(
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        ));
        openssl_pkey_export($new_key_pair, $private_key_pem);

        $details = openssl_pkey_get_details($new_key_pair);
        $public_key_pem = $details['key'];

        $taskSend = new TaskRpc();

        $taskSend->url = env('SERVICE_SEND_URL');
        $taskSend->request = $this->toJson();
        $taskSend->sign = '1';

        return $taskSend->save();
    }
}
