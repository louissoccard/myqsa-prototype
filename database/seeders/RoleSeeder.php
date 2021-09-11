<?php

namespace Database\Seeders;

use App\Models\TitledRole;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Participant role
        $participant = TitledRole::create([
            'name'        => 'participant', 'title' => 'Participant',
            'description' => 'Grants the necessary permissions required by a QSA participant.',
        ]);

        $participant->givePermissionTo('qsa.has');

        // Leader role
        $leader = TitledRole::create([
            'name'        => 'leader', 'title' => 'Leader',
            'description' => 'Grants the necessary permissions required by a leader. District access needs to be assigned manually.'
        ]);

        // Admin role
        $admin = TitledRole::create([
            'name'        => 'admin', 'title' => 'Admin',
            'description' => 'Grants the necessary permissions required by an admin. This will grant an account with full access to the data stored in myQSA. Only assign this role to necessary members.',
        ]);

        $admin->givePermissionTo('admin_centre.access');
        $admin->givePermissionTo('qsa.district.view.*');
        $admin->givePermissionTo('qsa.district.edit.*');
    }
}
