<?php

namespace Larashim\Settings\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The guarded attributes.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The casted attributes.
     *
     * @var array
     */
    protected $casts = [
        'default' => 'json'
    ];

    /**
     * Create a setting.
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return self
     */
    public static function make(string $name, $params = [])
    {
        if (!is_string($params)) {
            $params = json_encode($params);
        }

        return self::create([
            'name'    => $name,
            'default' => $params,
        ]);
    }

    /**
     * Get a setting value from this setting.
     *
     * @param string $field
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($field = null, $default = null)
    {
        $data = $this->value;

        if ($field) {
            $data = Arr::get($this->value, $field, $default);
        }

        return $data;
    }

    /**
     * Set a setting value on this setting.
     *
     * @param string $field
     * @param mixed  $value
     *
     * @return self
     */
    public function set($field, $value)
    {
        $actual = $this->value;

        Arr::set($actual, $field, $value);

        $this->pivot->value = $actual;
        $this->pivot->save();

        return $this;
    }

    /**
     * Accessor for distant value;
     *
     * @return mixed
     */
    public function getValueAttribute()
    {
        $default = is_array($this->default) ? $this->default : json_decode($this->default, true);
        $current = is_array($this->pivot->value) ? $this->pivot->value : json_decode($this->pivot->value, true);

        return array_merge($default, $current);
    }
}
