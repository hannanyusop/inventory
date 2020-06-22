<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CustomerInvoice;
use App\Models\CustomerInvoiceItem;
use App\Models\Item;
use App\Models\SupplierInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function prediction(Request $request){

        $m = date('m');
        $categories = Category::all();
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $dataMonth = array();

        $month = $m-3;
        while ($month < $m) {
            array_push($dataMonth, $months[$month-1]);
            $month++;
        }

        array_push($dataMonth, $months[$month-1]."(Prediction)"); // -1 because array start with 0

        $names = [];

        foreach ($categories as $key => $category){

            $itemIds = Item::where('category_id', $category->id)
                ->pluck('id');

            $most = DB::table('ci_item')
                ->select('item_id', DB::raw("sum(qty) as total"))
                ->whereIn('item_id', $itemIds)
                ->whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '>=', $m-2)
                ->groupBy('item_id')
                ->orderBy('total', 'DESC')
                ->first();

            $data[$category->id] = $most;

            $item = Item::find($category->id);
            $names[$key] = $item->name;

        }

        //get proper data

        foreach ($data as $i){

            $sum_all = 0;
            $ar = array();
            $item_id = $i->item_id;

            $month = $m-3;
            while ($month < $m){

                $total = DB::table('ci_item')
                    ->select( DB::raw("IFNULL(sum(qty),0) as total"))
                    ->where('item_id', $item_id)
                    ->whereYear('created_at', date('Y'))
                    ->whereMonth('created_at', $month)
                    ->first();

                $sum = (!$total)? 0 : $total->total;

                array_push($ar, $sum);

                $sum_all+=$sum;

                $month++;
            }

            array_push($ar, round($sum_all/3));
            $formatted[$item_id] = $ar;

            unset($ar); //delete all item in array

        }


        return view("backend.stock-report.prediction", compact('data', 'formatted', 'names', 'dataMonth'));

    }

}
