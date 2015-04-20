<?php

namespace Fish\Bundle\Model;

/**
 *
 * @author Mikhail Cavalcanti <mikhailcavalcanti@gmail.com>
 */
interface CrudInterface
{

    public function create($entity);
    public function read($id = null);
    public function update($id);
    public function delete($id);
}
