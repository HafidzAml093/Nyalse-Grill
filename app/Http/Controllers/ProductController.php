<?php

namespace App\Http\Controllers;

//import model product
use App\Models\Product;

use App\Models\Tag;

use App\Models\Category; // Tambahkan ini di bawah baris use App\Models\Product;

//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\Request;

//import Http Request
use Illuminate\Http\RedirectResponse;

//import Facades Storage
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return View
     */

    public function index(): View
    {
        // Mengambil data produk beserta relasi kategori dan tags, lalu dipaginasi
        $products = Product::with(['category', 'tags'])->latest()->paginate(10);

        // Mengembalikan ke tampilan view dengan membawa data produk
        return view('products.index', compact('products'));
    }

    /**
     * create
     *
     * @return View
     */

    public function create(): View
    {
        // Ambil semua data kategori
        $categories = Category::all();
        $tags = Tag::all();
        // Lempar data kategori ke view create
        return view('products.create', compact('categories', 'tags'));
    }

    /**
     * store
     *
     * @param mixed $request
     * @return RedirectResponse
     */

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'         => 'required|min:5',
            'description'   => 'required|min:10',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric',
            'category_id'   => 'required|exists:categories,id'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('products', $image->hashName(), 'public');

        //create product
        $product = Product::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'description'   => $request->description,
            'price'         => $request->price,
            'stock'         => $request->stock,
            'category_id'   => $request->category_id
        ]);

        if ($request->has('tags')) {
            $product->tags()->attach($request->tags);
        }

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get product by ID
        $product = Product::findOrFail($id);

        //render view with product
        return view('products.show', compact('product'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all(); // Ambil semua kategori juga

        return view('products.edit', compact('product', 'categories', 'tags'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'image'         => 'image|mimes:jpeg,jpg,png|max:2048',
            'title'         => 'required|min:5',
            'description'   => 'required|min:10',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric',
            'category_id'   => 'required|exists:categories,id'
        ]);

        //get product by ID
        $product = Product::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //hapus gambar lama
            Storage::disk('public')->delete('products/' . $product->image);

            //upload gambar baru
            $image = $request->file('image');
            $image->storeAs('products', $image->hashName(), 'public');

            //update product with new image
            $product->update([
                'image'         => $image->hashName(),
                'title'         => $request->title,
                'description'   => $request->description,
                'price'         => $request->price,
                'stock'         => $request->stock,
                'category_id'   => $request->category_id
            ]);
        } else {

            //update product without image
            $product->update([
                'title'         => $request->title,
                'description'   => $request->description,
                'price'         => $request->price,
                'stock'         => $request->stock,
                'category_id'   => $request->category_id
            ]);
        }

        if ($request->has('tags')) {
            $product->tags()->sync($request->tags);
        } else {
            $product->tags()->detach();
        }
        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get product by ID
        $product = Product::findOrFail($id);

        //delete image
        Storage::disk('public')->delete('products/' . $product->image);

        //delete product
        $product->delete();

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
