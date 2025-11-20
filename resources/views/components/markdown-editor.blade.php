<div>
    <label class="block text-xl font-semibold text-sky-600 mb-3">
        {{ $label }}
        @if($required) <span class="text-red-500">*</span> @endif
    </label>

    <div wire:ignore>
        <textarea
            id="easymde-{{ $name }}"
            class="easymde-textarea"
            placeholder="{{ $placeholder }}"
        >{{ $content }}</textarea>
    </div>

    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror

    <script>
        document.addEventListener('livewire:initialized', () => {
            const textarea = document.getElementById('easymde-{{ $name }}');
            if (!textarea) return;

            const editor = new EasyMDE({
                element: textarea,
                spellChecker: false,
                placeholder: '{{ $placeholder }}',
                toolbar: [
                    "bold", "italic", "heading", "|",
                    "quote", "unordered-list", "ordered-list", "|",
                    "link", "image", "|",
                    "preview", "side-by-side", "fullscreen"
                ],
                status: false,
                hideIcons: ["guide", "heading"],
                forceSync: true,
                renderingConfig: {
                    codeSyntaxHighlighting: false  // matikan highlight.js
                }
            });

            editor.codemirror.on("change", () => {
                @this.set('content', editor.value());
            });

            @this.on('update-easymde-{{ $name }}', (value) => {
                if (editor.value() !== value) {
                    editor.value(value);
                }
            });
        });
    </script>
</div>