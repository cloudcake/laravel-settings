<?php

namespace Settings\Tests\Unit;

use Settings\Tests\TestCase;
use Settings\Models\Setting;
use Settings\Tests\Models\Cat;
use Settings\Tests\Models\Person;

class SettingsTest extends TestCase
{
    public function testSettings()
    {
        Setting::make('PREFERENCES', [
            'backgroundColour'  => '#ffffff',
            'notificationSound' => 'droplet.mp3'
        ]);

        Setting::make('FOODS', [
            'poorfoods' => true,
            'richfoods' => false
        ]);

        $person = Cat::first();
        $person->attachSetting('FOODS');

        dd($person->setting('FOODS')->get());
    }
}
