<?php

namespace Settings\Models;

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
    public static function make(string $name, $params = [], $relates_to = null)
    {
        if (!is_string($params)) {
            $params = json_encode($params);
        }

        return self::create([
            'name'       => $name,
            'relates_to' => $relates_to,
            'default'    => $params,
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
     * Remove empty fields.
     *
     * @param array $array
     *
     * @return array
     */
    private function removeEmpty(array $array)
    {
        array_walk_recursive($array, function (&$value, $key) use (&$array) {
            if (empty($value)) {
                unset($array[$key]);
            }
        });

        return $array;
    }

    /**
     * Accessor for distant value;
     *
     * @return mixed
     */
    public function getValueAttribute()
    {
        $default = is_array($this->default) ? $this->default : json_decode($this->default, true);
        $current = $this->removeEmpty(is_array($this->pivot->value) ? $this->pivot->value : json_decode($this->pivot->value, true));

        return array_merge($default, $current);
    }
}
