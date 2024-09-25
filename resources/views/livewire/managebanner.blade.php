<?php

use function Livewire\Volt\{with, usesPagination, state};
use App\Models\Banner;

usesPagination();

with(['banners' => fn() => Banner::with('bannerable')->paginate(10)]);

$delete = fn(Banner $banner) => $banner->delete();
?>

<div class="p-4">
    <div>Volted</div>
    <table class='table'>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Bannerable</th>
                <th>Thumbnail/Image</th>
                <th>Created Date</th>
                <th>Expires At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $banner)
                <tr>
                    <td>{{ $banner->title }}</td>
                    <td>{{ $banner->description }}</td>
                    <td>{{ explode('\\', $banner->bannerable_type)[2] . "::{$banner->bannerable->name}" }}</td>
                    <td>
                        @if ($banner->thumbnail_url)
                            <img src="{{ $banner->thumbnail_url }}" alt="Thumbnail" width="100">
                        @else
                            <img src="{{ $banner->image_url }}" alt="Image" width="100">
                        @endif
                    </td>
                    <td>{{ $banner->created_at }}</td>
                    <td>{{ $banner->expires_at }}</td>
                    <td> <button wire:click="editBanner({{ $banner->id }})">Edit</button>
                        <button wire:confirm="Confirm banner deletion"
                            wire:click="delete({{ $banner->id }})">Delete</button>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $banners->links('vendor.pagination.syn-ui') }}
</div>
</div>
