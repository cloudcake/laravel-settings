<?php

namespace Larashim\Settings\Tests\Unit;

use Larashim\Settings\Tests\TestCase;
use Larashim\Settings\Models\Setting;
use Larashim\Settings\Tests\Models\Person;

class SettingsTest extends TestCase
{
    public function testPropertyCanBeCreated()
    {
        Setting::make('PREFERENCES', [
            'backgroundColour'  => '#ffffff',
            'notificationSound' => 'droplet.mp3'
        ]);

        $person = Person::first();
        $person->attachSetting('PREFERENCES');

        $person->setting('PREFERENCES')->set('backgroundColour', '#555555');

        dd($person->setting('PREFERENCES')->get());
    }
}
