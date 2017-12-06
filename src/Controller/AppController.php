<?php

namespace Blog\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{
	public $helpers = ['CakeDC/Users.AuthLink','Media.Media','Thumber.Thumb','Blog.Blog','Paginator' => ['templates' => 'paginator-templates']];
}
