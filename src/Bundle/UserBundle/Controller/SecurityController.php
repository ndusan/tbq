<?php

namespace Bundle\UserBundle\Controller;

use Bundle\CoreBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;


class SecurityController extends Controller
{

    public function loginAction()
    {
        // get the error if any (works with forward and redirect -- see below)
        if ($this->get('request')->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $this->get('request')->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $this->get('request')->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }
        
        if($this->get('request')->isXmlHttpRequest()){
            $response = new Response($error, '401', array('HTTP/1.0 401 Unauthorized'));
        } else {
            $response = $this->render('UserBundle:Security:login.html.php', array(
                // last username entered by the user
                'last_username' => $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME),
                'error' => $error,
            ));
        }
        
        return $response;
    }

    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }

    public function accessDeniedAction()
    {
        return $this->render('UserBundle:Security:accessdenied.html.php');
    }
}