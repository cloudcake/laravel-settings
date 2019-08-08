# Settings

**Settings** is a package to assist in associating settings or attributes of JSON form to any of your models using polymorphic relationships.

# Usage

## Setup models with settings

Add the `\Larashim\Settings\Traits\HasSettings` trait to any model that should have settings.

```php
use Larashim\Settings\Traits\HasSettings;

class User extends Model
{
    use HasSettings;
}
```

## Creating Settings

#### Global Settings

```php
use Larashim\Settings\Models\Setting;

Setting::make('config', [
  'rateLimit' => true,
  'ipLocks'   => [
    '127.0.0.1',
    '10.0.0.1'
  ]
]);
```

#### Model Specific Settings

```php
use Larashim\Settings\Models\Setting;

Setting::make('preferences', [
  'notifications'    => true,
  'backgroundColour' => '#ffffff'
], \App\User::class);
```

## Attaching Settings
When attaching settings, any fields not associated to the model will receive the default values associated to the global setting.
```php
\App\User::find(1)->attachSetting('preferences', [
  'notifications' => false,
]);
```
The above will set `notifications` to `true` while `backgroundColour` will be inherited from the original setting. If the global setting is changed, the user's setting will return the changed setting.
