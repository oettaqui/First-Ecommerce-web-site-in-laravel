<?php

namespace App\Http\Livewire\Admin\Slider;

use Livewire\Component;
use App\Models\Slider;
use Livewire\WithPagination;
class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $sliders = Slider::paginate(10);
        return view('livewire.admin.slider.index',['sliders'=>$sliders]);
    }
}
