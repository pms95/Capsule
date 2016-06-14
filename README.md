# CapsuleCRM PHP SDK

This package is an active record style PHP SDK developed to lessen the burden on developers while interfacing with the official CapsuleCRM API. Use of the package is similar to that of Laravel's Eloquent in which models are instantiated,data is assigned to their attributes and then the record is saved. Such as below:

```php
$user = new User;
$user->username = 'momodou';
$user->save();
```
