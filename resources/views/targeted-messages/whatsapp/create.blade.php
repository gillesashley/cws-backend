@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New WhatsApp Campaign</h1>

        <form id="campaignForm" action="{{ route('targeted-messages.whatsapp.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Campaign Title</label>
                <input type="text" name="title" id="title" class="form-control" required maxlength="255"
                    value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label for="content">Message Content</label>
                <textarea name="content" id="content" class="form-control" rows="10" required>{{ old('content') }}</textarea>
            </div>

            <div class="form-group">
                <label for="media">Media (Optional)</label>
                <input type="file" name="media[]" id="media" class="form-control-file" accept="image/*,video/*"
                    multiple>
            </div>

            <div id="mediaPreview" class="mt-3">
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
            var preview = document.getElementById('mediaPreview');
            preview.innerHTML = ''; // Clear previous previews

            for (var i = 0; i < event.target.files.length; i++) {
                var file = event.target.files[i];
                var reader = new FileReader();

                reader.onload = (function(file) {
                    return function(e) {
                        var div = document.createElement('div');
                        div.className = 'mb-2';

                        if (file.type.startsWith('image/')) {
                            var img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.maxWidth = '200px';
                            img.style.maxHeight = '200px';
                            div.appendChild(img);
                        } else if (file.type.startsWith('video/')) {
                            var video = document.createElement('video');
                            video.src = e.target.result;
                            video.style.maxWidth = '200px';
                            video.style.maxHeight = '200px';
                            video.controls = true;
                            div.appendChild(video);
                        }

                        preview.appendChild(div);
                    };
                })(file);

                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
