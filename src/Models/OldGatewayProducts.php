<?php

namespace Samehdoush\Subscriptions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldGatewayProducts extends Model
{
    use HasFactory;

    public function __construct(array $attributes = [])
    {
        $this->setTable(config('subscriptions.tables.old_gateway_products'));


        parent::__construct($attributes);
    }
}
