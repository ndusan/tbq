<?php

namespace Bundle\UserBundle\Controller;

use Bundle\CoreBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{

    
    function listAction()
    {
        /** @var $service \Bundle\UserBundle\Service\User */
        $service = $this->get('user.user_service');
        $userCollection = $service->getAll();
        return $this->render('UserBundle:User:list.html.php', array('userCollection' => $userCollection));
    }
    
    function addAction()
    {
        /** @var $userService Bundle\UserBundle\Service\User */
        $userService = $this->get('user.user_service');

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->get('user.form.user');
        
        /** @var $request \Symfony\Component\HttpFoundation\Request */
        $request = $this->get('request');
        
        if ('POST' == $request->getMethod()) {
            $result = $userService->add($request);
            
            $modelClass = $this->getParameter('user.model.user.class');
            if ($result instanceof $modelClass) {
                $message = sprintf('User with name \'%s\' was successfully created', $result->getFirstname());
                $this->get('session')->setFlash('success', $message);
                $url = $this->generateUrl('user.list');
            
                return new RedirectResponse($url);
            }
            $form = $result;
        }

        return $this->render('UserBundle:User:form.html.php', array(
                    'form' => $form->createView(),
        ));
    }

    function editAction($id)
    {
        /** @var $service \Bundle\UserBundle\Service\User */
        $service = $this->get('user.user_service');
        
        /** @var $request \Symfony\Component\HttpFoundation\Request */
        $request = $this->get('request');

        try {
            $user = $service->findUserById($id);
        } catch (\InvalidArgumentException $e) {
            throw new NotFoundHttpException($e->getMessage(), $e);
        }

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->get('user.form.user');
        $form->setData($user);

        if ('POST' == $request->getMethod()) {
            $result = $service->update($id, $request);
            
            $modelClass = $this->getParameter('user.model.user.class');
            if ($result instanceof $modelClass) {
                
                $message = sprintf('User with name \'%s\' was successfully updated', $result->getFirstname());
                
                $this->get('session')->setFlash('success', $message);
                $userCollection = $service->getAll();
                $url = $this->generateUrl('user.list', array('userCollection' => $userCollection));

                return new RedirectResponse($url);
            }
            $form = $result;
        }

        return $this->render('UserBundle:User:form.html.php', array(
                    'form' => $form->createView(),
                    'user' => $user,
        ));
    }
}