<li class="mb-2">
    <a href="{{ $href }}" class="block px-4 py-2 text-gray-800 rounded 
              {{ $active ? 'bg-violet-100' : 'hover:bg-violet-100' }}">
        @if($icon)
        <i class="{{ $icon }} mr-2"></i>
        @endif
        {{ $label }}
    </a>
</li>