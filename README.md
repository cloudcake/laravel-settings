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

Setting::make('preferences', [
  'notifications'    => true,
  'backgroundColour' => '#ffffff'
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

```php

\App\User::find(1)->attachSetting('preferences', [
  'notifications' => false,
]);
```
