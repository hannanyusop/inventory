<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierInvoice extends Model
{

    protected $table = 'supplier_invoices';

    protected $attributes = [
    ];

    public function items(){
        return $this->hasMany(SupplierInvoiceItem::class, 'si_id', 'id');
    }

    public function supplier(){
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }
}
