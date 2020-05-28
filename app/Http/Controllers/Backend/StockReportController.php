<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CustomerInvoice;
use App\Models\SupplierInvoice;
use Illuminate\Http\Request;

class StockReportController extends Controller{

    public function index(Request $request){

        $now = date('Y');
        $start = 2009;
        $years = array();

        $year = ($request->has('year'))? $request->year : $now;

        while ($start <= $now){
            $years[$start] = $start;
            $start++;
        }

        $month = 1;


        $data_transfer = array();
        $data_receive = array();

        do{
            $receive = SupplierInvoice::whereMonth('date', '=', $month)
                ->whereYear('date', '=', $year)
                ->sum('price_net');

            $transfer = CustomerInvoice::whereMonth('date', '=', $month)
                ->whereYear('date', '=', $year)
                ->sum('price_net');


            array_push($data_transfer, $transfer);
            array_push($data_receive, $receive);

            $month++;
        }while($month <= 12);

        return view('backend.stock-report.index', compact('data_receive', 'data_transfer', 'years', 'year'));
    }

}
