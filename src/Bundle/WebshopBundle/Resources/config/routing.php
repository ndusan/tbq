<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('webshop.home', new Route('/', array(
    '_controller' => 'WebshopBundle:Home:index',
)));

return $collection;
