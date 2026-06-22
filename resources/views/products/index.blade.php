<x-admin-layout>
    <div class="max-w-7xl mx-auto py-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-2xl font-bold text-gray-900">Daftar Alat & Paket Grill</h3>
                <p class="text-gray-500 text-sm mt-1">Kelola inventaris barang yang bisa disewa.</p>
            </div>
            <a href="{{ route('products.create') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-amber-600 text-white text-sm font-semibold hover:bg-amber-700 transition">
                + Tambah Product
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
            <div class="p-6 overflow-x-auto">
                <table class="w-full text-sm border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-50 text-gray-700">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold border-b">IMAGE</th>
                            <th class="px-4 py-3 text-left font-semibold border-b">TITLE</th>
                            <th class="px-4 py-3 text-left font-semibold border-b">CATEGORY</th>
                            <th class="px-4 py-3 text-left font-semibold border-b">TAGS</th>
                            <th class="px-4 py-3 text-left font-semibold border-b">PRICE</th>
                            <th class="px-4 py-3 text-left font-semibold border-b">STOCK</th>
                            <th class="px-4 py-3 text-left font-semibold border-b w-[220px]">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <!-- (Biarkan isi tr dan td persis seperti kodemu sebelumnya) -->
                            <tr class="border-b last:border-b-0">
                                <td class="px-4 py-3">
                                    <img src="{{ asset('/storage/products/'.$product->image) }}" class="w-[80px] rounded-lg border border-gray-200" alt="{{ $product->title }}">
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $product->title }}</td>
                                <td class="px-4 py-3 text-emerald-600 font-semibold">{{ $product->category->name ?? 'Tanpa Kategori' }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($product->tags as $tag)
                                            <span class="bg-blue-100 text-blue-800 text-[10px] px-2 py-1 rounded-full font-semibold">#{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-gray-700">Rp {{ number_format($product->price,2,',','.') }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $product->stock }}</td>
                                <td class="px-4 py-3">
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form flex items-center gap-2">
                                        <a href="{{ route('products.edit', $product->id) }}" class="px-3 py-2 rounded-lg bg-blue-600 text-white text-xs font-semibold hover:bg-blue-700 transition">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-2 rounded-lg bg-red-600 text-white text-xs font-semibold hover:bg-red-700 transition">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-red-500 font-semibold">Data Products belum ada.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">{{ $products->links() }}</div>
            </div>
        </div>
    </div>

    <!-- Pindahkan Script SweetAlert ke sini -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
        <script>
            Swal.fire({icon: 'success', title: 'Berhasil', text: '{{ session('success') }}', timer: 3000, showConfirmButton: false});
        </script>
    @endif
</x-admin-layout>