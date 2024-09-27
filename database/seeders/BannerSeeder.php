<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Constituency;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Constituency::all()->flatMap(
            fn($ct) =>
            Banner::factory(random_int(2, 7))
                ->sequence(fn($sq) => ['expires_at' => now()->addDays(random_int(0, 90))->toDateTimeString()])
                ->make(['bannerable_id' => $ct->id, 'bannerable_type' => Constituency::class])
        )->chunk(50)->each(
                fn($chunk, $c) =>
                [Banner::insert($chunk->toArray()), printf("\ndispatch constituency/banner::seed {$c} * 50")]
            );

        Region::all()->flatMap(
            fn($ct) =>
            Banner::factory(random_int(2, 7))
                ->sequence(fn($sq) => ['expires_at' => now()->addDays(random_int(0, 90))])
                ->make(['bannerable_id' => $ct->id, 'bannerable_type' => Region::class])
        )->chunk(50)->each(
                fn($chunk, $c) =>
                [Banner::insert($chunk->toArray()), printf("\ndispatch Region/banner::seed chunk {$c} * 40")]
            );


        Banner::factory(10)->make()->chunk(10)->each(fn($chunk, $c) => [Banner::insert($chunk->toArray()), printf("\ seed national banners {$c} * 50")]);

    }
}
