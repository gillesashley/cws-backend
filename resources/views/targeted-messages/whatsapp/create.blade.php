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
        document.getElementById('media').addEventListener('change', function(event) {
            var files = event.target.files;
            var previewContainer = document.getElementById('mediaPreview');
            previewContainer.innerHTML = ''; // Clear previous previews

            if (files.length > 0) {
                previewContainer.style.display = 'block';
            } else {
                previewContainer.style.display = 'none';
            }

            Array.from(files).forEach(function(file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var previewElement;
                    if (file.type.startsWith('image/')) {
                        previewElement = document.createElement('img');
                        previewElement.style.maxWidth = '300px';
                        previewElement.style.maxHeight = '300px';
                        previewElement.src = e.target.result;
                    } else if (file.type.startsWith('video/')) {
                        previewElement = document.createElement('video');
                        previewElement.style.maxWidth = '300px';
                        previewElement.style.maxHeight = '300px';
                        previewElement.controls = true;
                        previewElement.src = e.target.result;
                    }

                    previewContainer.appendChild(previewElement);
                }

                if (file) {
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush
