@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="p-4 border rounded">
                    <h1>Create Affliate Campaign Message</h1>

                    <form action="{{ route('targeted-messages.all.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Campaign Title</label>
                            <input type="text" name="title" id="title" class="form-control" required maxlength="255"
                                value="{{ old('title') }}">
                        </div><br>

                        <div class="form-group">
                            <label for="content">Message Content</label>
                            <textarea name="content" id="content" class="form-control" rows="10" required maxlength="160">{{ old('content') }}</textarea>
                        </div><br>
                        <div class="form-group">
                            <label for="media">Media (Optional)</label>
                            <input type="file" name="image" id="image" class="form-control-file"
                                accept="image/*" multiple>
                        </div><br>

                        <div class="form-group">
                            <label for="region_id">Region</label>
                            <select name="region_id" id="region_id" class="form-control" required
                                onchange="renderConstituencies(event)">
                                <option value="">Select Region</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}"
                                        {{ old('region_id') == $region->id ? 'selected' : '' }}>
                                        {{ $region->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="constituency_id">Constituency</label>
                            <select name="constituency_id" id="constituency_id" class="form-control" required>
                                <option value="">Select Constituency</option>

                            </select>
                        </div><br>



                        <button type="submit" class="btn btn-primary">Send Campaign Message</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            const regions = @json($regions);
            console.log({
                regions
            });

            function makeOption(value, textContent) {
                const option = document.createElement('option');
                option.value = value;
                option.textContent = textContent;
                return option;
            }

            function renderConstituencies(event) {
                const region = regions.find(r => +r.id === +event.target.value)
                const constSelect = document.querySelector('select#constituency_id')

                while (constSelect.firstChild) {
                    constSelect.removeChild(constSelect.firstChild);
                }

                constSelect.appendChild(makeOption('', 'Select'));

                region.constituencies.forEach(constituency => {

                    constSelect.appendChild(makeOption(constituency.id, constituency.name));
                });


            }
        </script>
    @endsection
