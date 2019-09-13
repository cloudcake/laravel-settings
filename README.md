# Settings

**Settings** is a package to assist in associating settings or attributes of JSON form to any of your models using polymorphic relationships.

# Usage

## Publish Migrations
```php
php artisan vendor:publish --provider="Larashim\Settings\Providers\SettingsServiceProvider" \
                           --tag="migrations"
```

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
When attaching settings, any fields not provided will receive the default values.
```php
\App\User::find(1)->attachSetting('preferences', [
  'notifications' => false,
]);
```
The above will set `notifications` to `true` while `backgroundColour` will be inherited from the original setting. If the global setting is changed, the user's setting will return the changed setting.

## Getting Settings

#### Get All Fields
```php
\App\User::first()->setting('preferences');
```

#### Get Specific Field
```php
\App\User::first()->setting('preferences')->get('notifications');
```

## Modifying Settings
```php
\App\User::first()->setting('preferences')->set('notifications', true);
```

