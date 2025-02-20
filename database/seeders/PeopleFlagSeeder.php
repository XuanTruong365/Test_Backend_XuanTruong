<?php

namespace Database\Seeders;

use App\Models\Flag;
use App\Models\People;
use App\Models\PeopleFlag;
use Illuminate\Database\Seeder;

class PeopleFlagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $people = People::all();
        $flags = Flag::all();

        foreach ($people as $person) {
            $closestFlags = $flags->sortBy(fn ($flag) =>
            sqrt(pow($person->x - $flag->x, 2) + pow($person->y - $flag->y, 2))
            )->take(2);

            foreach ($closestFlags as $flag) {
                PeopleFlag::create([
                    'person_id' => $person->id,
                    'flag_id' => $flag->id,
                    'distance' => sqrt(pow($person->x - $flag->x, 2) + pow($person->y - $flag->y, 2))
                ]);
            }
        }
    }
}
