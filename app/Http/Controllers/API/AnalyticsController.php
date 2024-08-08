<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CampaignMessage;
use App\Models\Like;
use App\Models\Point;
use App\Models\PointTransaction;
use App\Models\Region;
use App\Models\Share;
use App\Models\User;
use App\Models\UserAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnalyticsController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $currentWeekStart = now()->startOfWeek();
        $lastWeekStart = now()->subWeek()->startOfWeek();

        $postsShared = Share::where('user_id', $user->id)->count();
        $postsSharedLastWeek = Share::where('user_id', $user->id)
            ->whereBetween('created_at', [$lastWeekStart, $currentWeekStart])
            ->count();

        $postLikes = Like::where('user_id', $user->id)->count();
        $postLikesLastWeek = Like::where('user_id', $user->id)
            ->whereBetween('created_at', [$lastWeekStart, $currentWeekStart])
            ->count();

        $postsRead = UserAction::where('user_id', $user->id)
            ->where('action_type', 'read')
            ->count();
        $postsReadLastWeek = UserAction::where('user_id', $user->id)
            ->where('action_type', 'read')
            ->whereBetween('created_at', [$lastWeekStart, $currentWeekStart])
            ->count();

        $totalPoints = Point::where('user_id', $user->id)->sum('balance');
        $totalPointsLastWeek = Point::where('user_id', $user->id)
            ->whereBetween('created_at', [$lastWeekStart, $currentWeekStart])
            ->sum('balance');

        $popularPost = CampaignMessage::withCount(['likes', 'shares'])
            ->orderByDesc('likes_count')
            ->orderByDesc('shares_count')
            ->first();

        $overviewData = UserAction::where('user_id', $user->id)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->limit(5)
            ->pluck('count')
            ->toArray();

        return response()->json([
            'postsShared' => $postsShared,
            'postsSharedChange' => $this->calculatePercentageChange($postsSharedLastWeek, $postsShared),
            'postLikes' => $postLikes,
            'postLikesChange' => $this->calculatePercentageChange($postLikesLastWeek, $postLikes),
            'postsRead' => $postsRead,
            'postsReadChange' => $this->calculatePercentageChange($postsReadLastWeek, $postsRead),
            'totalPoints' => $totalPoints,
            'totalPointsChange' => $this->calculatePercentageChange($totalPointsLastWeek, $totalPoints),
            'popularPost' => [
                'title' => $popularPost->title,
                'reads' => $popularPost->reads,
                'likes' => $popularPost->likes_count,
                'shares' => $popularPost->shares_count,
                'imageUrl' => $popularPost->image_url,
            ],
            'overviewData' => $overviewData,
        ]);
    }

    private function calculatePercentageChange($oldValue, $newValue)
    {
        if ($oldValue == 0) {
            return $newValue > 0 ? 100 : 0;
        }
        return (($newValue - $oldValue) / $oldValue) * 100;
    }

    private function getUserEngagementData()
    {
        $totalLikes = Like::count();
        $totalShares = Share::count();
        $totalReads = CampaignMessage::sum('reads');
        $dailyActiveUsers = User::where('last_activity', '>=', now()->subDay())->count();
        $totalEngagements = $totalLikes + $totalShares + $totalReads;
        $totalUsers = User::count();
        $conversionRate = $totalUsers > 0 ? ($dailyActiveUsers / $totalUsers) * 100 : 0;

        return [
            'totalLikes' => $totalLikes,
            'totalShares' => $totalShares,
            'totalReads' => $totalReads,
            'dailyActiveUsers' => $dailyActiveUsers,
            'totalEngagements' => $totalEngagements,
            'conversionRate' => round($conversionRate, 2),
        ];
    }

    private function getCampaignPerformanceData()
    {
        $campaigns = CampaignMessage::withCount(['likes', 'shares'])
            ->get()
            ->map(function ($campaign) {
                $reach = $campaign->reads;
                $engagements = $campaign->likes_count + $campaign->shares_count;
                $engagementRate = $reach > 0 ? ($engagements / $reach) * 100 : 0;
                return [
                    'name' => $campaign->title,
                    'reach' => $reach,
                    'engagementRate' => round($engagementRate, 2),
                ];
            });

        $topCampaign = $campaigns->sortByDesc('engagementRate')->first();

        return [
            'campaigns' => $campaigns->values()->all(),
            'topCampaign' => $topCampaign,
        ];
    }

    private function getPointsDistributionData()
    {
        $pointsFromLikes = PointTransaction::where('transaction_type', 'like')->sum('points');
        $pointsFromShares = PointTransaction::where('transaction_type', 'share')->sum('points');
        $pointsFromReads = PointTransaction::where('transaction_type', 'read')->sum('points');

        $totalPointsAwarded = $pointsFromLikes + $pointsFromShares + $pointsFromReads;
        $totalUsers = User::count();
        $averagePointsPerUser = $totalUsers > 0 ? $totalPointsAwarded / $totalUsers : 0;

        return [
            'pointsFromLikes' => $pointsFromLikes,
            'pointsFromShares' => $pointsFromShares,
            'pointsFromReads' => $pointsFromReads,
            'totalPointsAwarded' => $totalPointsAwarded,
            'averagePointsPerUser' => round($averagePointsPerUser, 2),
        ];
    }

    private function getRegionalBreakdownData()
    {
        $regions = Region::withCount(['users', 'constituencies'])
            ->with(['constituencies' => function ($query) {
                $query->withCount(['campaignMessages']);
            }])
            ->get()
            ->map(function ($region) {
                $totalEngagements = $region->constituencies->sum(function ($constituency) {
                    return $constituency->campaignMessages->sum(function ($message) {
                        return $message->likes_count + $message->shares_count + $message->reads;
                    });
                });

                $totalPossibleEngagements = $region->users_count * $region->constituencies->sum('campaignMessages_count');
                $engagementRate = $totalPossibleEngagements > 0 ? ($totalEngagements / $totalPossibleEngagements) * 100 : 0;

                return [
                    'name' => $region->name,
                    'userCount' => $region->users_count,
                    'constituencyCount' => $region->constituencies_count,
                    'engagementRate' => round($engagementRate, 2),
                ];
            });

        $mostActiveRegion = $regions->sortByDesc('engagementRate')->first();

        return [
            'regions' => $regions->values()->all(),
            'mostActiveRegion' => $mostActiveRegion,
        ];
    }
}
