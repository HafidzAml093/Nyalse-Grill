<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Products - Ujian Framework</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="text-center">
            <h3 class="text-2xl font-bold mb-2">Daftar Barang</h3>
            <hr class="my-6 border-gray-200">
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
            <div class="p-6">

                <a href="{{ route('products.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 rounded-lg
                           bg-emerald-600 text-white text-sm font-semibold
                           hover:bg-emerald-700 transition mb-4">
                    ADD PRODUCT
                </a>

                <div class="overflow-x-auto">
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
                            <tr class="border-b last:border-b-0">
                                <td class="px-4 py-3">
                                    <div class="flex justify-center">
                                        <img
                                            src="{{ asset('/storage/products/'.$product->image) }}"
                                            class="w-[100px] rounded-lg border border-gray-200"
                                            alt="{{ $product->title }}">
                                    </div>
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-900">
                                    {{ $product->title }}
                                </td>

                                <td class="px-4 py-3 text-emerald-600 font-semibold">
                                    {{ $product->category->name ?? 'Tanpa Kategori' }}
                                </td>

                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-1">
                                        @forelse($product->tags as $tag)
                                        <span class="bg-blue-100 text-blue-800 text-[10px] px-2 py-1 rounded-full font-semibold">
                                            #{{ $tag->name }}
                                        </span>
                                        @empty
                                        <span class="text-gray-400 text-xs">-</span>
                                        @endforelse
                                    </div>
                                </td>

                                <td class="px-4 py-3 text-gray-700">
                                    {{ "Rp " . number_format($product->price,2,',','.') }}
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    {{ $product->stock }}
                                </td>
                                <td class="px-4 py-3">
                                    <form
                                        action="{{ route('products.destroy', $product->id) }}"
                                        method="POST"
                                        class="delete-form flex items-center gap-2">
                                        <a href="{{ route('products.show', $product->id) }}"
                                            class="px-3 py-2 rounded-lg bg-gray-900 text-white
                                                      text-xs font-semibold hover:bg-gray-800 transition">
                                            SHOW
                                        </a>

                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="px-3 py-2 rounded-lg bg-blue-600 text-white
                                                      text-xs font-semibold hover:bg-blue-700 transition">
                                            EDIT
                                        </a>

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="px-3 py-2 rounded-lg bg-red-600 text-white
                                                       text-xs font-semibold hover:bg-red-700 transition">
                                            HAPUS
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-4 py-6">
                                    <div class="bg-red-50 border border-red-200 text-red-700
                                                    rounded-lg px-4 py-3 text-center font-semibold">
                                        Data Products belum ada.
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $products->links() }}
                </div>

            </div>
        </div>
    </div>

    @if(session('success'))
    <div id="flash-data" data-success="{{ session('success') }}"></div>
    @endif

    <script>
        // Logika Hapus (Delete)
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Logika Notifikasi Sukses
        const flashData = document.getElementById('flash-data');
        if (flashData) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: flashData.getAttribute('data-success'),
                timer: 3000,
                showConfirmButton: false
            });
        }
    </script>

</body>

</html>