<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreatePlanSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(config('subscriptions.tables.plan_subscriptions'), function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('subscriber');
            $table->integer('plan_id')->unsigned();
            $table->string('slug');
            $table->json('name');
            $table->json('description')->nullable();
            $table->dateTime('trial_ends_at')->nullable();
            $table->dateTime('starts_at')->nullable();
            $table->dateTime('ends_at')->nullable();
            $table->dateTime('cancels_at')->nullable();
            $table->dateTime('canceled_at')->nullable();
            $table->string('stripe_id')->unique();
            $table->string('stripe_status');
            $table->string('stripe_price')->nullable();
            $table->double('price')->nullable();
            $table->string('currency')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('status')->default('Waiting');
            $table->string('timezone')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->unique('slug');
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
        Schema::dropIfExists(config('subscriptions.tables.plan_subscriptions'));
    }
}