<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\InsertSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Models\Supplier;
use App\Models\SupplierInvoice;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function index(Request $request)
    {

        if($request->has('name') || $request->has('email')){

            $suppliers = Supplier::where('email', 'like', '%'.$request->email.'%')
                ->where('name', 'like', '%'.$request->name.'%')
                ->get();
        }else{
            $suppliers = Supplier::all();
        }

        return view('backend.supplier.index', compact('suppliers'));
    }

    public function add(){

        return view('backend.supplier.add');

    }

    public function insert(InsertSupplierRequest $request){

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone_number = $request->phone_number;
        $supplier->address = $request->address;

        if($supplier->save()){
            return redirect(route('admin.supplier.index'))->withSuccessMessage('New Supplier Inserted!');
        }else{
            return redirect(route('admin.supplier.add'))->withErrorMessage('Failed To Insert Supplier!');
        }

    }

    public function view($id){

        $supplier = Supplier::where('id', $id)->first();

        $box = [
            'year' => SupplierInvoice::whereYear('created_at', date('Y'))->where('supplier_id', $id)->sum('price_net'),
            'overall' => SupplierInvoice::where('supplier_id', $id)->sum('price_net'),
        ];

        $years = range(date('Y'), 2018);

        if($supplier){
            return view('backend.supplier.view', compact('supplier', 'box', 'years'));
        }else{
            return redirect(route('admin.supplier.index'))->withErrorMessage('No Supplier Found!');
        }
    }

    public function getData(Request $request, $id){

        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');
            if($query == '')
            {
                $data = SupplierInvoice::whereYear('created_at', date('Y'))
                    ->where('supplier_id', $id)
                    ->get();

            } else {
                $data = SupplierInvoice::whereYear('created_at', $request->get('query'))
                    ->where('supplier_id', $id)
                    ->get();
            }
            $total_row = $data->count();
            if($total_row > 0)
            {
                foreach($data as $row) {

                    $output .= '
                        <tr>
                         <td>'.$row->created_at.'</td>
                         <td>RM '.$row->price_net.'</td>
                         <td><a target="_blank" href="'.route('admin.stock-receive.view', $row->id).'">View</a></td>
                        </tr>
                        ';
                }
            } else {
                $output = '
                   <tr>
                    <td align="center" colspan="3">No Data Found</td>
                   </tr>';
            }

            $data = array(
                'table_data'  => $output,
            );

            echo json_encode($data);
        }
    }

    public function edit($id){
        $supplier = Supplier::where('id', $id)->first();

        if($supplier){
            return view('backend.supplier.edit', compact('supplier'));
        }else{
            return redirect(route('admin.supplier.index'))->withErrorMessage('No Supplier Found!');
        }

    }

    public function update(UpdateSupplierRequest $request, $id){

        $supplier = Supplier::find($id);
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone_number = $request->phone_number;
        $supplier->address = $request->address;

        if($supplier->save()){
            return redirect(route('admin.supplier.index'))->withSuccessMessage('Supplier Updated!');
        }else{
            return redirect(route('admin.supplier.update', $supplier->id))->withErrorMessage('Failed To Update Supplier!');
        }

    }
}
