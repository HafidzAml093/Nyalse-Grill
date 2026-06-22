<x-admin-layout>
    <div class="max-w-7xl mx-auto py-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-2xl font-bold text-gray-900">Detail Produk</h3>
                <p class="text-gray-500 text-sm mt-1">Lihat informasi detail mengenai alat atau paket ini.</p>
            </div>
            <a href="{{ route('products.index') }}"
                class="px-4 py-2 rounded-lg bg-gray-900 text-white text-sm font-semibold hover:bg-gray-800 transition">
                KEMBALI
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                <div class="md:col-span-4">
                    <div class="border border-gray-200 rounded-2xl overflow-hidden shadow-sm bg-gray-50 flex items-center justify-center p-2">
                        <img src="{{ asset('/storage/products/'.$product->image) }}" class="w-full rounded-xl object-cover" alt="{{ $product->title }}">
                    </div>
                </div>
                <div class="md:col-span-8">
                    <div>
                        <h3 class="text-3xl font-extrabold text-gray-900">{{ $product->title }}</h3>
                        
                        <div class="flex items-center gap-3 mt-4 mb-6">
                            <span class="bg-amber-100 text-amber-800 text-sm font-semibold px-4 py-1.5 rounded-full border border-amber-200">
                                Kategori: {{ $product->category->name ?? 'Tanpa Kategori' }}
                            </span>
                            <span class="bg-gray-100 text-gray-700 text-sm font-semibold px-4 py-1.5 rounded-full border border-gray-200">
                                Stok: {{ $product->stock }} Unit
                            </span>
                        </div>

                        <div class="mb-6">
                            <p class="text-emerald-600 text-3xl font-black">
                                {{ "Rp " . number_format($product->price,0,',','.') }} <span class="text-lg font-medium text-gray-500">/ hari</span>
                            </p>
                        </div>

                        <hr class="my-6 border-gray-200">

                        <div>
                            <h4 class="text-sm font-bold text-gray-900 mb-3 uppercase tracking-wider">Deskripsi Lengkap</h4>
                            <div class="prose max-w-none text-gray-600 text-sm leading-relaxed">
                                {!! $product->description !!}
                            </div>
                        </div>
                        
                        @if($product->tags->count() > 0)
                            <div class="mt-6 pt-6 border-t border-gray-100">
                                <h4 class="text-sm font-bold text-gray-900 mb-3 uppercase tracking-wider">Tags</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($product->tags as $tag)
                                        <span class="bg-gray-800 text-white text-xs px-3 py-1 rounded-md font-medium tracking-wide">
                                            #{{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>