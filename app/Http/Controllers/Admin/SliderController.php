<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\validator;
use App\Http\Requests\SliderFormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:800',
            'image' =>  'nullable|image|mimes:jpg,jpeg,png',
            'status' => 'nullable'
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/slider/',$filename);
            $validateData['image'] = "uploads/slider/$filename";
        }else {
            $validateData['image'] = null;
        }
    

        $validateData['status'] = $request->status == true ? '1':'0';
        Slider::create([
            'title' => $validateData['title'],
            'description' => $validateData['description'],
            'image' => $validateData['image'],
            'status' => $validateData['status'],
       
        ]);
        return redirect()->route('sliders.index')->with(['message'=>'Slider Added Succesefully','messageType'=>'add']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $slider = Slider::where('id', $id)->firstOrFail();
        return view('admin.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Slider $slider)
    // {
    //     // return $slider;
    //     $validateData = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required|string|max:800',
    //         'image' =>  'nullable|image|mimes:jpg,jpeg,png',
    //         'status' => 'nullable'
    //     ]);

    //     $destination = $slider->image;
    //     if(File::exists($destination)){
    //         File::delete($destination);
    //     }

    //     if($request->hasFile('image')){
    //         $file = $request->file('image');
    //         $ext = $file->getClientOriginalExtension();
    //         $filename = time().'.'.$ext;
    //         $file->move('uploads/slider/',$filename);
    //         $validateData['image'] = "uploads/slider/$filename";
    //     }else {
    //         $validateData['image'] = null;
    //     }
    

    //     $validateData['status'] = $request->status == true ? '1':'0';
    //     Slider::where('id',$slider->id)->update([
    //         'title' => $validateData['title'],
    //         'description' => $validateData['description'],
    //         'image' => $validateData['image'] ,
    //         'status' => $validateData['status'],
       
    //     ]);
    //     return redirect()->route('sliders.index')->with(['message'=>'Slider Updated Succesefully','messageType'=>'update']);
    // }
    
    public function update(Request $request, Slider $slider)
{
    $validateData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:800',
        'image' => 'nullable|image|mimes:jpg,jpeg,png',
        'status' => 'nullable'
    ]);

    $destination = $slider->image;

    if ($request->hasFile('image')) {
        // Remove old image
        if (File::exists($destination)) {
            File::delete($destination);
        }

        // Upload new image
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $filename = time().'.'.$ext;
        $file->move('uploads/slider/', $filename);
        $validateData['image'] = "uploads/slider/$filename";
    } else {
        // Keep old image
        $validateData['image'] = $slider->image;
    }

    $validateData['status'] = $request->status == true ? '1':'0';

    // Update slider
    $slider->update([
        'title' => $validateData['title'],
        'description' => $validateData['description'],
        'image' => $validateData['image'],
        'status' => $validateData['status'],
    ]);

    return redirect()->route('sliders.index')->with(['message'=>'Slider Updated Succesefully','messageType'=>'update']);
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        // if($slider->count() > 0){
            $destination = $slider->image;
        if(File::exists($destination)){
            File::delete($destination);
        }
        // }
 
        $slider->delete();
        
        return redirect()->route('sliders.index')->withh(['message'=>'Slider Deleted Succesefully', 'messageType' => 'delete']);
    }
    
}
