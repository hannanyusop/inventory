<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Requests\Item\UpdateItemRequest;
use App\Http\Requests\Item\InsertItemRequest;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

/**
 * Class DashboardController.
 */
class ItemController extends Controller
{

    public function index(Request $request)
    {

        if($request->has('category_id')){




            if($request->category_id != 0){
                $items = Item::where('name', 'like', '%'.$request->name.'%')
                    ->where('category_id', $request->category_id)
                    ->get();
            }else{
                $items = Item::where('name', 'like', '%'.$request->name.'%')
                    ->get();
            }

        }else{
            $items = Item::all();
        }

        $categories = Category::all()->pluck('name', 'id');

        $categories[0] = 'All';


        return view('backend.item.index', compact('items', 'categories'));
    }

    public function add(){

        $categories = Category::all()->pluck('name', 'id');

        return view('backend.item.add', compact('categories'));

    }

    public function insert(InsertItemRequest $request){

        $item = new Item();

        if ($request->has('image_url')) {
            $image = $request->file('image_url');

            $item->image_url = $image->store('/items', 'public');

        } else {
            // get default image
            $item->image_url = 'img/item-default.png';
        }

        $item->code = $request->code;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->category_id = $request->category_id;
        $item->qty_left = 0;
        $item->qty_total = 0;
        $item->qty_alert = $request->qty_alert;
        $item->qty_alert_disabled = ($request->has('qty_alert_disabled'))? 1 : 0;
        $item->price_supplier = $request->price_supplier;
        $item->price_customer = $request->price_customer;

        if($item->save()){
            return redirect(route('admin.item.index'))->withSuccessMessage('New Item Inserted!');
        }else{
            return redirect(route('admin.item.add'))->withErrorMessage('Failed To Insert Item!');
        }

    }

    public function view($id){

        $item = Item::where('id', $id)->first();

        if($item){
            return view('backend.item.view', compact($item));
        }else{
            return redirect(route('admin.item.index'))->withErrorMessage('No Item Found!');
        }
    }

    public function edit($id){
        $item = Item::where('id', $id)->first();
        $categories = Category::all()->pluck('name', 'id');

        if($item){
            return view('backend.item.edit', compact('item', 'categories'));
        }else{
            return redirect(route('admin.item.index'))->withErrorMessage('No Item Found!');
        }

    }

    public function update(UpdateItemRequest $request, $id){

        $item = Item::find($id);

        $item->code = $request->code;
        $item->name = $request->name;
//        $item->image_url = $request->image_url;
        $item->qty_alert = $request->qty_alert;
        $item->qty_alert_disabled = ($request->has('qty_alert_disabled'))? 1 : 0;
        $item->category_id = $request->category_id;
        $item->description = $request->description;
        $item->price_supplier = $request->price_supplier;
        $item->price_customer = $request->price_customer;

        if($item->save()){
            return redirect(route('admin.item.index'))->withSuccessMessage('Item Updated!');
        }else{
            return redirect(route('admin.item.update', $item->id))->withErrorMessage('Failed To Update Item!');
        }

    }
}
