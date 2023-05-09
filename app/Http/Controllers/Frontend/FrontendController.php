<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\category;
use App\Models\Product;

class FrontendController extends Controller
{
    protected $categories;

   
    public function index()
    {
        $sliders = Slider::where('status','0')->get();
        $products = Product::where('status','0')->paginate(15);
        $trandingProducts = Product::where('tranding','1')->latest()->take(15)->get();
        return view('frontend.index',compact('sliders','products','trandingProducts'));
    }
    // public function categories()
    // {
        
    //     $categories = Category::where('status','0')->get();
    //     return view('layouts.app',compact('categories'));
    // }
    
    

    public function products($category_slug)
    {
        $category = Category::where('slug',$category_slug)->first();
        if($category){
            $products = $category->products()->get();
            // $categories = Category::where('status','0')->get();
            return view('frontend.collections.product.index',compact('products','category'));
        }else{
            return redirect()->back();
        }
    }
    public function productView(string $category_slug, string $product_slug)
    {
        $category = Category::where('slug',$category_slug)->first();
        if($category){
            $product = $category->products()->where('slug',$product_slug)->where('status','0')->first();
            if($product){
                return view('frontend.collections.product.view',compact('product','category'));
            }else{
                return redirect()->back();
            }
        
        }else{
            return redirect()->back();
        }
    }

    public function thankyou(){
        return view('frontend.thank-you');
    }

    public function searchProducts(Request $request){
        if($request->search){
            
            $searchProducts = Product::where('name_product','LIKE','%'.$request->search.'%')->latest()->paginate(15);
            return  view('frontend.pages.search',compact('searchProducts'));

        }else{
            return redirect()->back()->with(['message'=>'No Products Avilable.','messageType'=>'error']);

        }

    }

}
