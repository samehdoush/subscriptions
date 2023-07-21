<?php

// config for Samehdoush/Subscriptions
return [
    // Subscriptions Database Tables
    'tables' => [

        'plans' => 'plans',
        'plan_features' => 'plan_features',
        'plan_subscriptions' => 'plan_subscriptions',
        'plan_subscription_usage' => 'plan_subscription_usage',
        'webhook_history' => 'webhookhistory',
        'gateway_products' => 'gateway_products',
        'old_gateway_products' => 'old_gateway_products',
    ],

    // Subscriptions Models
    'models' => [
        'plan' => \Samehdoush\Subscriptions\Models\Plan::class,
        'plan_feature' => \Samehdoush\Subscriptions\Models\PlanFeature::class,
        'plan_subscription' => \Samehdoush\Subscriptions\Models\PlanSubscription::class,
        'plan_subscription_usage' => \Samehdoush\Subscriptions\Models\PlanSubscriptionUsage::class,
        'webhook_history' => \Samehdoush\Subscriptions\Models\WebhookHistory::class,
        'gateway_products' => \Samehdoush\Subscriptions\Models\GatewayProducts::class,
        'old_gateway_products' => \Samehdoush\Subscriptions\Models\OldGatewayProducts::class,

    ],
    'paypal' => [
        'enable' => true,
        'mode' => 'sandbox', // 'sandbox' or 'live'
        'client_id' => env('PAYPAL_CLIENT_ID', ''),
        'secret' => env('PAYPAL_SECRET', ''),
        'app_id' => env('PAYPAL_APP_ID', ''),
        'currency' => env('PAYPAL_CURRENCY', 'USD'),
    ],
    'stripe' => [
        'enable' => true,
        'mode' => 'sandbox', // 'sandbox' or 'live'
        'secret' => env('STRIPE_SECRET', ''),
        'publishable' => env('STRIPE_PUBLISHABLE', ''),
        'currency' => env('STRIPE_CURRENCY', 'USD'),
    ],
];
