<?php

namespace Bundle\CoreBundle\EventListener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\Templating\Asset\AssetPackage;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CoreListener
{

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        
        $request = $event->getRequest();

        $this->initControllerActionNaming($request);
    }
    

    protected function initControllerActionNaming($request)
    {
        $controllerActionParts = explode('::', $request->attributes->get('_controller'));
        if (count($controllerActionParts) != 2) {
            return;
        }

        $controllerParts = explode('\\', $controllerActionParts[0]);
        $controllerName = strtolower(str_replace('Controller', '', array_pop($controllerParts)));

        $actionName = strtolower(str_replace('Action', '', $controllerActionParts[1]));

        $request->attributes->set('controllerName', $controllerName);
        $request->attributes->set('actionName', $actionName);
    }

}
