<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Inertia\Inertia;
use Illuminate\Support\Facades\File; 

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return Inertia::render('Products/Index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Products/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'stock' => 'required'
        ]);

        $path = $request->hasFile('photo') ? $this->saveToPublic($request->file('photo')) : NULL;

        Product::create([
            'name' => $request->name,
            'stock' => $request->stock,
            'photo' => $path
        ]);

        return redirect()->route('products.index');
    }

    private function saveToPublic($file) {
        $fileName = md5($file . time()) . '.' . $file->getClientOriginalExtension();
        $file->move('images', $fileName);

        return '/images/' . $fileName;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return Inertia::render('Products/Detail', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render('Products/Edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'stock' => 'required'
        ]);

        $updatedField = [
            'name' => $request->name,
            'stock' => $request->stock
        ];

        if ($request->hasFile('photo')) {
            $this->deleteOldFile($product->photo);
            $updatedField['photo'] = $this->saveToPublic($request->file('photo'));
        }
        
        $product->update($updatedField);

        return redirect()->route('products.index');
    }

    private function deleteOldFile($path) {
        File::delete($path);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->deleteOldFile($product->photo);
        $product->delete();

        return redirect()->route('products.index');
    }
}
