<?php

namespace Bundle\UserBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class User
{
    protected $em;
    protected $repository;
    protected $class;
    protected $userForm;
    protected $encoderFactory;

    /**
     * Constructor.
     *
     */
    public function __construct(EntityManager $em, $class, $userForm, EncoderFactoryInterface $encoderFactory)
    {
        
        $this->em = $em;
        
        $this->repository = $this->em->getRepository($class);
        $this->class = $class;
        $this->userForm = $userForm;
        $this->encoderFactory = $encoderFactory;
    }
    
    public function getAll()
    {
        return $this->repository->findAll();
    }
    
    public function add(Request $request)
    {

        /** @var $user \Bundle\UserBundle\Entity\User */
        $user = new $this->class;
        $this->userForm->setData($user);
        $this->userForm->bindRequest($request);
        
        if ($this->userForm->isValid()) {
            $user = $this->userForm->getData();

            // encode password based on configuration
            $this->encodePassword($user);
            
            $this->em->persist($user);
            $this->em->flush();

            return $user;
        }

        return $this->userForm;
    }
    
    /**
     * Find user  by id
     * @param integer $id
     * @return \Bundle\UserBundle\Entity\User
     * @throws  \InvalidArgumentException if object was not found
     */
    public function findUserById($id)
    {
        $user = $this->repository->find($id);
        if ($user === null) {
            throw new \InvalidArgumentException(sprintf('Object with ID \'%d\' was not found in database', $id), 404);
        }

        return $user;
    }
    
    /**
     * Validates and updates a user based on posted data
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Bundle\UserBundle\Entity\User
     */
    public function update($id, Request $request)
    {
        $user = $this->findUserById($id);
        $this->userForm->setData($user);
        $this->userForm->bindRequest($request);

        if ($this->userForm->isValid()) {
            $user = $this->userForm->getData();

            // encode password based on configuration
            $this->encodePassword($user);

            $this->em->persist($user);
            $this->em->flush();

            return $user;
        }

        return $this->userForm;
    }
    
    /**
     * Encode the plain text password on the user object
     * @param  \Bundle\UserBundle\Entity\User $user
     * @return \Bundle\UserBundle\Entity\User
     */
    private function encodePassword($user)
    {
        if (null !== $user->getPlainPassword()) {
            /** @var $encoder \Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface */
            $encoder = $this->encoderFactory->getEncoder($user);

            $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
            $user->setPassword($password);

        }
    }

    
}