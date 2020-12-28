<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class UpdateAppearancePreferencesForm extends Component {
    public $dark_mode_preference;

    protected $rules = [
        'dark_mode_preference' => [
            'required',
            'in:light,dark,auto',
        ],
    ];

    public function mount() {
        $this->dark_mode_preference = auth()->user()->preferences->dark_mode;
    }

    public function updateAppearancePreferences() {
        $this->validate();

        auth()->user()->preferences->dark_mode = $this->dark_mode_preference;
        auth()->user()->preferences->save();

        $this->emit('saved');
        $this->emit('dark_mode_updated', $this->dark_mode_preference);
    }

    public function render() {
        return view('profile.update-appearance-preferences-form');
    }
}
