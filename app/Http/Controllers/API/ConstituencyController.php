<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Constituency;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Resources\ConstituencyResource;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class ConstituencyController extends Controller
{
    /**
     * Display a listing of the constituencies.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $constituencies = QueryBuilder::for(Constituency::class)
            ->allowedFilters([
                AllowedFilter::exact('region_id'),
                'name',
            ])
            ->allowedSorts(['name'])
            ->paginate();

        return ConstituencyResource::collection($constituencies);
    }

    /**
     * Display the specified constituency.
     *
     * @param  \App\Models\Constituency  $constituency
     * @return ConstituencyResource
     */
    public function show(Constituency $constituency)
    {
        return new ConstituencyResource($constituency);
    }

    /**
     * Get constituencies for a specific region.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getByRegion(Region $region)
    {
        $constituencies = $region->constituencies()
            ->orderBy('name')
            ->get();

        return ConstituencyResource::collection($constituencies);
    }

    /**
     * Store a newly created constituency in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ConstituencyResource
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
        ]);

        $constituency = Constituency::create($validatedData);

        return new ConstituencyResource($constituency);
    }

    /**
     * Update the specified constituency in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Constituency  $constituency
     * @return ConstituencyResource
     */
    public function update(Request $request, Constituency $constituency)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'region_id' => 'sometimes|required|exists:regions,id',
        ]);

        $constituency->update($validatedData);

        return new ConstituencyResource($constituency);
    }

    /**
     * Remove the specified constituency from storage.
     *
     * @param  \App\Models\Constituency  $constituency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Constituency $constituency)
    {
        $constituency->delete();

        return response()->json(null, 204);
    }
}
