# Blog plugin for CakePHP 4

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

## Scratch installation example (with CakePHP)
```
composer config repositories.blog git https://github.com/sasilen/cakephp-plugin-blog.git
composer require sasilen/blog

```
##  Enable plugins
```
./bin/cake plugin load Sasilen/Blog
```
## Add templates (main app)
```
# /src/View/AppView.php
public function initialize(): void
{
    parent::initialize();
    $this->loadHelper('CakeDC/Users.AuthLink');
    $this->loadHelper('Paginator', ['templates' => 'templates-paginator']);
    $this->loadHelper('Form', ['templates' => 'templates-form']);
}
```
