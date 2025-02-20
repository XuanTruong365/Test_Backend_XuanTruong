<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Test3Controller extends Controller
{
    public function countStudentsByAge()
    {
        $averageAgeMonths = 20 * 12 + 8;
        $thresholdUpper = $averageAgeMonths + 6;
        $thresholdLower = $averageAgeMonths - 6;

        $classes = [
            ['num_classes' => 5, 'students_per_class' => 35],
            ['num_classes' => 6, 'students_per_class' => 45],
            ['num_classes' => 10, 'students_per_class' => 30],
            ['num_classes' => 4, 'students_per_class' => 40],
        ];

        $olderCount = 0;
        $youngerCount = 0;
        $totalStudents = 0;

        foreach ($classes as $class) {
            $totalStudents += $class['num_classes'] * $class['students_per_class'];

            for ($i = 0; $i < $class['num_classes'] * $class['students_per_class']; $i++) {
                $ageInMonths = rand(18 * 12, 23 * 12);

                if ($ageInMonths > $thresholdUpper) {
                    $olderCount++;
                } elseif ($ageInMonths < $thresholdLower) {
                    $youngerCount++;
                }
            }
        }

        return response()->json([
            'total_students' => $totalStudents,
            'students_older_than_6_months' => $olderCount,
            'students_younger_than_6_months' => $youngerCount,
        ]);
    }
}
