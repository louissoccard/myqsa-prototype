<?php

namespace Tests\Feature;

use App\Models\Cluster;
use App\Models\District;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DistrictTest extends TestCase
{
    public function testUserCannotBeCreatedWithoutDistrict()
    {
        $this->expectException(QueryException::class);

        $user           = new User();
        $user->name     = "Test";
        $user->email    = "test@example.com";
        $user->password = Hash::make('test');
        $user->save();

        $user->delete();
    }

    public function testDistrictCannotBeCreatedWithoutCluster()
    {
        $this->expectException(QueryException::class);

        $district       = new District();
        $district->name = "Test District";
        $district->save();

        $district->delete();
    }

    public function testDistrictCannotBeCreatedWithoutExistingCluster()
    {
        $this->expectException(QueryException::class);

        $district             = new District();
        $district->name       = "Test District";
        $district->cluster_id = 10000000;
        $district->save();

        $district->delete();
    }

    public function testDistrictCanBeAccessedFromUser()
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

        $this->assertEquals("Test District", $user->district->name,
            "Failed asserting that the user's district is equal to the one created during the test.");

        $user->delete();
        $district->delete();
        $cluster->delete();
    }

    public function testDistrictCannotBeDeletedIfThereIsAUserAssignedToIt()
    {
        $this->expectException(QueryException::class);

        $district          = new District();
        $district->name    = "Test District";
        $district->cluster = "N";
        $district->save();

        $user              = User::factory()->create();
        $user->district_id = $district->id;
        $user->save();

        $district->delete();

        $user->delete();
        $district->delete();
    }
}
