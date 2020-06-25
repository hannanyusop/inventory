<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerInvoiceItem extends Model
{

    protected $table = 'ci_item';

    protected $attributes = [
    ];

    public function invoice(){
        return $this->hasOne(CustomerInvoice::class, 'id', 'ci_id');
    }

    public function item(){
        return $this->hasOne(Item::class, 'id', 'item_id');
    }
}
