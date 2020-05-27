<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{

    protected $table = 'suppliers';

    protected $attributes = [
    ];

    public function invoices()
    {
        return $this->hasMany(SupplierInvoice::class);
    }
}
