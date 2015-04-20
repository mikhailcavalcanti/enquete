<?php

namespace Fish\Bundle\Model;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of AbstractModel
 *
 * @author Mikhail Cavalcanti <mikhailcavalcanti@gmail.com>
 */
class AbstractModel implements CrudInterface
{

    /**
     *
     * @var ContainerInterface
     */
    private $container = null;

    /**
     * 
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * 
     */
    public function create($entity)
    {
        $entityManager = $this->container->get('doctrine')->getManager();
        $entityManager->persist($entity);
        $entityManager->flush();
    }

    public function delete($id)
    {
        
    }

    public function read($id = null)
    {
        
    }

    public function update($id)
    {
        
    }

}
