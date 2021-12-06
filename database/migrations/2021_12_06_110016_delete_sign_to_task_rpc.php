<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TaskRpc;

class DeleteSignToTaskRpc extends Migration
{
    private const COLUMN_SIGN = 'sign';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn(TaskRpc::getTableName(), self::COLUMN_SIGN)) {
            Schema::table(TaskRpc::getTableName(), function (Blueprint $table) {
                $table->dropColumn(self::COLUMN_SIGN);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
