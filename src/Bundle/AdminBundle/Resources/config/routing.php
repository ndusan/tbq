<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('admin.home', new Route('/admin/home', array(
    '_controller' => 'AdminBundle:Home:index',
)));

return $collection;
