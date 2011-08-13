<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->addCollection($loader->import("@WebProfilerBundle/Resources/config/routing/wdt.xml"), '/_wdt');
$collection->addCollection($loader->import("@WebProfilerBundle/Resources/config/routing/profiler.xml"), '/_profiler');

$collection->addCollection($loader->import("@CoreBundle/Resources/config/routing.php"));
$collection->addCollection($loader->import("@ConfigBundle/Resources/config/routing.php"));
$collection->addCollection($loader->import("@UserBundle/Resources/config/routing.php"));
$collection->addCollection($loader->import("@WebshopBundle/Resources/config/routing.php"));
$collection->addCollection($loader->import("@AdminBundle/Resources/config/routing.php"));

return $collection;