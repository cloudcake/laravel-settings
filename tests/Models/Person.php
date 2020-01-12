<?php

namespace Settings\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Settings\Traits\HasSettings;

class Person extends Model
{
    use HasSettings;

    protected $fillable = [
        'name',
    ];
}
