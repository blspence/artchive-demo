<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SubmissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    function run()
    {
        $faker = Faker\Factory::create();
        $datetime = DatabaseSeeder::getDateTime();

        DB::table('submissions')->insert([
            'user_id' => 1,
            'exhibit_id' => 2,
            'comments'=> "Here are my black and white photographs.",
            'status' => true,
            'admin_comments' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'notified' => false,
            'created_at' => $datetime,
            'submitable_id' => 1,
            'submitable_type' => 'App\ExperimentalSubmission'
        ]);

        // Annual Student Show Submission
        DB::table('experimental_submissions')->insert([
            'rso' => true,
            'rso_name' => 'Art Enthusiasts',
            'rso_num_participants' => '2',
            'faculty_adviser' => 'Professor McGonagall',
            'walls' => 2,
            'pedestals' => 1,
            'brick_ok' => true,
            'additional_resources' => "My project may require and outlet as well as a monitor to display the photographs."
        ]);

        // Annual Student Show Submission
        DB::table('submissions')->insert([
            'user_id' => 1,
            'exhibit_id' => 1,
            'comments'=> "Here is my awsome Annual Student Show submission",
            'status' => true,
            'admin_comments' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'notified' => false,
            'created_at' => $datetime,
            'submitable_id' => null,
            'submitable_type' => null
        ]);

        // for($i = 4; $i <= 12; $i++)
        // {
        //     DB::table('submissions')->insert([
        //         'user_id' => 3,
        //         'exhibit_id' => 1,
        //         'comments'=> "Here is my awsome Annual Student Show submission",
        //         'status' => true,
        //         'admin_comments' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        //         'notified' => false,
        //         'created_at' => $datetime,
        //         'submitable_id' => null,
        //         'submitable_type' => null
        //     ]);
        // }

    }
}
