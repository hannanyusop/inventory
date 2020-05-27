<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Http\Requests\Customer\InsertSupplierRequest;
use App\Http\Requests\Customer\UpdateSupplierRequest;
use App\Models\Customer;


class CustomerController extends Controller
{

    public function index()
    {
        $customers = Customer::all();
        return view('backend.customer.index', compact('customers'));
    }

    public function add(){

        return view('backend.customer.add');

    }

    public function insert(InsertSupplierRequest $request){

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

        if($customer){
            return view('backend.customer.view', compact('customer'));
        }else{
            return redirect(route('admin.customer.index'))->withErrorMessage('No Customer Found!');
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

    public function update(UpdateSupplierRequest $request, $id){

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
