<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ExhibitsTableSeeder extends Seeder
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

        //BFA
        DB::table('exhibits')->insert([
            'type' => 'BFA',
            'title' => 'Bachelors of Fine Arts Exhibition: Mirrorless',
            'description' => 'This exhibition features presentations by SVSU Art Department students and Art Registered Student Organizations (RSOs). Each group featured in the exhibition chose a section of the gallery to make their own independent show. Students were responsible for the planning and installation of the show, displaying their creative works in their own unique way.',
            'featured_image_url' => '\storage\test\bfa.jpg',
            'start_date_time' => "2019-05-01T16:00:00",
            'end_date_time' =>  "2019-06-01T16:00:00",
            'registration_start_date_time' => "2019-04-01T16:00:00",
            'registration_end_date_time' => "2020-05-01T23:59:59",
            'reception_start_date_time' =>  "2019-01-06T16:00:00",
            'reception_end_date_time' => "2019-01-06T18:00:00",
            'default_accept_message' => "Congratulations, you have been invited to the Experimental Space exhibit...",
            'default_reject_message' => "Good work, but due to the high volume of applications, we are unable to accept your application. Better luck next time!",
            'published' => true,
            'created_at' => Carbon::now()
        ]);

        //14th Annual student show
        DB::table('exhibits')->insert([
            'type' => 'ANNUAL_STUDENT_SHOW',
            'title' => '14th Annual Student Show',
            'description' => 'This exhibition features work from current SVSU Art Department students, majors and minors. A variety of mediums will be showcased including but not limited to photography, painting, drawing, sculpture, ceramics, printmaking, graphic design and more.',
            'featured_image_url' => '\storage\test\14thAnnualStudentShowBanner.png',
            'start_date_time' => "2019-03-01T16:00",
            'end_date_time' =>  "2019-04-01T16:00",
            'registration_start_date_time' => "2019-02-01T16:00",
            'registration_end_date_time' => "2020-02-25T23:59",
            'reception_start_date_time' =>  "2019-03-19T16:00",
            'reception_end_date_time' => "2019-03-19T16:00",
            'published' => true,
            'default_accept_message' => "Congratulations, you have been invited to the Annual Student Show exhibit...",
            'default_reject_message' => "Good work, but due to the high volume of applications, we are unable to accept your application. Better luck next time!",
            'created_at' => Carbon::now()
        ]);

        //Experimental Space Exhibition Plan
        DB::table('exhibits')->insert([
            'type' => 'EXPERIMENTAL_SPACE_PLAN',
            'title' => 'Experimental Space Proposal 2018',
            'description' => 'This is a form to allow students and RSOs to submit their proposals for the experimental space show. ',
            'featured_image_url' => '\storage\test\experimentalspace2018.png',
            'start_date_time' => "2019-04-01T16:00",
            'end_date_time' =>  "2019-05-01T16:00:00",
            'registration_start_date_time' => "2019-03-01T16:00",
            'registration_end_date_time' => "2020-03-17T23:59",
            'reception_start_date_time' =>  "2019-04-06T16:00",
            'reception_end_date_time' => "2019-04-06T16:00",
            'published' => true,
            'default_accept_message' => "Congratulations, you have been invited to the Experimental Space exhibit...",
            'default_reject_message' => "Good work, but due to the high volume of applications, we are unable to accept your application. Better luck next time!",
            'created_at' => Carbon::now()
        ]);

        //Experimental Space Exhibition
        DB::table('exhibits')->insert([
            'type' => 'EXPERIMENTAL_SPACE',
            'title' => 'Experimental Space 2018',
            'description' => 'This exhibition features presentations by SVSU Art Department students and Art Registered Student Organizations (RSOs). Each group featured in the exhibition chose a section of the gallery to make their own independent show. Students were responsible for the planning and installation of the show, displaying their creative works in their own unique way.',
            'featured_image_url' => '\storage\test\experimentalspace2018.png',
            'start_date_time' => "2019-04-01T16:00",
            'end_date_time' =>  "2019-05-01T16:00:00",
            'registration_start_date_time' => "2019-03-01T16:00",
            'registration_end_date_time' => "2020-03-17T23:59",
            'reception_start_date_time' =>  "2019-04-06T16:00",
            'reception_end_date_time' => "2019-04-06T16:00",
            'published' => true,
            'default_accept_message' => "Congratulations, you have been invited to the Annual Student Show exhibit...",
            'default_reject_message' => "Good work, but due to the high volume of applications, we are unable to accept your application. Better luck next time!",
            'created_at' => Carbon::now()
        ]);
    }
}
