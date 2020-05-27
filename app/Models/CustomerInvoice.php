<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerInvoice extends Model
{

    protected $table = 'customer_invoices';

    protected $attributes = [
    ];

    public function items(){
        return $this->hasOne(CustomerInvoiceItem::class, 'ci_id', 'id');
    }

    public function customer(){
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function CIStatus(){
        $statuses = [
            1 => 'pending',
            2 => 'complete',
        ];

    }
}
