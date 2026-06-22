<x-admin-layout>
    <div class="max-w-7xl mx-auto py-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-2xl font-bold text-gray-900">Edit Produk</h3>
                <p class="text-gray-500 text-sm mt-1">Ubah data alat grill atau paket BBQ.</p>
            </div>
            <a href="{{ route('products.index') }}"
                class="px-4 py-2 rounded-lg bg-gray-900 text-white text-sm font-semibold hover:bg-gray-800 transition">
                KEMBALI
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
            <div class="p-6">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">GAMBAR SAAT INI</label>
                        <div class="mb-3">
                            <img src="{{ asset('/storage/products/'.$product->image) }}" class="w-[200px] rounded-lg border border-gray-200 shadow-sm" alt="{{ $product->title }}">
                        </div>
                        <input type="file" name="image"
                            class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-gray-900 file:text-white hover:file:bg-gray-800 border border-gray-200 rounded-lg bg-white">
                        <span class="text-xs text-gray-500 mt-1 block">*Abaikan jika tidak ingin mengubah gambar</span>
                        @error('image')
                            <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">NAMA PRODUK</label>
                        <input type="text" name="title" value="{{ old('title', $product->title) }}" placeholder="Masukkan Nama Produk"
                            class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                        @error('title')
                            <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">KATEGORI</label>
                        <select name="category_id" class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">TAGS</label>
                        <div class="flex flex-wrap gap-4 border border-gray-200 rounded-lg px-4 py-3 bg-white">
                            @foreach ($tags as $tag)
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                        class="rounded border-gray-300 text-amber-600 focus:ring-amber-500"
                                        {{ (is_array(old('tags', $product->tags->pluck('id')->toArray())) && in_array($tag->id, old('tags', $product->tags->pluck('id')->toArray()))) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700">{{ $tag->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('tags')
                            <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">DESKRIPSI</label>
                        <textarea name="description" id="description" rows="6"
                            class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500"
                            placeholder="Masukkan Deskripsi Produk">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">HARGA SEWA (Rp)</label>
                            <input type="number" name="price" value="{{ old('price', $product->price) }}" placeholder="Contoh: 50000"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('price')
                                <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">STOK (Jumlah Tersedia)</label>
                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" placeholder="Contoh: 10"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('stock')
                                <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-4">
                        <button type="submit"
                            class="inline-flex items-center justify-center px-6 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-bold hover:bg-blue-700 transition shadow-sm">
                            UPDATE DATA
                        </button>
                        <button type="reset"
                            class="inline-flex items-center justify-center px-6 py-2.5 rounded-lg bg-gray-200 text-gray-800 text-sm font-bold hover:bg-gray-300 transition">
                            RESET
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
</x-admin-layout>