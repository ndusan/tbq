<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('security.login', new Route('/login', array(
    '_controller' => 'UserBundle:Security:login'
)));

$collection->add('security.logout', new Route('/logout', array(
    '_controller' => 'UserBundle:Security:logout'
)));

$collection->add('security.check', new Route('/login_check', array()));

$collection->add('security.accessdenied', new Route('/accessdenied', array(
    '_controller' => 'UserBundle:Security:accessDenied'
)));

$collection->add('user.list', new Route('/admin/user', array(
    '_controller' => 'UserBundle:User:list'
)));

$collection->add('user.add', new Route('/admin/user/add', array(
    '_controller' => 'UserBundle:User:add'
)));

$collection->add('user.edit', new Route('/admin/user/edit/{id}', array(
    '_controller' => 'UserBundle:User:edit'
)));

return $collection;
