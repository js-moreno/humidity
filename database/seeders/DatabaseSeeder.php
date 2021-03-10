<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $countries = [           
            ['id'=>1,'name' => 'United States'],
        ];
        foreach ($countries as $country) {
            \App\Models\Country::create($country);
        }

        $cities = [           
            ['id'=>1,'name' => 'Miami', 'country_id'=> 1],
            ['id'=>2,'name' => 'Orlando', 'country_id'=> 1],
            ['id'=>3,'name' => 'New York', 'country_id'=> 1],
        ];
        foreach ($cities as $city) {
            \App\Models\City::create($city);
        }

    }
}
