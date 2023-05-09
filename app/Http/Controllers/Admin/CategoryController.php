<?php

namespace App\Http\Controllers\Admin;
use App\Http\controllers\controller;

use Illuminate\Support\Str;
use Illuminate\Routing\Redirector;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryFormRequest $request)
    {
        $validatorData = $request->validated();
        $category = new Category;
        $category->name_category = $validatorData['name_category'];
        $category->slug = str::slug($validatorData['slug']);
        $category->description_category = $validatorData['description_category'];
        $category->status =$request->status == true ? '1':'0';
        $category->save();
        return redirect('admin/categories')->with(['message'=>'Category Added Succesefully','messageType'=>'add']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::where('id', $id)->firstOrFail();
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryFormRequest $request, $id)
    {
        $validatorData = $request->validated();
        $category = Category::find($id);
        if (!$category) {
            return redirect('admin/categories')->with(['message'=>'Category not found','messageType'=>'error']);
        }
        $category->name_category = $validatorData['name_category'];
        $category->slug = str::slug($validatorData['slug']);
        $category->description_category = $validatorData['description_category'];
        $category->status =$request->status == true ? '1':'0';
        $category->save();
        return redirect('admin/categories')->with(['message'=>'Category Updated Succesefully','messageType'=>'update']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->products()->delete(); // Delete related products
        $category->delete();
        // $category->deleteWithProducts();
        return redirect('admin/categories')->with(['message'=>'Category Deleted Succesefully', 'messageType' => 'delete']);
    } 


    public function trashedCategory()
    {
    
        return view('admin.category.trashed');
        
    }
    public function backfromtrash($category){
        $category = Category::withTrashed()->find($category);
            $category->restore();
            $products = $category->products()->withTrashed()->get();
    foreach ($products as $product) {
        $product->restore();
    }
            return redirect('admin/category/trashed')->with(['message'=>'Category Back From Trashed Succesefully','messageType'=>'back']);
    }

 
    public function forceDelete($id){
        $category = Category::withTrashed()->findOrFail($id);
        $category->products()->forceDelete();
        $category->forceDelete();
        
        return redirect('admin/category/trashed')->with(['message'=>'Category deleted permanently','messageType'=>'delete']);
    }
}