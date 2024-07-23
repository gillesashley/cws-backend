<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class NotificationController extends Controller
{
    
    public function index(Request $request)
    {
        $notifications = QueryBuilder::for(Notification::class)
            ->where('user_id', $request->user()->id)
            ->allowedFilters([
                AllowedFilter::exact('is_read'),
                AllowedFilter::exact('campaign_message_id'),
            ])
            ->allowedSorts(['created_at'])
            ->allowedIncludes(['campaignMessage'])
            ->paginate();

        return NotificationResource::collection($notifications);
    }

    public function show(Notification $notification, Request $request)
    {
        if ($request->user()->cannot('view', $notification)) {
            abort(403);
        }

        return new NotificationResource(
            QueryBuilder::for(Notification::where('id', $notification->id))
                ->allowedIncludes(['campaignMessage'])
                ->first()
        );
    }

    public function markAsRead(Notification $notification, Request $request)
    {
        if ($request->user()->cannot('update', $notification)) {
            abort(403);
        }

        $notification->update(['is_read' => true]);

        return new NotificationResource($notification);
    }
}
