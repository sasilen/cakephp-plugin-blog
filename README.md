# Blog plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require sasilen/Blog
```
## Scratch installation example 

### CakePHP
```
composer self-update && composer create-project --prefer-dist cakephp/app www
```
Change in to the freshly created directory 'www' and add to composer.json
```
"minimum-stability": "dev"
```
### Blog / Users / other plugins
```
composer require sasilen/Blog
composer require cakedc/users
composer require league/oauth2-google
composer require league/oauth2-facebook
composer require league/oauth1-client
composer require robthree/twofactorauth
composer require google/recaptcha
# composer require friendsofcake/bootstrap-ui
```

## Configuration

### Users
```
bin/cake migrations migrate -p CakeDC/Users
```
config/bootstrap.php
```
Configure::write('Users.config', ['users']);
Plugin::load('CakeDC/Users', ['routes' => true, 'bootstrap' => true]);
Configure::write('Users.Social.login', true); //to enable social login
```
config/users.php
```
return [
    'OAuth.providers.facebook.options.clientId' => 'YOUR APP ID',
    'OAuth.providers.facebook.options.clientSecret' => 'YOUR APP SECRET',
    'OAuth.providers.twitter.options.clientId' => 'YOUR APP ID',
    'OAuth.providers.twitter.options.clientSecret' => 'YOUR APP SECRET',
    //etc
];
```
src/Controller/AppController.php
```
   public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadComponent('CakeDC/Users.UsersAuth');
    }
```


