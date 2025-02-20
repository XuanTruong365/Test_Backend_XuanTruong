<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Citizen;

class Test4Controller extends Controller
{
    public function findTop20Percent()
    {
        $averageAge = Citizen::avg('age');

        // Tính số lượng cần lấy (20% người)
        $totalCitizens = Citizen::count();
        $topCount = max(1, ceil($totalCitizens * 0.2));

        // Query để lấy top 20% người có độ lệch tuổi lớn nhất
        $topCitizens = Citizen::select('id', 'name', 'age', DB::raw("ABS(age - $averageAge) as difference"))
            ->orderByDesc('difference')
            ->limit($topCount)
            ->get();

        return response()->json($topCitizens);
    }
}

