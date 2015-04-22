<?php

namespace Fish\Bundle\Model;

use Fish\Bundle\Entity\AbstractEntity;

/**
 *
 * @author Mikhail Cavalcanti <mikhailcavalcanti@gmail.com>
 */
interface CrudInterface
{

    /**
     * 
     * @param AbstractEntity $entity
     */
    public function create(AbstractEntity $entity);

    /**
     * 
     * @param type $id
     */
    public function read($id = null);

    /**
     * 
     * @param AbstractEntity $entity
     */
    public function update(AbstractEntity $entity);

    /**
     * 
     * @param type $id
     */
    public function delete($id);
}
