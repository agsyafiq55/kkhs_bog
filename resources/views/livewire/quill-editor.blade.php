

<div>
    <div>
        @once
            @push('styles')
                <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
            @endpush

            @push('scripts')
                <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
            @endpush
        @endonce

        <!-- Create the editor container -->
        <div wire:ignore>
            <div id="editor_{{ $model }}" class="quill-editor">
                <p>Hello World!</p>
                <p>Some initial <strong>bold</strong> text</p>
                <p><br /></p>
            </div>
        </div>

        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const modelName = @json($model);
                    const editorId = 'editor_' + modelName;
                    const quill = new Quill('#' + editorId, {
                        theme: 'snow',
                        modules: {
                            toolbar: [
                                [{
                                    header: [1, 2, false]
                                }],
                                ['bold', 'italic', 'underline'],
                                ['image', 'code-block', 'blockquote']
                            ]
                        }
                    });

                    // Get reference to Livewire component
                    const livewireComponent = window.Livewire.find(document.querySelector('[wire\\:id]').getAttribute('wire:id'));

                    // Initialize content
                    const initialContent = livewireComponent.get(modelName);
                    if (initialContent) {
                        quill.root.innerHTML = initialContent;
                    }

                    // Update model on change
                    quill.on('text-change', function() {
                        livewireComponent.set(modelName, quill.root.innerHTML);
                    });
                });
            </script>
        @endpush

        @error($model)
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>
</div>
