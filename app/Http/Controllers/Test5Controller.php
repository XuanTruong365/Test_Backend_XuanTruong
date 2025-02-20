<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class Test5Controller extends Controller
{
    public function getFurthestPeople()
    {
        return Cache::remember('furthest_people', now()->addMinutes(10), function () {
            return DB::select("
                WITH ClosestFlags AS (
                    SELECT pf1.person_id, pf1.flag_id AS flag1, pf1.distance AS distance1,
                           pf2.flag_id AS flag2, pf2.distance AS distance2
                    FROM people_flags pf1
                    JOIN people_flags pf2 ON pf1.person_id = pf2.person_id AND pf1.flag_id != pf2.flag_id
                    WHERE pf1.distance <= pf2.distance
                    GROUP BY pf1.person_id
                ),
                DistanceTable AS (
                    SELECT p1.id, p1.name, p1.x, p1.y, MIN(SQRT(POW(p1.x - p2.x, 2) + POW(p1.y - p2.y, 2))) AS min_distance
                    FROM people p1
                    JOIN people p2 ON p1.id != p2.id
                    GROUP BY p1.id, p1.name, p1.x, p1.y
                )
                SELECT * FROM DistanceTable
                ORDER BY min_distance DESC
                LIMIT (SELECT COUNT(*) * 0.1 FROM people);
            ");
        });
    }
}
