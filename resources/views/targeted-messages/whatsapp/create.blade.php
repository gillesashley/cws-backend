@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New WhatsApp Campaign</h1>

        <form action="{{ route('targeted-messages.whatsapp.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Campaign Title</label>
                <input type="text" name="title" id="title" class="form-control" required maxlength="255"
                    value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label for="content">Message Content</label>
                <textarea name="content" id="content" class="form-control" rows="3" required>{{ old('content') }}</textarea>
            </div>

            <div class="form-group">
                <label for="media">Media (Optional)</label>
                <input type="file" name="media[]" id="media" class="form-control-file" accept="image/*,video/*"
                    multiple>
            </div>

            <div id="mediaPreview" class="mt-3" style="display: none;">
                <!-- Previews will be appended here -->
            </div>

            <div class="form-group">
                <label>Recipients</label>
                @foreach ($constituencyMembers as $member)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="recipients[]" value="{{ $member->id }}"
                            id="member{{ $member->id }}">
                        <label class="form-check-label" for="member{{ $member->id }}">
                            {{ $member->name }} ({{ $member->phone }})
                        </label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Send WhatsApp Campaign</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $('#media').on('change', function(event) {
            var files = event.target.files;
            var $previewContainer = $('#mediaPreview');
            $previewContainer.empty(); // Clear previous previews

            if (files.length > 0) {
                $previewContainer.show();
            } else {
                $previewContainer.hide();
            }

            $.each(files, function(index, file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var $previewElement;
                    if (file.type.startsWith('image/')) {
                        $previewElement = $('<img>', {
                            src: e.target.result,
                            style: 'max-width: 300px; max-height: 300px;'
                        });
                    } else if (file.type.startsWith('video/')) {
                        $previewElement = $('<video>', {
                            src: e.target.result,
                            controls: true,
                            style: 'max-width: 300px; max-height: 300px;'
                        });
                    }

                    $previewContainer.append($previewElement);
                }

                if (file) {
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush
