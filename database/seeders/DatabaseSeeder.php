<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([DistrictSeeder::class]);

        // Test users
        User::create([
            'first_name'  => 'Louis',
            'last_name'   => 'Soccard',
            'full_name'   => 'Louis Soccard',
            'email'       => 'louis.soccard@hampshirescouts.org.uk',
            'password'    => Hash::make('password'),
            'district_id' => 1,
        ]);

        User::factory()->count(10)->create();
    }
}
