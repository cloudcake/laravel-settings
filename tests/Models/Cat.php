<?php

namespace Settings\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Settings\Traits\HasSettings;

class Cat extends Model
{
    use HasSettings;

    protected $fillable = [
        'name',
    ];
}
