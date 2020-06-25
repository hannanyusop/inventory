<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerInvoice;
use App\Models\CustomerInvoiceItem;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\SupplierInvoice;
use Illuminate\Support\Facades\DB;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $box = [
            'customer' => Customer::count(),
            'supplier' => Supplier::count(),
            'total_sale' => CustomerInvoice::sum('price_net'),
            'total_stock' => SupplierInvoice::sum('price_net')
        ];

        return view('backend.dashboard', compact('box'));
    }
}
