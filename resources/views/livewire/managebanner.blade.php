<?php

namespace App\Livewire;

use function Livewire\Volt\{with, usesPagination, state, usesFileUploads, rules};
use App\Models\Banner;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;

usesPagination();
usesFileUploads();

rules([
    'title' => 'required|string|max:255',
    'description' => 'nullable|string',
    'image' => 'nullable|image|max:1024',
    'expires_at' => 'nullable|date',
]);

with(['banners' => fn() => Banner::with('bannerable')->latest()->paginate(10)]);
state(['open' => false, 'title' => '', 'description' => '', 'expires_at' => '', 'image' => '', 'id' => null]);

$delete = fn(Banner $banner) => $banner->delete();

$toggleModal = fn($state = false) => ($this->open = $state);

$toggleOpen = fn() => $this->toggleModal(true);
$closeModal = fn() => $this->toggleModal(false);

$saveBanner = function () {
    $validatedData = $this->validate();

    if ($this->image) {
        $validatedData['image_url'] = Storage::url($this->image->store('banners', 'public'));
    }

    Banner::updateOrCreate(['id' => $this->id], $validatedData);

    $this->reset(['title', 'description', 'image', 'expires_at', 'id']);
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
                <div x-show="open"
                    class="position-absolute overflow-hidden radius-10 shadow mt-2 fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75">
                    <div class="bg-white p-3 rounded-lg shadow-lg w-1/2">
                        <h2 class="text-xl mb-4" x-text="editMode ? 'Edit Banner' : 'Create Banner'"></h2>
                        <form wire:submit.prevent="saveBanner">
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
