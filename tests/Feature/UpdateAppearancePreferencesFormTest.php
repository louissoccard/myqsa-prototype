<?php

namespace Tests\Feature;

use App\Http\Livewire\Profile\UpdateAppearancePreferencesForm;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateAppearancePreferencesFormTest extends TestCase {

    protected $user;

    protected function setUp(): void {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    protected function tearDown(): void {
        try {
            $this->user->delete();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        parent::tearDown();
    }

    public function testRetrieveUserInitialPreferenceOfLight() {
        $this->user->preferences->update(['dark_mode' => 'light']);
        Livewire::test(UpdateAppearancePreferencesForm::class)->assertSet('dark_mode_preference', 'light')->assertHasNoErrors('dark_mode_preference');
    }

    public function testRetrieveUserInitialPreferenceOfDark() {
        $this->user->preferences->update(['dark_mode' => 'dark']);
        Livewire::test(UpdateAppearancePreferencesForm::class)->assertSet('dark_mode_preference', 'dark')->assertHasNoErrors('dark_mode_preference');
    }

    public function testRetrieveUserInitialPreferenceOfAuto() {
        $this->user->preferences->update(['dark_mode' => 'auto']);
        Livewire::test(UpdateAppearancePreferencesForm::class)->assertSet('dark_mode_preference', 'auto')->assertHasNoErrors('dark_mode_preference');
    }

    public function testSetUsersPreferenceToLight() {
        $this->user->preferences->update(['dark_mode' => 'auto']);
        Livewire::test(UpdateAppearancePreferencesForm::class)->set('dark_mode_preference', 'light')->call('updateAppearancePreferences')->assertEmitted('saved')->assertHasNoErrors('dark_mode_preference');
        $this->assertTrue($this->user->preferences->dark_mode == 'light');
    }

    public function testSetUsersPreferenceToDark() {
        $this->user->preferences->update(['dark_mode' => 'auto']);
        Livewire::test(UpdateAppearancePreferencesForm::class)->set('dark_mode_preference', 'dark')->call('updateAppearancePreferences')->assertEmitted('saved')->assertHasNoErrors('dark_mode_preference');
        $this->assertTrue($this->user->preferences->dark_mode == 'dark');
    }

    public function testSetUsersPreferenceToAuto() {
        $this->user->preferences->update(['dark_mode' => 'light']);
        Livewire::test(UpdateAppearancePreferencesForm::class)->set('dark_mode_preference', 'auto')->call('updateAppearancePreferences')->assertEmitted('saved')->assertHasNoErrors('dark_mode_preference');
        $this->assertTrue($this->user->preferences->dark_mode == 'auto');
    }

    public function testMaintainsCurrentPreferenceIfNotAltered() {
        $this->user->preferences->update(['dark_mode' => 'auto']);
        Livewire::test(UpdateAppearancePreferencesForm::class)->call('updateAppearancePreferences')->assertEmitted('saved')->assertHasNoErrors('dark_mode_preference');
        $this->assertTrue($this->user->preferences->dark_mode == 'auto');
    }

    public function testErrorDispatchedWhenInvalidParameterProvided() {
        Livewire::test(UpdateAppearancePreferencesForm::class)->set('dark_mode_preference', 'invalid')->call('updateAppearancePreferences')->assertHasErrors('dark_mode_preference');
    }

    public function testErrorNotDisplayedToUser() {
        Livewire::test(UpdateAppearancePreferencesForm::class)->set('dark_mode_preference', 'auto')->call('updateAppearancePreferences')->assertDontSee('Something has gone wrong. Please try again later.');
    }

    public function testErrorDisplayedToUserWhenDispatched() {
        Livewire::test(UpdateAppearancePreferencesForm::class)->set('dark_mode_preference', 'invalid')->call('updateAppearancePreferences')->assertSee('Something has gone wrong. Please try again later.');
    }
}
