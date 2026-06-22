@props(['product'])

<div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition duration-300">
    <div class="aspect-video w-full bg-gray-100 relative">
        @if($product->image)
            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>
        @endif
        
        <div class="absolute top-3 left-3 flex flex-col gap-1">
            @foreach($product->tags as $tag)
                <span class="bg-amber-500 text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wider">
                    {{ $tag->name }}
                </span>
            @endforeach
        </div>
    </div>

    <div class="p-5">
        <h3 class="text-lg font-bold text-gray-900 mb-1 line-clamp-1">{{ $product->title }}</h3>
        <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $product->description }}</p>
        
        <div class="flex items-center justify-between">
            <span class="text-lg font-extrabold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}<span class="text-sm font-normal text-gray-500">/hari</span></span>
            <button class="bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-amber-600 transition">
                Sewa
            </button>
        </div>
    </div>
</div>