<?php

namespace Samehdoush\Subscriptions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GatewayProducts extends Model
{
    use HasFactory;
    public function __construct(array $attributes = [])
    {
        $this->setTable(config('subscriptions.tables.gateway_products'));


        parent::__construct($attributes);
    }
}
