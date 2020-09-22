<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\InsertSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Models\Customer;
use App\Models\CustomerInvoice;
use App\Models\CustomerInvoiceItem;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransferStockController extends Controller
{

    public function index(Request $request)
    {

        if($request->has('customer_id')){

            $ci = CustomerInvoice::where('customer_id', '=', $request->customer_id)
                ->get();

        }else{
            $ci = CustomerInvoice::all();
        }

        $customers = Customer::all()->pluck('name','id');
        return view('backend.stock-transfer.index', compact('ci', 'customers'));
    }

    public function add(Request $request){

        if(request('step') == 1){

            if($request->isMethod('post')){

                $request->validate([
                    'customer_id' => 'required|exists:suppliers,id',
                    'date' => 'required',
                ]);

                $data = [
                    'customer_id' => $request->customer_id,
                    'date' => $request->date,
                    'product' => []
                ];

                Session::put('transfer_product', $data);

                return  redirect(route('admin.stock-transfer.add', 'step=2'));
            }

            $customers = Customer::all()->pluck('name','id');
            return view('backend.stock-transfer.add-1', compact( 'customers'));

            } else if (request('step') == 2){

            if(request('add')) {

                $request->validate([
                    'item_id' => 'required|exists:items,id',
                    'price_customer' => 'required|numeric|min:0',
                    'price_adjustment' => 'required|numeric|min:0',
                    'qty' => 'required|numeric|min:1',
                    'total' => 'required|numeric|min:0'
                ]);

               $p = Item::find($request->item_id);

               if(!$p){
                   return redirect(route('admin.stock-transfer.add', 'step=2'))->withErrors('Product Not Found!');
               }

               if (isset(Session::get('transfer_product')['product'])) {

                   $old = Session::get('transfer_product');

                   $products = $old['product'];

                   #checking if quantity enough
                   if($p->qty_left < $request->qty){
                       return redirect(route('admin.stock-transfer.add', 'step=2'))->withErrors('Not Enough stock! <b>'.$p->qty_left.' pc(s) Left</b>');
                   }

                   if(isset($products[$request->item_id])){

                       #if item already exist just ++ the value
                       $new_qty = $products[$request->item_id]['qty']+$request->qty;

                       #checking if quantity enough
                       if($p->qty_left < $new_qty){
                           return redirect(route('admin.stock-transfer.add', 'step=2'))->withErrors('Not Enough stock!<b> '.$p->qty_left.' pc(s) Left</b>');
                       }

                       $items = [
                           'name' => $p->name,
                           'code' => $p->code,
                           'price_customer' => $request->price_customer,
                           'price_adjustment' => $request->price_adjustment,
                           'qty' => $new_qty,
                           'total' => $request->price_adjustment * $new_qty
                       ];

                   }else{

                       #checking if quantity enough
                       if($p->qty_left < $request->qty){
                           return redirect(route('admin.stock-transfer.add', 'step=2'))->withErrors('Not Enough stock!');
                       }

                       $items = [
                           'name' => $p->name,
                           'code' => $p->code,
                           'price_customer' => $request->price_customer,
                           'price_adjustment' => $request->price_adjustment,
                           'qty' => $request->qty,
                           'total' => $request->price_adjustment * $request->qty
                       ];

                   }

                   #insert new product
                   $products[$request->item_id] = $items;

                   $data = [
                       'customer_id' => $old['customer_id'],
                       'date' => $old['date'],
                       'product' => $products
                   ];

               } else {

                   $subtotal = $request->price_adjustment * $request->qty;
                   $items = [
                       'name' => $p->name,
                       'code' => $p->code,
                       'price_customer' => $request->price_customer,
                       'price_adjustment' => $request->price_adjustment,
                       'qty' => $request->qty,
                       'total' => $subtotal
                   ];


                   $old = Session::get('transfer_product');

                   $data = [
                       'customer_id' => $old['customer_id'],
                       'date' => $old['date'],
                       'product' => [
                           $request->item_id => $items
                       ]
                   ];

               }

               Session::put('transfer_product', $data);
               return redirect(route('admin.stock-transfer.add', 'step=2'))->withSuccessMessage('Product added.');
           }

            $items = Item::all();
            return view('backend.stock-transfer.add-2', compact('items'));

        }elseif (request('step') == 3){

           $transfer_product = Session::get('transfer_product');

            #need to check atleat 1 product inserted
            if(count($transfer_product['product']) == 0){
                return redirect(route('admin.stock-receive.add', 'step=2'))->withErrors('Please Add At Least 1 product!');
            }

           #testing purpose
           $transfer_product['customer_id'] = 1;

           $customer = Customer::find($transfer_product['customer_id']);

           return view('backend.stock-transfer.add-3', compact('customer'));
       }else if(request('step') == 4){

            $request->validate([
                'remark' => 'required',
            ]);

            $session = Session::get('transfer_product');

            #insert to database
            $si = new CustomerInvoice();
            $si->customer_id = $session['customer_id'];
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

                $new_product = new CustomerInvoiceItem();
                $new_product->ci_id = $si->id;
                $new_product->item_id = $key;
                $new_product->qty = $item['qty'];
                $new_product->price_adjustment = $item['price_adjustment'];
                $new_product->price = $item['price_customer'];

                $new_product->save();

                $i = Item::find($key);
                #update quantity
                $i->decrement('qty_left', $item['qty']);

                #get subtotal and net
                $price_total = $price_total+($item['price_customer']*$item['qty']);
                $price_net = $price_net+($item['price_customer']*$item['qty']);

            }

            $si->price_total = $price_total;
            $si->price_net = $price_net;

            if($si->save()){

                #remove session
                Session::forget('transfer_product');
                return redirect(route('admin.stock-transfer.index'))->withSuccessMessage('Data inserted!');
            }else{
                return redirect(route('admin.stock-transfer.add', 'step=3'))->withErrorsMessage('Failed to insert data!');
            }


        } else{
           return redirect(route('admin.stock-transfer.add', 'step=1'));
       }

    }

    public function removeFromList($item_id){
        $rp = Session::get('transfer_product');

        if(isset($rp['product'][$item_id])){
            unset($rp['product'][$item_id]);

            Session::put('transfer_product',$rp);

            return redirect(route('admin.stock-transfer.add', 'step=2'))->withSuccessMessage('Product removed from list.');
        }else{
            return redirect(route('admin.stock-transfer.add', 'step=2'))->withErrorsMessage('Product not in list!');

        }

    }

    public function insert(InsertSupplierRequest $request){

        $si = new CustomerInvoice();

        $si->customer_id = $request->customer_id;
        $si->invoice_no = rand();
        $si->date = $request->date;
        $si->time = $request->time;

        $si->price_total = 0;
        $si->price_net = 0;

        $si->remark = $request->remark;
        $si->status = $request->status;

        $total = 0;

        #save to get customer invoice id;
        $si->save();

        foreach ($request->items as $data){

            $item = new CustomerInvoiceItem();
            $item->ci_id = $si->id;
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
            return redirect(route('admin.stock-transfer.index'))->withSuccessMessage('New Transfer List Inserted!');
        }else{
            return redirect(route('admin.stock-transfer.add'))->withErrorMessage('Failed To Insert Transfer List!');
        }

    }

    public function view($id){

        $invoice = CustomerInvoice::where('id', $id)
            ->with('customer', 'items')
            ->first();

        if($invoice){
            return view('backend.stock-transfer.view-invoice', compact('invoice'));
        }else{
            return redirect(route('admin.stock-transfer.index'))->withErrorMessage('No Transfer List Found!');
        }
    }
}
