<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Define constants for the number of objects
     * to seed for each table in the database.
     */
    const NUM_USERS = 5;
    const NUM_PROFILES = DatabaseSeeder::NUM_USERS;
    const NUM_ARTWORK = 30; // ensure this is an even number
    const NUM_EXHBITS = 15;
    const NUM_SUBMISSIONS = 20; // ensure this is an even number

    /**
     * Get datetime attribute for 'created_at' attribute in all tables.
     */
    public static function getDateTime()
    {
        return Carbon::now()->toDateTimeString();
    }

    /**
     * Seed the application's database;
     * ordered by foreign key constraints.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProfilesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ExhibitsTableSeeder::class);
        $this->call(SubmissionsTableSeeder::class);
        $this->call(ArtworkTableSeeder::class);
    }
}
