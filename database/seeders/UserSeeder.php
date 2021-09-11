<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Test users
        $participant = User::create([
            'first_name'  => 'Louis',
            'last_name'   => 'Soccard',
            'email'       => 'yp@myqsa.local',
            'password'    => Hash::make('password'),
            'district_id' => 24,
        ]);

        $participant->assignRole('participant');

        $leader = User::create([
            'first_name'  => 'Nick',
            'last_name'   => 'Goldring',
            'email'       => 'leader@myqsa.local',
            'password'    => Hash::make('password'),
            'district_id' => 25,
        ]);

        $leader->assignRole('leader');
        $leader->givePermissionTo('qsa.district.view.25');
        $leader->givePermissionTo('qsa.district.edit.25');

        $admin = User::create([
            'first_name'  => 'Mike',
            'last_name'   => 'Baxter',
            'email'       => 'admin@myqsa.local',
            'password'    => Hash::make('password'),
            'district_id' => 4,
        ]);

        $admin->assignRole('admin');

        User::factory()->count(10)->create();
    }
}
