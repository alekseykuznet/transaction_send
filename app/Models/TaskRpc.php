<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * @package App\Models
 * @property int $id
 * @property string $url
 * @property string $request
 * @property string $response
 * @property int $attemp_count
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class TaskRpc extends Model
{
    use HasFactory;

    protected $table = 'task_rpc';

    protected $dates = [
        'create_at',
        'updated_at',
    ];

    protected $fillable = [
        'url',
        'request',
        'response',
        'attemp_count',
        'status',
    ];

    public const STATUS_NOT_SEND = 0;
    public const STATUS_SEND = 1;

    public const STATUS_SEND_OK = 200;

    /**
     * @return mixed
     */
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
