<?php

// config for Samehdoush/Subscriptions
return [
    // Subscriptions Database Tables
    'tables' => [

        'plans' => 'plans',
        'plan_features' => 'plan_features',
        'plan_subscriptions' => 'plan_subscriptions',
        'plan_subscription_usage' => 'plan_subscription_usage',

    ],

    // Subscriptions Models
    'models' => [
        'plan' => \Samehdoush\Subscriptions\Models\Plan::class,
        'plan_feature' => \Samehdoush\Subscriptions\Models\PlanFeature::class,
        'plan_subscription' => \Samehdoush\Subscriptions\Models\PlanSubscription::class,
        'plan_subscription_usage' => \Samehdoush\Subscriptions\Models\PlanSubscriptionUsage::class,


    ],

];
