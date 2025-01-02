<div class="flex items-center justify-between px-6 py-4 bg-white border-t">
    <div class="flex items-center text-sm text-gray-500 space-x-1">
        <span>Showing</span>
        @if ($paginator->firstItem())
        <span class="font-medium">{{ $paginator->firstItem() }}</span>
        <span>{!! __('to') !!}</span>
        <span class="font-medium">{{ $paginator->lastItem() }}</span>
        @else
        <span>{{ $paginator->count() }}</span>
        @endif
        <span>of {{ $paginator->total() }} entries</span>
    </div>
    <div class="flex space-x-2">
        @if ($paginator->onFirstPage())
        <button class="px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100 disabled:opacity-50"
            disabled>
            Previous
        </button>
        @else
        <a href="{{ $paginator->previousPageUrl() }}"
            class="px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100">
            Previous
        </a>
        @endif

        @foreach ($elements as $element)
        @if (is_string($element))
        <span class="px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100">
            {{ $element }}
        </span>
        @endif

        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <span class="px-3 py-1 text-sm text-white bg-violet-600 rounded-lg hover:bg-violet-700">
            {{ $page }}
        </span>
        @else
        <a href="{{ $url }}" class="px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100">
            {{ $page }}
        </a>
        @endif
        @endforeach
        @endif
        @endforeach

        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
            class="px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100">
            Next
        </a>
        @else
        <button class="px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100 disabled:opacity-50"
            disabled>
            Next
        </button>
        @endif
    </div>
</div>