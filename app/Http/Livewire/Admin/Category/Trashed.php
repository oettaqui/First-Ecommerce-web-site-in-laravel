<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Trashed extends Component
{
    
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    

    public function render()
    {
        $categories = Category::onlyTrashed()->paginate(10);
        return view('livewire.admin.category.trashed',['categories'=>$categories]);
    }
}
