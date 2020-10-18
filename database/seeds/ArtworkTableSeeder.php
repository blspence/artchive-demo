<?php

use Illuminate\Database\Seeder;

class ArtworkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $datetime = DatabaseSeeder::getDateTime();

        // for($i = 1; $i <= (DatabaseSeeder::NUM_ARTWORK / 2); $i++)
        // {
        DB::table('artworks')->insert([
            'user_id' => 1,
            'submission_id' => 1,
            'title' => 'Katherine',
            'medium' => 'B+W 4x5 Film',
            'description' => 'A black and white photo to be submitted to the 14th Annual student show.',
            'submission_photo_url' => '\storage\test\bw_photo1.PNG',
            'public_photo_url' => '\storage\test\bw_photo1.PNG',
            'created_at' => $datetime
        ]);

        DB::table('artworks')->insert([
            'user_id' => 1,
            'submission_id'=> 1,
            'title' => 'Patricia',
            'medium' => 'B+W 4x5 Film',
            'description' =>  'A black and white photo to be submitted to the 14th Annual student show.',
            'submission_photo_url' => '\storage\test\bw_photo2.PNG',
            'public_photo_url' => '\storage\test\bw_photo2.PNG',
            'created_at' => $datetime
        ]);

        DB::table('artworks')->insert([
            'user_id' => 1,
            'submission_id'=> 2,
            'title' => 'Patricia2',
            'medium' => 'B+W 4x5 Film2',
            'description' =>  'A second black and white photo to be submitted to the 14th Annual student show.',
            'submission_photo_url' => '\storage\test\bw_photo2.PNG',
            'public_photo_url' => '\storage\test\bw_photo2.PNG',
            'created_at' => $datetime
        ]);

        DB::table('artworks')->insert([
            'user_id' => 2,
            'submission_id'=> 2,
            'title' => 'Requium',
            'medium' => 'Charcoal',
            'description' =>  'A second black and white photo.',
            'submission_photo_url' => '\storage\test\bw_photo2.PNG',
            'public_photo_url' => '\storage\test\bw_photo2.PNG',
            'created_at' => $datetime
        ]);

        DB::table('artworks')->insert([
            'user_id' => 2,
            'submission_id'=> 2,
            'title' => 'Dream',
            'medium' => 'Charcoal',
            'description' =>  'A second black and white photo.',
            'submission_photo_url' => '\storage\test\bw_photo2.PNG',
            'public_photo_url' => '\storage\test\bw_photo2.PNG',
            'created_at' => $datetime
        ]);

        // }
        // add extra images to the admin so that the profile has more artwork images
        //to show in the demo
        // for($i = 1; $i <= (DatabaseSeeder::NUM_ARTWORK / 2); $i++)
        // {
        //     DB::table('artworks')->insert([
        //         'user_id' => 4,
        //         'title' => $faker->word,
        //         'medium' => $faker->word,
        //         'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        //         'submission_photo_url' => $faker->imageUrl($width = 640, $height = 480),
        //         'public_photo_url' => $faker->imageUrl($width = 640, $height = 480),
        //         'created_at' => $datetime
        //     ]);
        // }

    }
}
