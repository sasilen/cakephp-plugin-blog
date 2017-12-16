# Blog plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

## Scratch installation example (with CakePHP)
```
composer self-update && composer create-project --prefer-dist cakephp/app www
cd www 
composer config repositories.blog git https://github.com/sasilen/cakephp-plugin-blog.git
composer config repositories.media git https://github.com/sasilen/CakePHP3-Media.git
composer config minimum-stability dev
composer require sasilen/Blog:dev-master
```
##  Enable plugins
```
cake plugin load -r -b CakeDC/Users
cake plugin load -r -b Thumber
cake plugin load -r Blog
cake plugin load -r Media
cake plugin load Muffin/Tags
```
## Configuration

### [CakeDC/Users](https://github.com/CakeDC/users/blob/master/Docs/Home.md)
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
