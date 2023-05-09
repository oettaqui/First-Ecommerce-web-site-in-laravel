<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // public $slug;
    // public function deleteCategory($category_id){
    //     // $category = Category::find($slug);
    //     // $category->delete();
    //     // session()->with(['message'=>'Category Deleted Succesefully', 'messageType' => 'delete']);
    //     $category = Category::find($category_id);

    // if (!$category) {
    //     session()->flash('message', 'Category not found.');
    //     session()->flash('messageType', 'error');
    //     return;
    // }

    // $category->delete();
    // session()->with(['message'=>'Category Deleted Succesefully', 'messageType' => 'delete']);
    // }
    // public function destroyCategory(){
    //     $category = Category::find($category_id);
    //     $category->delete();
    //     session()->flash('message','Category Deleted Succesefully');
    // }
    public function render()
    {
    
        $categories = Category::paginate(10);
        return view('livewire.admin.category.index',['categories'=>$categories]);
    }
}
