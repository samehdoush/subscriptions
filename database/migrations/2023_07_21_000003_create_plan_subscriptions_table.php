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

        if (!Schema::hasTable(config('subscriptions.tables.plan_subscriptions'))) {

            Schema::create(config('subscriptions.tables.plan_subscriptions'), $this->blueprint());
        } else {
            Schema::table(config('subscriptions.tables.plan_subscriptions'), $this->blueprint());
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {

        Schema::dropIfExists(config('subscriptions.tables.plan_subscriptions'));
    }


    public function blueprint(): Closure
    {

        $TABLE = config('subscriptions.tables.plan_subscriptions');
        return  function (Blueprint $table) use ($TABLE) {

            if (!Schema::hasColumn($TABLE, 'id')) {
                $table->increments('id');
            }



            if (!Schema::hasColumn($TABLE, 'subscriber_id')) {
                $table->morphs('subscriber');
            }


            if (!Schema::hasColumn($TABLE, 'plan_id')) {
                $table->integer('plan_id')->unsigned();
            }

            if (!Schema::hasColumn($TABLE, 'slug')) {
                $table->string('slug');
            }

            if (!Schema::hasColumn($TABLE, 'name')) {
                $table->json('name');
            }

            if (!Schema::hasColumn($TABLE, 'description')) {
                $table->json('description')->nullable();
            }

            if (!Schema::hasColumn($TABLE, 'trial_ends_at')) {
                $table->dateTime('trial_ends_at')->nullable();
            }

            if (!Schema::hasColumn($TABLE, 'starts_at')) {
                $table->dateTime('starts_at')->nullable();
            }

            if (!Schema::hasColumn($TABLE, 'ends_at')) {
                $table->dateTime('ends_at')->nullable();
            }

            if (!Schema::hasColumn($TABLE, 'cancels_at')) {
                $table->dateTime('cancels_at')->nullable();
            }

            if (!Schema::hasColumn($TABLE, 'canceled_at')) {
                $table->dateTime('canceled_at')->nullable();
            }


            if (!Schema::hasColumn($TABLE, 'price')) {
                $table->double('price')->nullable();
            }


            if (!Schema::hasColumn($TABLE, 'currency')) {
                $table->string('currency')->nullable();
            }

            if (!Schema::hasColumn($TABLE, 'timezone')) {
                $table->string('timezone')->nullable();
            }



            if (!Schema::hasColumn($TABLE, 'created_at')) {
                $table->timestamps();
            }


            if (!Schema::hasColumn($TABLE, 'deleted_at')) {
                $table->softDeletes();
            }


            // Indexes
            // $table->unique('slug');
            if (!Schema::hasIndex($TABLE, 'plan_id')) {
                $table->foreign('plan_id')->references('id')->on(config('subscriptions.tables.plans'))
                    ->onDelete('cascade')->onUpdate('cascade');
            }
        };
    }
};
