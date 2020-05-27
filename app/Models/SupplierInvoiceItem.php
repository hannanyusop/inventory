<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierInvoiceItem extends Model
{

    protected $table = 'si_item';

    protected $attributes = [
    ];

    public function invoice(){
        return $this->hasOne(SupplierInvoice::class, 'id', 'si_id');
    }

    public function item(){
        return $this->hasOne(Item::class, 'id', 'item_id');
    }
}
