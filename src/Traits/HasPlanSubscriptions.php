<?php

declare(strict_types=1);

namespace Samehdoush\Subscriptions\Traits;

use Carbon\Carbon;
use Samehdoush\Subscriptions\Models\Plan;
use Samehdoush\Subscriptions\Services\Period;
use Illuminate\Database\Eloquent\Collection;
use Samehdoush\Subscriptions\Models\PlanSubscription;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasPlanSubscriptions
{
    /**
     * Define a polymorphic one-to-many relationship.
     *
     * @param string $related
     * @param string $name
     * @param string $type
     * @param string $id
     * @param string $localKey
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    abstract public function morphMany($related, $name, $type = null, $id = null, $localKey = null);

    /**
     * Boot the HasPlanSubscriptions trait for the model.
     *
     * @return void
     */
    protected static function bootHasSubscriptions()
    {
        static::deleted(function ($plan) {
            $plan->planSubscriptions()->delete();
        });
    }

    /**
     * The subscriber may have many plan subscriptions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function planSubscriptions(): MorphMany
    {
        return $this->morphMany(config('subscriptions.models.plan_subscription'), 'subscriber', 'subscriber_type', 'subscriber_id');
    }

    /**
     * A model may have many active plan subscriptions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function activePlanSubscriptions(): Collection
    {
        return $this->planSubscriptions->reject->inactive();
    }

    /**
     * Get a plan subscription by slug.
     *
     * @param string $subscriptionSlug
     *
     * @return \Samehdoush\Subscriptions\Models\PlanSubscription|null
     */
    public function planSubscription(string $subscriptionSlug): ?PlanSubscription
    {
        return $this->planSubscriptions()->where('slug', $subscriptionSlug)->first();
    }
    public function planSubscriptionActive(string $subscriptionSlug): ?PlanSubscription
    {
        return $this->planSubscriptions()->whereNull('canceled_at')->where('ends_at')->where('slug', $subscriptionSlug)->first();
    }

    /**
     * Get subscribed plans.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function subscribedPlans(): Collection
    {
        $planIds = $this->planSubscriptions->reject->inactive()->pluck('plan_id')->unique();

        return Plan::whereIn('id', $planIds)->get();
    }

    /**
     * Check if the subscriber subscribed to the given plan.
     *
     * @param int $planId
     *
     * @return bool
     */
    public function subscribedTo($planId): bool
    {
        $subscription = $this->planSubscriptions()->where('plan_id', $planId)->first();

        return $subscription && $subscription->active();
    }

    /**
     * Subscribe subscriber to a new plan.
     *
     * @param string                            $subscription
     * @param \Samehdoush\Subscriptions\Models\Plan $plan
     * @param \Carbon\Carbon|null               $startDate
     *
     * @return \Samehdoush\Subscriptions\Models\PlanSubscription
     */
    public function newPlanSubscription($subscription, Plan $plan, Carbon $startDate = null): PlanSubscription
    {
        $trial = new Period($plan->trial_interval, $plan->trial_period, $startDate ?? now());
        $period = new Period($plan->invoice_interval, $plan->invoice_period, $trial->getEndDate());

        return $this->planSubscriptions()->create([
            'name' => $subscription,
            'plan_id' => $plan->getKey(),
            'trial_ends_at' => $trial->getEndDate(),
            'starts_at' => $period->getStartDate(),
            'ends_at' => $period->getEndDate(),
        ]);
    }
    public function newPlanSubscriptionWithOutTrail($subscription, Plan $plan, Carbon $startDate = null): PlanSubscription
    {

        $period = new Period($plan->invoice_interval, $plan->invoice_period, $startDate ?? now());

        return $this->planSubscriptions()->create([
            'name' => $subscription,
            'plan_id' => $plan->getKey(),
            'starts_at' => $period->getStartDate(),
            'ends_at' => $period->getEndDate(),
        ]);
    }
}
