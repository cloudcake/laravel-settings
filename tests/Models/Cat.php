<?php

namespace Larashim\Settings\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Larashim\Settings\Traits\HasSettings;

class Cat extends Model
{
    use HasSettings;

    protected $fillable = [
        'name',
    ];
}
