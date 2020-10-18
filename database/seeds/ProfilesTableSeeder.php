<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @todo - add seeder data for major, minor, rso & social media links
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $datetime = DatabaseSeeder::getDateTime();

        for($i = 1; $i <= DatabaseSeeder::NUM_PROFILES; $i++)
        {
            DB::table('profiles')->insert([
                'biography' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'profile_photo_url' => Storage::url('images/default_profile_photo.png'),
                'major' => 'Art Major',
                'rso' => 'Art RSO',
                'instagram_url' => 'https://www.instagram.com/',
                'linkedin_url' => 'https://www.linkedin.com',
                'facebook_url' => 'https://www.facebook.com/',
                'created_at' => $datetime
            ]);
        }
    }
}
