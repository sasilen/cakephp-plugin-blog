<?php
declare(strict_types=1);

namespace Sasilen\Blog\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{
	public $helpers = ['CakeDC/Users.AuthLink','Thumber.Thumb','Blog.Blog','Paginator' => ['templates' => 'paginator-templates']];
}
