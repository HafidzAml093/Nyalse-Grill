@props(['status'])

@php
    $classes = match (strtolower($status)) {
        'pending' => 'bg-amber-100 text-amber-800 border-amber-200',
        'paid' => 'bg-blue-100 text-blue-800 border-blue-200',
        'active' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
        'completed' => 'bg-gray-100 text-gray-800 border-gray-200',
        default => 'bg-gray-100 text-gray-800 border-gray-200',
    };
@endphp

<span class="{{ $classes }} border text-xs font-semibold px-2.5 py-0.5 rounded-full capitalize">
    {{ $status }}
</span>