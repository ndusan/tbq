<?php
namespace Bundle\AdminBundle\Controller;

use Bundle\CoreBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        
        return $this->render('AdminBundle:Home:index.html.php', array());
    }
}
