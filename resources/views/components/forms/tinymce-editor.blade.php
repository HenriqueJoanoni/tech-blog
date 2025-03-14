@props([
    'id' => 'tinymce-editor-' . uniqid(),
    'content' => '',
    'plugins' => ['code', 'table', 'lists'],
    'toolbar' => 'undo redo | blocks | bold italic',
    'options' => ''
])

<div>
    <textarea id="{{ $id }}" {{ $attributes->merge(['class' => 'tinymce-editor']) }}>{{ $content }}</textarea>
</div>

@once
    @push('head-scripts')
        <script src="https://cdn.tiny.cloud/1/{{ config('app.tinyMCE_api_key') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    @endpush
@endonce

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            tinymce.init({
                selector: 'textarea#{{ $id }}',
                plugins: @json($plugins),
                toolbar: '{{ $toolbar }}',
                @if($options)
                    {!! $options !!},
                @endif
                setup: function(editor) {
                    editor.on('init', function() {
                        editor.setContent(`{!! addslashes($content) !!}`);
                    });
                }
            });
        });
    </script>
@endpush
