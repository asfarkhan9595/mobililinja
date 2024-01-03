<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $jsonUrl = 'https://gist.githubusercontent.com/almost/7748738/raw/575f851d945e2a9e6859fb2308e95a3697bea115/countries.json';

        // Fetch JSON data using file_get_contents
        $jsonContents = file_get_contents($jsonUrl);
//        dd($jsonContents);

        // Decode JSON data to an associative array
        $countries = json_decode($jsonContents, true);
        // Seeder logic
        foreach ($countries as $country) {
            Country::updateOrCreate(['name' => $country],['name'=>$country['name'],'code'=>$country['code']]);
        }

    }
}
