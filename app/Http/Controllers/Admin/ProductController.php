<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(3);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->all());

        /* Handle image upload if provided */
       if ($request->hasFile('image')) {
           $image = $request->file('image');

           /*Generate a unique filename using the current timestamp and the original file extension */
           $imageName = time() . '_' . $image->getClientOriginalName();

           /* Store the file in the public/products directory */
           $imagePath = $image->storeAs('products', $imageName, 'public');

           /* Update the product's image field */
           $product->image = $imagePath;
           $product->save();
       }

       Flasher::addSuccess('Product created successfully.!');

       return redirect()->route('products.index');
   }

   /**
    * Display the specified resource.
    */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {

        /* Update the product's basic fields*/
        $product->update($request->except('image'));

        /*  Handle image upload if provided */
       if ($request->hasFile('image')) {
           $image = $request->file('image');

           /* Generate a unique filename using the current timestamp and the original file extension */
           $imageName = time() . '_' . $image->getClientOriginalName();

           /* Store the file in the public/products directory*/
           $imagePath = $image->storeAs('products', $imageName, 'public');

           /* Delete the old image if it exists */
           if ($product->image) {
               Storage::disk('public')->delete($product->image);
           }

           /*  Update the product's image field */
           $product->image = $imagePath;
       }

       /* Save the product after updating the image*/
        $product->save();

        Flasher::addSuccess('Product Updated successfully.!');

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        /* Delete the associated image file if it exists */
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        /*Delete the product*/

        Flasher::addSuccess('Product deleted successfully.');

        return redirect()->route('products.index');
    }

    public function search(Request $request)
    {
        // Validate the search query
        $request->validate([
            'search' => 'required|string|min:3',
        ]);

        // Get the search query from the request
        $searchQuery = $request->input('search');

        // Perform the search query using Eloquent
        $products = Product::where('name', 'LIKE', '%' . $searchQuery . '%')
            ->orWhere('name', 'LIKE', '%' . $searchQuery . '%')
            ->paginate(3);

        // Pass the search results to the view
        return view('admin.products.index', ['products' => $products]);
    }

}
