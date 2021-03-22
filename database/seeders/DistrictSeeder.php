<?php

namespace Database\Seeders;

use App\Models\Cluster;
use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $north      = Cluster::create(['name' => 'North', 'abbreviation' => 'N'])->id;
        $central    = Cluster::create(['name' => 'Central', 'abbreviation' => 'C'])->id;
        $south_east = Cluster::create(['name' => 'South East', 'abbreviation' => 'SE'])->id;
        $west       = Cluster::create(['name' => 'West', 'abbreviation' => 'W'])->id;

        District::create(['name' => 'Andover', 'cluster_id' => $west]);
        District::create(['name' => 'Basingstoke East', 'cluster_id' => $north]);
        District::create(['name' => 'Basingstoke West', 'cluster_id' => $north]);
        District::create(['name' => 'Blackwater Valley', 'cluster_id' => $north]);
        District::create(['name' => 'Bramshill', 'cluster_id' => $north]);
        District::create(['name' => 'Chandlers Ford', 'cluster_id' => $central]);
        District::create(['name' => 'City of Portsmouth', 'cluster_id' => $south_east]);
        District::create(['name' => 'Eastleigh', 'cluster_id' => $central]);
        District::create(['name' => 'Fareham East', 'cluster_id' => $south_east]);
        District::create(['name' => 'Fareham West', 'cluster_id' => $south_east]);
        District::create(['name' => 'Gosport', 'cluster_id' => $south_east]);
        District::create(['name' => 'Havant', 'cluster_id' => $south_east]);
        District::create(['name' => 'Itchen North', 'cluster_id' => $central]);
        District::create(['name' => 'Itchen South', 'cluster_id' => $central]);
        District::create(['name' => 'Meon Valley', 'cluster_id' => $south_east]);
        District::create(['name' => 'New Forest East', 'cluster_id' => $west]);
        District::create(['name' => 'New Forest North', 'cluster_id' => $west]);
        District::create(['name' => 'New Forest South', 'cluster_id' => $west]);
        District::create(['name' => 'New Forest West', 'cluster_id' => $west]);
        District::create(['name' => 'Odiham', 'cluster_id' => $north]);
        District::create(['name' => 'Petersfield', 'cluster_id' => $south_east]);
        District::create(['name' => 'Romsey', 'cluster_id' => $west]);
        District::create(['name' => 'Rotherfield', 'cluster_id' => $north]);
        District::create(['name' => 'Silchester', 'cluster_id' => $north]);
        District::create(['name' => 'Southampton City', 'cluster_id' => $central]);
        District::create(['name' => 'Waterlooville', 'cluster_id' => $south_east]);
        District::create(['name' => 'Winchester', 'cluster_id' => $central]);
    }
}
