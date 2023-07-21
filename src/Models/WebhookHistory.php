<?php

namespace Samehdoush\Subscriptions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebhookHistory extends Model
{
    use HasFactory;
    public function __construct(array $attributes = [])
    {
        $this->setTable(config('subscriptions.tables.webhook_history'));


        parent::__construct($attributes);
    }
}
