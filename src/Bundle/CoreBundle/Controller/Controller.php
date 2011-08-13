<?php
namespace Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BController;

class Controller extends BController
{
    
    public function getParameter($name)
    {
        return $this->container->getParameter($name);
    }
}