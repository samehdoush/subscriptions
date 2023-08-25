<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(config('subscriptions.tables.plan_features'), function (Blueprint $table) {
            // Columns
            $table->increments('id');
            $table->integer('plan_id')->unsigned();
            $table->string('slug')->index();
            $table->json('name');
            $table->json('description')->nullable();
            $table->string('value');
            $table->integer('resettable_period')->unsigned()->default(0);
            $table->string('resettable_interval')->default('month');
            $table->mediumInteger('sort_order')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            // $table->unique(['plan_id']);
            $table->foreign('plan_id')->references('id')->on(config('subscriptions.tables.plans'))
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(config('subscriptions.tables.plan_features'));
    }
};
