<?php
namespace Bundle\CoreBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Em
{

    protected $em;
    protected $container;


    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->em = $container->get("doctrine.orm.entity_manager");
    }
    
}
