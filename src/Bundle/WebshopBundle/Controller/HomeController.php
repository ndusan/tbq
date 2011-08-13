<?php

namespace Bundle\WebshopBundle\Controller;

use Bundle\CoreBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HomeController extends Controller
{
    public function indexAction()
    {
        
        return $this->render('WebshopBundle:Home:index.html.php', array());
    }
    
}
