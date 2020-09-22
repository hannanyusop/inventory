<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\InsertSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\SupplierInvoice;
use App\Models\SupplierInvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReceiveStockController extends Controller
{

    public function index(Request $request){


        if($request->has('supplier_id')){
            $si = SupplierInvoice::where('supplier_id', '=', $request->supplier_id)
                ->get();

        }else{

            $si = SupplierInvoice::all();

        }

        $suppliers = Supplier::all()->pluck('name','id');

        return view('backend.receive-stock.index', compact('si', 'suppliers'));
    }

    public function add(Request $request){

        if(request('step') == 1){


            if($request->isMethod('post')){

                $request->validate([
                    'supplier_id' => 'required|exists:suppliers,id',
                    'date' => 'required',
                ]);

                $data = [
                    'supplier_id' => $request->supplier_id,
                    'date' => $request->date,
                    'product' => []
                ];

                Session::put('receive_product', $data);

                return  redirect(route('admin.stock-receive.add', 'step=2'));
            }

            $suppliers = Supplier::all()->pluck('name','id');
            return view('backend.receive-stock.add-1', compact( 'suppliers'));

            } else if (request('step') == 2){

            if(request('add')) {

                $request->validate([
                    'item_id' => 'required|exists:items,id',
                    'price_supplier' => 'required|numeric|min:0',
                    'price_adjustment' => 'required|numeric|min:0',
                    'qty' => 'required|numeric|min:1',
                    'total' => 'required|numeric|min:0'
                ]);

               $p = Item::find($request->item_id);

               if (isset(Session::get('receive_product')['product'])) {

                   $old = Session::get('receive_product');

                   $products = $old['product'];

                   if(isset($products[$request->item_id])){

                       #if item already exist just ++ the value
                       $new_qty = $products[$request->item_id]['qty']+$request->qty;

                       $items = [
                           'name' => $p->name,
                           'code' => $p->code,
                           'price_supplier' => $request->price_supplier,
                           'price_adjustment' => $request->price_adjustment,
                           'qty' => $new_qty,
                           'total' => $request->price_adjustment * $new_qty
                       ];

                   }else{

                       $items = [
                           'name' => $p->name,
                           'code' => $p->code,
                           'price_supplier' => $request->price_supplier,
                           'price_adjustment' => $request->price_adjustment,
                           'qty' => $request->qty,
                           'total' => $request->price_adjustment * $request->qty
                       ];

                   }

                   #insert new product
                   $products[$request->item_id] = $items;

                   $data = [
                       'supplier_id' => $old['supplier_id'],
                       'date' => $old['date'],
                       'product' => $products
                   ];

               } else {

                   $subtotal = $request->price_adjustment * $request->qty;
                   $items = [
                       'name' => $p->name,
                       'code' => $p->code,
                       'price_supplier' => $request->price_supplier,
                       'price_adjustment' => $request->price_adjustment,
                       'qty' => $request->qty,
                       'total' => $subtotal
                   ];


                   $old = Session::get('receive_product');

                   $data = [
                       'supplier_id' => $old['supplier_id'],
                       'date' => $old['date'],
                       'product' => [
                           $request->item_id => $items
                       ]
                   ];

               }

               Session::put('receive_product', $data);
               return redirect(route('admin.stock-receive.add', 'step=2'))->withSuccessMessage('Product added.');
           }

            $items = Item::all();
            return view('backend.receive-stock.add-2', compact('items'));

        }elseif (request('step') == 3){

           $receive_product = Session::get('receive_product');

           #need to check atleat 1 product inserted
            if(count($receive_product['product']) == 0){
                return redirect(route('admin.stock-receive.add', 'step=2'))->withErrors('Please Add At Least 1 product!');
            }

           $supplier = Supplier::find($receive_product['supplier_id']);

           return view('backend.receive-stock.add-3', compact('supplier'));
       }else if(request('step') == 4){

            $request->validate([
                'remark' => 'required',
            ]);

            $session = Session::get('receive_product');

            #insert to database
            $si = new SupplierInvoice();
            $si->supplier_id = $session['supplier_id'];
            $si->invoice_no = rand();
            $si->date = date('Y-m-d',strtotime($session['date']));
            $si->price_total = 0;
            $si->price_net = 0;
            $si->remark = $request->remark;
            $si->status = 1;
            $si->payment_type = 1;

            $si->save();

            $price_total = $price_net = 0;

            #insert item and update qty
            foreach ($session['product'] as $key => $item){

                $new_product = new SupplierInvoiceItem();
                $new_product->si_id = $si->id;
                $new_product->item_id = $key;
                $new_product->qty = $item['qty'];
                $new_product->price_adjustment = $item['price_adjustment'];
                $new_product->price = $item['price_supplier'];

                $new_product->save();

                $i = Item::find($key);
                #update quantity
                $i->increment('qty_left', $item['qty']);
                $i->increment('qty_total', $item['qty']);

                #get subtotal and net
                $price_total = $price_total+($item['price_supplier']*$item['qty']);
                $price_net = $price_net+($item['price_supplier']*$item['qty']);

            }

            $si->price_total = $price_total;
            $si->price_net = $price_net;

            if($si->save()){

                #remove session
                Session::forget('receive_product');
                return redirect(route('admin.stock-receive.index'))->withSuccessMessage('Data inserted!');
            }else{
                return redirect(route('admin.stock-receive.add', 'step=3'))->withErrorsMessage('Failed to insert data!');
            }


        } else{
           return redirect(route('admin.stock-receive.add', 'step=1'));
       }

    }

    public function removeFromList($item_id){
        $rp = Session::get('receive_product');

        if(isset($rp['product'][$item_id])){
            unset($rp['product'][$item_id]);

            Session::put('receive_product',$rp);

            return redirect(route('admin.stock-receive.add', 'step=2'))->withSuccessMessage('Product removed from list.');
        }else{
            return redirect(route('admin.stock-receive.add', 'step=2'))->withErrorsMessage('Product not in list!');

        }

    }

    public function insert(InsertSupplierRequest $request){

        $si = new SupplierInvoice();

        $si->supplier_id = $request->supplier_id;
        $si->invoice_no = rand();
        $si->date = $request->date;
        $si->time = $request->time;

        $si->price_total = 0;
        $si->price_net = 0;

        $si->remark = $request->remark;
        $si->status = $request->status;

        $total = 0;

        #save to get supplier invoice id;
        $si->save();

        foreach ($request->items as $data){

            $item = new SupplierInvoiceItem();
            $item->si_id = $si->id;
            $item->item_id = $data->item_id;
            $item->qty = $data->qty;
            $item->price_adjusment = $data->price_adjustment;
            $item->price = $data->price;

            $item->save();

            #add total
            $total=+$item->price_adjusment;
        }


        $si->price_total = $si->price_net = $total;
        if($si->save()){
            return redirect(route('admin.receive-stock.index'))->withSuccessMessage('New Transfer List Inserted!');
        }else{
            return redirect(route('admin.receive-stock.add'))->withErrorMessage('Failed To Insert Transfer List!');
        }

    }

    public function view($id){

        $invoice = SupplierInvoice::where('id', $id)
            ->with('supplier', 'items')
            ->first();

        if($invoice){
            return view('backend.receive-stock.view-invoice', compact('invoice'));
        }else{
            return redirect(route('admin.receive-stock.index'))->withErrorMessage('No Transfer List Found!');
        }
    }
}
