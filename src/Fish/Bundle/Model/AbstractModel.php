<?php

namespace Fish\Bundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\NoResultException;
use Fish\Bundle\Entity\AbstractEntity;
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
     * @var string Nome do serviço da entidade a ser encontrado no $container
     */
    private $entityNameService = null;

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
     * @return string O nome do serviço que deve estar registrado no $container
     */
    private function getEntityNameService()
    {
        if (null === $this->entityNameService) {
            $entityServiceNameArray = explode('\\', str_replace('model', '_entity', strtolower(get_class($this)))
            );
            $this->entityNameService = end($entityServiceNameArray);
        }
        return $this->entityNameService;
    }

    /**
     * 
     * @param AbstractEntity $entity
     * @return AbstractEntity
     */
    public function create(AbstractEntity $entity)
    {
        $this->container->get('doctrine.orm.default_entity_manager')->persist($entity);
        $this->container->get('doctrine.orm.default_entity_manager')->flush();
        return $entity;
    }

    /**
     * 
     * @param int $id
     * @return AbstractEntity|ArrayCollection
     * @throws NoResultException
     */
    public function read($id = null)
    {
        $entity = $this->container->get($this->getEntityNameService());
        $repository = $this->container->get('doctrine.orm.default_entity_manager')->getRepository(get_class($entity));
        $result = (null === $id) ? $repository->findAll() : $repository->find($id);
        if (empty($result)) {
            throw new NoResultException();
        }
        return $result;
    }

    /**
     * 
     * @param type $id
     * @param AbstractEntity $entity
     * @return AbstractEntity
     */
    public function update($id, AbstractEntity $entity)
    {
        $this->container->get('doctrine.orm.default_entity_manager')->flush();
        return $entity;
    }

    public function delete($id)
    {
        $this->container
                ->get('doctrine.orm.default_entity_manager')
                ->remove($this->read($id));
        $this->container->get('doctrine.orm.default_entity_manager')->flush();
    }

}
