<?php

namespace App\Livewire;

use function Livewire\Volt\{with, usesPagination, state, usesFileUploads, rules, computed, updated};
use App\Models\Banner;
use App\Models\Constituency;
use App\Models\Region;
use Livewire\Attributes\Validate;

use Illuminate\Support\Facades\Storage;

usesPagination();
usesFileUploads();

rules([
    'title' => 'required|string|max:255',
    'description' => 'nullable|string',
    'image' => 'nullable|image|max:1024',
    'expires_at' => 'nullable|date',
    'region_id' => 'sometimes|exists:regions,id',
    'constituency_id' => 'sometimes:region_id|exists:constituencies,id',
    'bannerable_type' => 'sometimes|in:null,Constituency,Region,Nation',
    // 'bannerable_id' => [
    //     'required_with:bannerable_type',
    //     function ($attribute, $value, $fail) {
    //         if ($this->bannerable_type && $this->bannerable_type !== 'null') {
    //             $modelClass = 'App\\Models\\' . $this->bannerable_type;
    //             if (!class_exists($modelClass) || !$modelClass::find($value)) {
    //                 $fail("The selected {$attribute} is invalid.");
    //             }
    //         }
    //     },
    // ],
]);

with(['banners' => fn() => Banner::with('bannerable')->latest()->paginate(10)]);
state(['open' => false, 'title' => '', 'description' => '', 'expires_at' => '', 'image' => '', 'id' => null, 'bannerable_id' => null]);
state(['bannerable_type' => null, 'region_id' => null, 'constituency_id' => null])->url();

$cbannerable_type = computed(fn() => $this->bannerable_type);

$bannerables = computed(function () {
    \Log::info('bannerable_type update fired' . $this->cbannerable_type);

    $bannerable_type = $this->bannerable_type;
    $isBannerable = $this->bannerable_type && !in_array($this->bannerable_type !== 'null', ['', null]);
    \Log::info(compact('isBannerable', 'bannerable_type'));

    if (!$isBannerable) {
        return collect();
    }
    $modelClass = 'App\\Models\\' . $this->bannerable_type;
    if (class_exists($modelClass)) {
        return $modelClass::all();
    }
});

$regions = computed(fn() => in_array($this->bannerable_type, ['Region', 'Constituency']) ? Region::all() : []);

$constituencies = computed(fn() => $this->bannerable_type === 'Constituency' ? Constituency::where('region_id', $this->region_id)->get() : []);

$delete = function (Banner $banner) {
    try {
        if ($banner->image_path) {
            Storage::delete($banner->image_path);
        }
        $banner->delete();
    } catch (Exception $ex) {
    }
};

$toggleModal = fn($state = false) => ($this->open = $state);

$toggleOpen = fn() => $this->toggleModal(true);
$closeModal = fn() => $this->toggleModal(false);

updated([
    'bannerable_type' => function () {
        $this->region_id = null;
        $this->constituency_id = null;
    },
]);

updated(['region_id' => fn() => ($this->constituency_id = null)]);

$saveBanner = function () {
    $validatedData = $this->validate();

    if ($this->image) {
        $path = $this->image->store('banners', 'public');
        $validatedData['image_url'] = asset(Storage::url($path));
    }

    $bannerable_id = $validatedData['constituency_id'] ?? $validatedData['region_id'];

    $bannerable_type = sprintf('%s%s', $this->bannerable_type ? '\\App\\Models\\' : null, $this->bannerable_type);

    $data = ['image_path' => $path] + compact('bannerable_id', 'bannerable_type') + $validatedData;

    \Log::info('data log', compact('data'));
    \Log::info('validatedData log', compact('validatedData'));
    Banner::updateOrCreate(['id' => $this->id], $data);

    $this->reset(['title', 'description', 'image', 'expires_at', 'id', 'bannerable_type', 'bannerable_id', 'region_id', 'constituency_id']);
    $this->open = false;
    // $this->emit('bannerSaved');
};
?>

