<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
        // return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        
            // Validate the request data
            $validatedData = $request->validate([
                'category_id' => 'required|integer',
                'name_product' => 'required|string|max:255',
                'slug' => 'required|string',
                'price' => 'required|integer|min:0',
                'stock' => 'required|integer|min:0',
                'description_product' => 'nullable|string',
                'promotion' => 'nullable',
                'tranding' => 'nullable',
                'status' => 'nullable',
                'category_id' => 'required|integer|exists:categories,id',
                'images.*' => 'nullable|image|max:2048', // max 2MB per image
            ]);
        
            // Create the new product
            $category = Category::findOrFail($validatedData['category_id']);
            $product = $category->products()->create([
                'name_product' => $validatedData['name_product'],
                'slug' =>Str::slug( $validatedData['slug']),
                'price' => $validatedData['price'],
                'stock' => $validatedData['stock'],
                'description_product' => $validatedData['description_product'],
                'promotion' => $request->promotion == true ? '1':'0',
                'tranding' => $request->tranding == true ? '1':'0',
                'status' =>  $request->status == true ? '1':'0',
                'category_id' => $validatedData['category_id'],
            ]);


            if($request->hasFile('images')){
                $uploadPath = 'uploads/products/';
                $i = 1;
                foreach($request->file('images') as $imageFile){
                    $extention = $imageFile->getClientOriginalExtension();
                    $fileName = time().$i++.'.'.$extention;
                    $imageFile->move($uploadPath,$fileName);
                    $finalImagePath = $uploadPath.$fileName;

                    $product->images()->create([
                        'product_id'=>$product->id,
                        'path' => $finalImagePath,
                    ]);
                }
            }

           
        
           
        
            // Redirect to the product index page
            return redirect()->route('products.index')->with(['message'=>'Product created successfully.','messageType'=>'add']);
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::where('id', $id)->firstOrFail();
        $productCategory = $product->category;
        return view('admin.product.edit',compact('product','categories','productCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validate the request data
    $validatedData = $request->validate([
        'category_id' => 'required|integer|exists:categories,id',
        'name_product' => 'required|string|max:255',
        'slug' => 'required|string',
        'price' => 'required|integer|min:0',
        'stock' => 'required|integer|min:0',
        'description_product' => 'nullable|string',
        'promotion' => 'nullable',
        'tranding' => 'nullable',
        'status' => 'nullable',
        'images.*' => 'nullable|image|max:2048', // max 2MB per image
    ]);

    // Find the product to update
    $product = Product::findOrFail($id);

    // Update the product
    $product->update([
        'category_id' => $validatedData['category_id'],
        'name_product' => $validatedData['name_product'],
        'slug' =>Str::slug( $validatedData['slug']),
        'price' => $validatedData['price'],
        'stock' => $validatedData['stock'],
        'description_product' => $validatedData['description_product'],
        'promotion' => $request->promotion == true ? '1':'0',
        'tranding' => $request->tranding == true ? '1':'0',
        'status' =>  $request->status == true ? '1':'0',
    ]);

    // Update the images
    if($request->hasFile('images')){
        $uploadPath = 'uploads/products/';
        $i = 1;
        foreach($request->file('images') as $imageFile){
            $extention = $imageFile->getClientOriginalExtension();
            $fileName = time().$i++.'.'.$extention;
            $imageFile->move($uploadPath,$fileName);
            $finalImagePath = $uploadPath.$fileName;

            $product->images()->create([
                'product_id'=>$product->id,
                'path' => $finalImagePath,
            ]);
        }
    }

    return redirect()->route('products.index')->with(['message'=>'Product updated successfully.','messageType'=>'update']);
    }

    public function destroyImage($id)
    {
        $productImage = Image::findOrFail($id);
        if(File::exists($productImage->path)){
            File::delete($productImage->path);
        }
        $productImage->delete();

        return redirect()->back()->with(['message'=>'Image deleted successfully.','messageType'=>'delete']);
    }

    public function destroy($id){

        $product = Product::findOrFail($id);
        // $product->categories()->dissociate();
        if($product->images()){
            foreach( $product->images() as $image){
                if(File::exists($image->path)){
                    File::delete($image->path);
                }
               
               
            }
        }
        $product->delete();
        return redirect()->back()->with(['message'=>'Product deleted successfully.','messageType'=>'delete']);
    }

    public function trashedProduct(){
        return view('admin.product.trashed');
    } 

    public function backfromtrashed($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        $product->restore();
    
        // Restore associated images
        $images = $product->images()->onlyTrashed()->get();
        foreach ($images as $image) {
            $image->restore();
        }
    
        return redirect()->back()->with(['message'=>'Product restored successfully.','messageType'=>'success']);
    }
    

    public function forceDelete($id)
    {
    $product = Product::withTrashed()->findOrFail($id);
    
    // Delete the product's images
    if($product->images()){
        foreach( $product->images() as $image){
            if(File::exists($image->path)){
                File::delete($image->path);
            }
        }
    }
    
    // Call the forceDelete method to permanently delete the product and its relations
    $product->forceDelete();

    return redirect()->back()->with(['message'=>'Product deleted permanently.','messageType'=>'delete']);
}

}
