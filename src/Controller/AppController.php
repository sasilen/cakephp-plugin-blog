<?php

namespace Blog\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{
  public $helpers = [
    'Thumber.Thumb',
    'Media.Media',
  ];
}
