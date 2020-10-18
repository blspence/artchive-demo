<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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

        // for($i = 1; $i <= (DatabaseSeeder::NUM_USERS - 3); $i++)
        // {
        //     DB::table('users')->insert([
        //         'profile_id' => $i,
        //         'first_name' => $faker->firstNameMale,
        //         'last_name' => $faker->lastName,
        //         'username' => $faker->regexify('^[a-z]{8}$'),
        //         'phone_number' => $faker->regexify('^[0-9]{3}-[0-9]{3}-[0-9]{4}'),
        //         'password' => $faker->password,
        //         'role' => 'USER',
        //         'created_at' => $datetime
        //     ]);
        // }

        DB::table('users')->insert([
            'profile_id' => 1,
            'first_name' => 'Harry',
            'last_name' => 'Potter',
            'username' => 'hpotts',
            'phone_number' => '111-222-3333',
            'password' => Hash::make('asdfasdf'),
            'role' => 'USER',
            'created_at' => $datetime
        ]);

        DB::table('users')->insert([
            'profile_id' => 2,
            'first_name' => 'Herminone',
            'last_name' => 'Granger',
            'username' => 'hgrange',
            'phone_number' => '111-222-3333',
            'password' => Hash::make('asdfasdf'),
            'role' => 'USER',
            'created_at' => $datetime
        ]);


        // Create a default User for testing
        DB::table('users')->insert([
            'profile_id' => (DatabaseSeeder::NUM_USERS - 2),
            'first_name' => 'Regular',
            'last_name' => 'User',
            'username' => 'user',
            'phone_number' => '555-555-5555',
            'password' => Hash::make('asdfasdf'),
            'role' => 'USER',
            'created_at' => $datetime
        ]);

        // Create a default Admin for testing
        DB::table('users')->insert([
            'profile_id' => (DatabaseSeeder::NUM_USERS - 1),
            'first_name' => 'Admin',
            'last_name' => 'User',
            'username' => 'admin',
            'phone_number' => '555-555-5555',
            'password' => Hash::make('asdfasdf'),
            'role' => 'ADMIN',
            'created_at' => $datetime
        ]);

        // Create a default Archivist for testing
        DB::table('users')->insert([
            'profile_id' => (DatabaseSeeder::NUM_USERS + 0),
            'first_name' => 'Archivist',
            'last_name' => 'User',
            'username' => 'archivist',
            'phone_number' => '555-555-5555',
            'password' => Hash::make('asdfasdf'),
            'role' => 'ARCHIVIST',
            'created_at' => $datetime
        ]);
    }

}
