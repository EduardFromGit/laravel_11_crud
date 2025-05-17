<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
 /**
 * Display a listing of the resource.
 */
 public function index() : View
 {
 $products = Product::latest()->paginate(5);
 return view('products.index', compact('products'));
 }
 /**
 * Show the form for creating a new resource.
 */
 public function create() : View
 {
 return view('products.create');
 }
 /**
 * Store a newly created resource in storage.
 */
 public function store(Request $request) : RedirectResponse
 {
 $request->validate([
 'code' => 'required',
 'name' => 'required',
 'quantity' => 'required|numeric',
 'price' => 'required|numeric',
 'description' => 'required',
 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
 ]);
 $data = $request->all();

 Log::info('Checking for image file in upload request.');

 if ($request->hasFile('image')) {
 Log::info('Image file found in request.');
 $image = $request->file('image');

 if ($image->isValid()) {
 Log::info('Image file is valid. Attempting to store.');
 $imageName = time() . '.' . $image->getClientOriginalExtension();

 try {
 $image->storeAs('products', $imageName, 'public');
 $data['image'] = 'products/' . $imageName;
 Log::info('Image stored successfully on public disk: ' . $data['image']);
 } catch (\Exception $e) {
 Log::error('Error storing image: ' . $e->getMessage());
 }

 } else {
 Log::warning('Uploaded image file is not valid.');
 }
 } else {
 Log::info('No image file in request.');
 }

 Product::create($data);
 return redirect()->route('products.index')
 ->with('success', 'Product has been created successfully.');
 }
 /**
 * Display the specified resource.
 */
 public function show(Product $product) : View
 {
 return view('products.show', compact('product'));
 }
 /**
 * Show the form for editing the specified resource.
 */
 public function edit(Product $product) : View
 {
 return view('products.edit', compact('product'));
 }
 /**
 * Update the specified resource in storage.
 */
 public function update(Request $request, Product $product) : RedirectResponse
 {
 $request->validate([
 'code' => 'required',
 'name' => 'required',
 'quantity' => 'required|numeric',
 'price' => 'required|numeric',
 'description' => 'required',
 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
 ]);
 $data = $request->all();
 if ($request->hasFile('image')) {
 // Delete old image
 if ($product->image) {
 Storage::disk('public')->delete($product->image);
 }
 // Store new image
 $image = $request->file('image');
 $imageName = time() . '.' . $image->getClientOriginalExtension();
 $image->storeAs('products', $imageName, 'public');
 $data['image'] = 'products/' . $imageName;
 }
 $product->update($data);
 return redirect()->route('products.index')
 ->with('success', 'Product has been updated successfully.');
 }
 /**
 * Remove the specified resource from storage.
 */
 public function destroy(Product $product) : RedirectResponse
 {
 if ($product->image) {
 Storage::disk('public')->delete($product->image);
 }
 $product->delete();
 return redirect()->route('products.index')
 ->with('success', 'Product has been deleted successfully.');
 }
}