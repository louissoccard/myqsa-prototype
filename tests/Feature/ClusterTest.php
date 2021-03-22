<?php

namespace Tests\Feature;

use App\Models\Cluster;
use App\Models\District;
use App\Models\User;
use Illuminate\Database\QueryException;
use Tests\TestCase;

class ClusterTest extends TestCase
{
    public function testClusterCanBeAccessedFromUser()
    {
        $cluster               = new Cluster();
        $cluster->name         = "Test Cluster";
        $cluster->abbreviation = "TEST";
        $cluster->save();

        $district             = new District();
        $district->name       = "Test District";
        $district->cluster_id = $cluster->id;
        $district->save();

        $user              = User::factory()->create();
        $user->district_id = $district->id;
        $user->save();

        $this->assertEquals("Test Cluster", $user->district->cluster->name,
            "Failed asserting that the user's district is equal to the one created during the test.");

        $user->delete();
        $district->delete();
        $cluster->delete();
    }

    public function testClusterCanBeAccessedFromDistrict()
    {
        $cluster               = new Cluster();
        $cluster->name         = "Test Cluster";
        $cluster->abbreviation = "TEST";
        $cluster->save();

        $district             = new District();
        $district->name       = "Test District";
        $district->cluster_id = $cluster->id;
        $district->save();

        $this->assertEquals("Test Cluster", $district->cluster->name,
            "Failed asserting that the user's district is equal to the one created during the test.");

        $district->delete();
        $cluster->delete();
    }

    public function testClusterCannotBeDeletedIfThereIsADistrictAssignedToIt()
    {
        $this->expectException(QueryException::class);

        $cluster               = new Cluster;
        $cluster->name         = "Test Cluster";
        $cluster->abbreviation = "TEST";

        $district          = new District();
        $district->name    = "Test District";
        $district->cluster = "N";
        $district->save();

        $cluster->delete();

        $district->delete();
        $cluster->delete();
    }
}
