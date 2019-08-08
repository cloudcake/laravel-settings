<?php

namespace Larashim\Settings\Traits;

use Larashim\Settings\Models\Setting;
use Larashim\Settings\Models\Settingable;

trait HasSettings
{
    /**
     * Return settings on the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function settings()
    {
        return $this->morphToMany(Setting::class, 'settingable')
                    ->whereNull('relates_to')
                    ->orWhere('relates_to', get_called_class())
                    ->using(Settingable::class)
                    ->withPivot('value');
    }

    /**
     * A simplified alias for attaching a setting with a custom value.
     *
     * @param mixed $setting
     * @param mixed $value
     *
     * @return \Larashim\Settings\Models\Setting
     */
    public function attachSetting($setting, $value = [])
    {
        if (!($setting instanceof Setting)) {
            if (is_string($setting)) {
                $setting = Setting::where('name', $setting)->first();
            } else {
                $setting = Setting::find($setting);
            }
        }

        if (!$setting) {
            throw new \Exception('Setting not found');
        }

        $this->settings()->attach($setting->id, ['value' => $value]);

        return $this;
    }

    /**
     * A simplified alias for detaching a setting.
     *
     * @param mixed $setting
     *
     * @return bool
     */
    public function detachSetting($setting)
    {
        if (!($setting instanceof Setting)) {
            if (is_string($setting)) {
                $setting = Setting::where('name', $setting)->first();
            } else {
                $setting = Setting::find($setting);
            }
        }

        if ($setting) {
            return $this->settings()->detach($setting->id);
        }

        return false;
    }

    /**
     * Returns the first association of the provided setting name with
     * casted values.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function setting($name)
    {
        return $this->settings()->where('name', $name)->first();
    }
}
