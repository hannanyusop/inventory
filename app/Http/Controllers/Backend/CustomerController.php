<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Http\Requests\Customer\InsertCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomersRequest;
use App\Models\Customer;
use App\Models\CustomerInvoice;
use App\Models\CustomerInvoiceItem;
use Illuminate\Http\Request;


class CustomerController extends Controller
{

    public function index(Request $request)
    {
        if($request->has('name') || $request->has('email')){

            $customers = Customer::where('email', 'like', '%'.$request->email.'%')
                ->where('name', 'like', '%'.$request->name.'%')
                ->get();
        }else{
            $customers = Customer::all();
        }
        return view('backend.customer.index', compact('customers'));
    }

    public function add(){

        return view('backend.customer.add');

    }

    public function insert(InsertCustomerRequest $request){

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone_number = $request->phone_number;
        $customer->address = $request->address;

        if($customer->save()){
            return redirect(route('admin.customer.index'))->withSuccessMessage('New Customer Inserted!');
        }else{
            return redirect(route('admin.customer.add'))->withErrorMessage('Failed To Insert Customer!');
        }

    }

    public function view($id){

        $customer = Customer::where('id', $id)->first();
        $box = [
            'year' => CustomerInvoice::whereYear('created_at', date('Y'))->where('customer_id', $id)->sum('price_net'),
            'overall' => CustomerInvoice::where('customer_id', $id)->sum('price_net'),
        ];

        $years = range(date('Y'), 2018);
        
        if($customer){
            return view('backend.customer.view', compact('customer', 'box', 'years'));
        }else{
            return redirect(route('admin.customer.index'))->withErrorMessage('No Customer Found!');
        }
    }

    public function getData(Request $request, $id){

        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');
            if($query == '')
            {
                $data = CustomerInvoice::whereYear('created_at', date('Y'))
                    ->where('customer_id', $id)
                    ->get();

            } else {
                $data = CustomerInvoice::whereYear('created_at', $request->get('query'))
                    ->where('customer_id', $id)
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
                         <td><a target="_blank" href="'.route('admin.stock-transfer.view', $row->id).'">View</a></td>
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
        $customer = Customer::where('id', $id)->first();

        if($customer){
            return view('backend.customer.edit', compact('customer'));
        }else{
            return redirect(route('admin.customer.index'))->withErrorMessage('No Customer Found!');
        }

    }

    public function update(UpdateCustomersRequest $request, $id){

        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone_number = $request->phone_number;
        $customer->address = $request->address;

        if($customer->save()){
            return redirect(route('admin.customer.index'))->withSuccessMessage('Customer Updated!');
        }else{
            return redirect(route('admin.customer.update', $customer->id))->withErrorMessage('Failed To Update Customer!');
        }

    }
}
