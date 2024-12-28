<div x-data="{ preview: null }">
    <label for="{{ $id ?? $name }}" class="block mb-2 text-sm font-medium text-gray-700">
        {{ $label ?? 'Upload Gambar' }}
    </label>
    <div class="flex items-center justify-center w-full">
        <label
            class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50">
            <template x-if="preview">
                <img :src="preview" alt="Preview Image" class="object-contain w-full h-full rounded-lg" />
            </template>
            <div x-show="!preview" class="flex flex-col items-center justify-center pt-5 pb-6">
                <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                    </path>
                </svg>
                <p class="mb-2 text-sm text-gray-500">
                    Klik untuk upload gambar
                </p>
                <p class="text-xs text-gray-500">
                    PNG, JPG atau JPEG (MAX. 2MB)
                </p>
            </div>
            <input type="file" id="{{ $id ?? $name }}" {{ $name ? 'wire:model=' . $name : '' }} name="{{ $name }}"
                accept="image/*" class="hidden" @change="file => {
                    const reader = new FileReader();
                    reader.onload = e => preview = e.target.result;
                    reader.readAsDataURL(file.target.files[0]);
                }" />
        </label>
    </div>
</div>