<div>
    <label for="{{ $id ?? $name }}" class="block mb-2 text-sm font-medium text-gray-700">
        {{ $label }}
    </label>
    <select id="{{ $id ?? $name }}" name="{{ $name }}" wire:model="{{ $wireModel ?? $name }}"
        class="w-full px-4 py-3 border-2 rounded-xl focus:ring-2 focus:ring-violet-300 focus:border-violet-400 outline-none transition bg-white/50 {{ $errors->has($name) ? 'border-red-500' : '' }}">
        <option value="">{{ $placeholder ?? 'Pilih Opsi' }}</option>
        @foreach ($options as $option)
        <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
        @endforeach
    </select>
    @if ($errors->has($name))
    <span class="text-sm text-red-500">{{ $errors->first($name) }}</span>
    @endif
</div>