<div>

    <div class="nfc-banners-cmp p-4">

        <div class="nfc-create-edit-form flex flex-col">

            <div class='flex flex-row'>

                <button class='btn btn-primary ml-auto' wire:click="toggleOpen">Create Banner</button>
            </div>

            @if ($this->open)
                <div
                    class="position-absolute overflow-hidden radius-10 shadow mt-2 fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75">
                    <div class="bg-white p-3 rounded-lg shadow-lg w-1/2">
                        <h2 class="text-xl mb-4" x-text="editMode ? 'Edit Banner' : 'Create Banner'"></h2>
                        <form wire:submit.prevent="saveBanner">

                            <div class="mb-4">
                                <label for="bannerable_type" class="block text-sm font-medium text-gray-700">Bannerable
                                    Type</label>
                                <select id="bannerable_type" wire:model.live="bannerable_type"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">Select Type</option>
                                    <option value="">Nation</option>
                                    <option value="Region">Region</option>
                                    <option value="Constituency">Constituency</option>
                                </select>
                                @error('bannerable_type')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="mb-4">
                                <label for="region_id" class="block text-sm font-medium text-gray-700">
                                    Choose Region</label>

                                <select id="region_id" wire:model.live="region_id"
                                    {{ !in_array($bannerable_type, ['Region', 'Constituency']) ? 'disabled' : '' }}
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">Select</option>
                                    @foreach ($this->regions as $bannerable)
                                        <option wire:key='{{ $bannerable->id }}' value="{{ $bannerable->id }}">
                                            {{ $bannerable->name }}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" id="bannerable_id" wire:model="bannerable_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                @error('bannerable_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="constituency_id" class="block text-sm font-medium text-gray-700">
                                    Choose Constituency</label>

                                <select id="constituency_id" wire:model.live="constituency_id"
                                    {{ $bannerable_type !== 'Constituency' ? 'disabled' : '' }}
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">Select</option>
                                    @foreach ($this->constituencies as $bannerable)
                                        <option wire:key='{{ $bannerable->id }}' value="{{ $bannerable->id }}">
                                            {{ $bannerable->name }}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" id="bannerable_id" wire:model="bannerable_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"> --}}
                                @error('bannerable_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                <input type="text" id="title" wire:model="title"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                @error('title')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="description"
                                    class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="description" wire:model="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                                @error('description')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                                <input type="file" id="image" wire:model="image"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                @error('image')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="expires_at" class="block text-sm font-medium text-gray-700">Expires
                                    At</label>
                                <input type="date" id="expires_at" wire:model="expires_at"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                @error('expires_at')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex justify-end">
                                <button type="button" wire:click="closeModal" class="btn">Cancel</button>
                                <button type="submit" class="btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        <table class='table'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Bannerable</th>
                    <th>Thumbnail/Image</th>
                    <th>Created Date</th>
                    <th>Expires At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($banners as $idx => $banner)
                    <tr>
                        <td>{{ $idx + 1 }}</td>
                        <td>{{ $banner->title }}</td>
                        <td>{{ Str::limit($banner->description, 54) }}</td>
                        <td>{{ explode('\\', $banner->bannerable_type ?? '\\App\\Model\\NoModel')[2] . "::{$banner?->bannerable?->name}" }}
                        </td>
                        <td>
                            @if ($banner->thumbnail_url)
                                <img src="{{ $banner->thumbnail_url }}" alt="Thumbnail" width="100">
                            @else
                                <img src="{{ $banner->image_url }}" alt="Image" width="100">
                            @endif
                        </td>
                        <td>{{ $banner->created_at }}</td>
                        <td>{{ $banner->expires_at }}</td>
                        <td>
                            <button class="btn btn-secondary"
                                wire:click="editBanner({{ $banner->id }})">Edit</button>
                            <button class="btn btn-danger" wire:confirm="Confirm banner deletion"
                                wire:click="delete({{ $banner->id }})">Delete</button>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $banners->links('vendor.pagination.syn-ui') }}
    </div>


</div>
