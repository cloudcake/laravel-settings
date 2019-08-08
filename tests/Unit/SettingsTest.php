<?php

namespace Larashim\Settings\Tests\Unit;

use Larashim\Settings\Tests\TestCase;
use Larashim\Settings\Models\Setting;
use Larashim\Settings\Tests\Models\Cat;
use Larashim\Settings\Tests\Models\Person;

class SettingsTest extends TestCase
{
    public function testPropertyCanBeCreated()
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
