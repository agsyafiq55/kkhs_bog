<div wire:ignore>
  <div id="editor_{{ $model }}" class="quill-editor">
    {!! $content !!}
  </div>
</div>

@once
  @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
  @endpush
  @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
  @endpush
@endonce

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const modelName = @json($model);
    const editorId  = 'editor_' + modelName;
    const initial   = @json($content);

    const quill = new Quill('#' + editorId, {
      theme: 'snow',
      modules: {
        toolbar: [
          [{ header: [1, 2, false] }],
          ['bold','italic','underline'],
          ['image','code-block','blockquote']
        ]
      }
    });

    // set initial HTML
    quill.root.innerHTML = initial;

    // image handler (base64 inline)
    quill.getModule('toolbar').addHandler('image', () => {
      const input = document.createElement('input');
      input.setAttribute('type','file');
      input.setAttribute('accept','image/*');
      input.click();
      input.onchange = () => {
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = () => {
          const base64 = reader.result;
          const range = quill.getSelection();
          quill.insertEmbed(range.index, 'image', base64);
        };
        reader.readAsDataURL(file);
      };
    });

    // sync back to parent
    quill.on('text-change', () => {
      const html = quill.root.innerHTML;
      @this.updateContent(html);
    });
  });
</script>
@endpush

@error($model)
  <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
@enderror
