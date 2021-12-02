<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TaskRpc;

class TaskRpcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable(TaskRpc::getTableName())){
            Schema::create(TaskRpc::getTableName(), function (Blueprint $table) {
                $table->increments('id');
                $table->string('url');
                $table->string('sign');
                $table->string('request');
                $table->string('response')->nullable();
                $table->integer('attemp_count')->default(0);
                $table->integer('send')->default(TaskRpc::STATUS_NOT_SEND);
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists(TaskRpc::getTableName());
    }
}
