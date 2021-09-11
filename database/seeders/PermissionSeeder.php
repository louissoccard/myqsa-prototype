<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\TitledPermission;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Award
        TitledPermission::create([
            'name'        => 'qsa.has', 'title' => 'QSA Participant',
            'description' => 'Determines whether an account is a QSA participant. An account must have this permission to have an assigned award and to be able to access the Award pages.',
        ]);

        // Admin centre access
        TitledPermission::create([
            'name'        => 'admin_centre.access', 'title' => 'Access Admin Centre',
            'description' => 'Determines whether an account has access to the admin centre. This permission should only be granted to necessary users. An account with this permission can access the personal information of everyone registered on myQSA.',
        ]);

        // District access permissions
        foreach (District::all() as $district) {
            TitledPermission::create([
                'name'        => "qsa.district.view.{$district->id}",
                'title'       => "View {$district->name} District",
                'description' => "Allows access to view the awards of participants in {$district->name} district. They can only view the award information and the participant's full name and district. No other personal information is accessible.",
            ]);
            TitledPermission::create([
                'name'        => "qsa.district.edit.{$district->id}",
                'title'       => "Edit {$district->name} District",
                'description' => "Allows access to edit the awards of participants in {$district->name} district. They can only edit the award information. No other personal information is accessible or editable.",
            ]);
        }

        TitledPermission::create([
            'name'        => 'qsa.district.view.*', 'title' => 'View All Districts',
            'description' => "Allows access to view the awards of participants in all districts. They can only view the award information and the participant's full name and district. No other personal information is accessible.",
        ]);
        TitledPermission::create([
            'name'        => 'qsa.district.edit.*', 'title' => 'Edit All Districts',
            'description' => "Allows access to view the awards of participants in all districts. They can only view the award information and the participant's full name and district. No other personal information is accessible.",
        ]);
    }
}
