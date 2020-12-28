<?php

namespace Tests\Feature;

use App\Models\Preferences;
use App\Models\User;
use Tests\TestCase;

class PreferencesTest extends TestCase {

    protected $user;

    protected function setUp(): void {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    protected function tearDown(): void {
        if ($this->user !== null) {
            try {
                $this->user->delete();
            } catch (\Exception $e) {
                fail($e->getMessage());
            }
        }

        parent::tearDown();
    }

    public function testPreferencesModelIsCreatedForUserUponCreation() {
        $this->assertInstanceOf(Preferences::class, $this->user->preferences, "The user's preferences are not created");
    }

    public function testDefaultDarkModePreferenceIsAuto() {
        $this->assertTrue($this->user->preferences->dark_mode === 'auto', "The default is not set to auto");
    }

    public function testPreferencesGetRemovedUponUserDeletion() {
        $id = $this->user->id;
        try {
            $this->user->delete();
        } catch (\Exception $e) {
            fail($e->getMessage());
        }

        $this->assertDatabaseMissing('preferences', ['user_id' => $id]);
    }
}
