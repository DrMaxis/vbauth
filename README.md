Authentication for [vBulletin](http://www.vbulletin.com) users in [Laravel 5](http://laravel.com/). Tested with vBulletin 4.x.
Based on https://github.com/przemekperon/laravel-vbauth/

Not tested too much, it worked here so I'm gonna assume its gonna work for everyone... no seriously I'm just tired and too lazy to test.

Installation
============
 
Add `posttwo/vbauth` as a requirement to composer.json:

```javascript
{
    "require": {
        "pperon/vbauth": "1.*"
    }
}
```

Update your packages with `composer update` or install with `composer install`.

Once Composer has installed or updated your packages you need to register Vbauth with Laravel itself. Open app/config/app.php and find the providers key towards the bottom and add:

```php
'providers' => array(
		...
		...
		'Posttwo\Vbauth\VbauthServiceProvider',
),
```

Configuration
=============

Run `artisan vendor:publish`


Usage
=====

Example usage in a controller:

```php
$vb = new Vbauth;
if($vb->isAdmin()){
	// Show administrator page
	View::make('admin.index');
} elseif ($vb->isLoggedin()) {
	// Show user page
	View::make('user.index');	
} else {
	// Show guest page
	View::make('guest.index');
}
```

###vBulletin User Variables

You may access user information directly by calling $vb->get('fieldname'). Fields are defined in config.php (select_columns).

Example:
```php
if($vb->isLoggedin()) {
    $user_id  = $vb->get('userid');
    $username = $vb->get('username');
    $email    = $vb->get('email');
}

```

###isLoggedIn()

Checks for vBulletin user cookie and returns:

TRUE - user is logged in,
FALSE - there is no vBulletin cookie (user not logged in)


###isAdmin()

Checks whether the user belongs to Admin usergroup. Usually this means the user belongs to usergroup with id = 6 but you can modify this in config.php file by changing admin group ids.

TRUE - user belongs to admin usergroup
FALSE - user doesn't belong to admin usergroup

###is()

Checks whether the user belongs to specific usergroup. Default available groups: `admin, moderator, user, banned, guest`.  You can add more in config.php.

TRUE - user belongs to specific group

Example:
```php
if($vb->is('moderator')) {
    View::make('moderator.panel');
}
```

###logoutUrl()

Returns URL to logout script in vBulletin installation.

Example:
```php
Redirect::to($vb->logoutURL());
```

###getUserInfo()

Returns user data for any choosen forum user

Example:
```php
$user_id = 8;
$user = $vb->getUserInfo($user_id);
echo $user['email']; // displays email for user with user_id = 8
echo $user['username']; // show username
```


Change Log
==========

### 1.0
Release
