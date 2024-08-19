<?php

use function Livewire\Volt\{state};

state(['meta' => []]);

?>

<div class="d-flex flex-col">

    @if ($meta['total'] > 0)
        <div class="pagination d-flex gap-4 m-2 p-1 radius-10 border">
            <div class="pagination-summary m-auto">
                Showing {{ $meta['from'] }} to {{ $meta['to'] }} of {{ $meta['total'] }} results
            </div>
            <div class="pagination-links gap-4">
                @if ($meta['current_page'] > 1)
                    <a href="{{ url($meta['path'] . '?page=' . $meta['current_page'] - 1) }}"
                        class="pagination-link">Previous</a>
                @endif

                @for ($i = 1; $i <= $meta['last_page']; $i++)
                    @if ($i == $meta['current_page'])
                        <span class="pagination-link current btn">{{ $i }}</span>
                    @else
                        <a href="{{ url($meta['path'] . '?page=' . $i) }}"
                            class="pagination-link btn">{{ $i }}</a>
                    @endif
                @endfor

                @if ($meta['current_page'] < $meta['last_page'])
                    <a href="{{ url($meta['path'] . '?page=' . $meta['current_page'] + 1) }}"
                        class="pagination-link btn">Next</a>
                @endif
            </div>
        </div>
    @endif
</div>
