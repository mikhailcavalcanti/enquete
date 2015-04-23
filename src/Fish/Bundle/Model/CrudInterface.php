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
     * @param int $id
     * @param AbstractEntity $entity
     */
    public function update($id, AbstractEntity $entity);

    /**
     * 
     * @param type $id
     */
    public function delete($id);
}
