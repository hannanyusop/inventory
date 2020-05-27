<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\InsertCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;

/**
 * Class DashboardController.
 */
class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('backend.category.index', compact('categories'));
    }

    public function add(){

        return view('backend.category.add');

    }

    public function insert(InsertCategoryRequest $request){

        $category = new Category();

        $category->name = $request->name;
        $category->remark = $request->remark;

        if($category->save()){
            return redirect(route('admin.category.index'))->withSuccessMessage('New Category Inserted!');
        }else{
            return redirect(route('admin.category.add'))->withErrorMessage('Failed To Insert Category!');
        }

    }

    public function view($id){

        $category = Category::where('id', $id)->first();

        if($category){
            return view('backend.category.view', compact($category));
        }else{
            return redirect(route('admin.category.index'))->withErrorMessage('No Category Found!');
        }
    }

    public function edit($id){
        $category = Category::where('id', $id)->first();

        if($category){
            return view('backend.category.edit', compact('category'));
        }else{
            return redirect(route('admin.category.index'))->withErrorMessage('No Category Found!');
        }

    }

    public function update(UpdateCategoryRequest $request, $id){

        $category = Category::find($id);

        $category->name = $request->name;
        $category->remark = $request->remark;

        if($category->save()){
            return redirect(route('admin.category.index'))->withSuccessMessage('Category Updated!');
        }else{
            return redirect(route('admin.category.update', $category->id))->withErrorMessage('Failed To Update Category!');
        }

    }
}
