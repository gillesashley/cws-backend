<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RegionResource;
use App\Models\Region;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class RegionController extends Controller
{
    public function index()
    {
        $regions = QueryBuilder::for(Region::class)
            ->allowedSorts(['name'])
            ->allowedIncludes(['constituencies'])
            ->paginate();

        return RegionResource::collection($regions);
    }

    public function show(Region $region)
    {
        return new RegionResource(
            QueryBuilder::for(Region::where('id', $region->id))
                ->allowedIncludes(['constituencies'])
                ->first()
        );
    }
}
