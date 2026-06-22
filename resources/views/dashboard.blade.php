<x-admin-layout>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Inventory Management</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola data alat grill dan paket BBQ Nyalse.</p>
        </div>
        <button class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg font-semibold text-sm transition">
            + Tambah Alat
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        
        @php
            // Ini data dummy murni untuk ngetes tampilan komponenmu
            $dummyProduct = (object) [
                'title' => 'Paket Grill Sultan',
                'description' => 'Panggangan besar lengkap dengan capitan, arang, dan kuas.',
                'price' => 75000,
                'image' => null,
                'tags' => [(object)['name' => 'Paket Lengkap'], (object)['name' => 'Terlaris']]
            ];
        @endphp

        <x-product-card :product="$dummyProduct" />
        <x-product-card :product="$dummyProduct" />
        <x-product-card :product="$dummyProduct" />

    </div>
</x-admin-layout>