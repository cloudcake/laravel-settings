<?php

namespace Settings\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Settingable extends MorphPivot
{
    /**
     * The casted attributes.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'json',
    ];
}
