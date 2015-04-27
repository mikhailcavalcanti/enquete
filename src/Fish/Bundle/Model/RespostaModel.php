<?php

namespace Fish\Bundle\Model;

/**
 * Description of RespostaModel
 *
 * @author Mikhail Cavalcanti <mikhailcavalcanti@gmail.com>
 */
class RespostaModel extends AbstractModel
{

    /**
     * 
     * @param int $id
     * @param \Fish\Bundle\Entity\AbstractEntity $entity
     * @return type
     */
    public function update($id, \Fish\Bundle\Entity\AbstractEntity $entity)
    {
        /* @var $entity \Fish\Bundle\Entity\RespostaEntity */
        $this->validate($entity);
        /* @var $databaseEntity \Fish\Bundle\Entity\RespostaEntity */
        $databaseEntity = $this->read($id);
        $databaseEntity->setResposta($entity->getResposta());
        return parent::update($id, $databaseEntity);
    }

    /**
     * 
     * @param \Fish\Bundle\Entity\RespostaEntity $entity
     * @throws Exception
     */
    public function validate($entity)
    {
        /* @var $entity \Fish\Bundle\Entity\RespostaEntity */
        $pergunta = $entity->getResposta();
        if (empty($pergunta)) {
            throw new Exception();
        }
    }

}
