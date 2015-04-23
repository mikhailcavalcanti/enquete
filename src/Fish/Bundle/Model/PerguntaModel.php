<?php

namespace Fish\Bundle\Model;

/**
 * Description of PerguntaModel
 *
 * @author Mikhail Cavalcanti <mikhailcavalcanti@gmail.com>
 */
class PerguntaModel extends AbstractModel
{

    /**
     * 
     * @param int $id
     * @param \Fish\Bundle\Entity\AbstractEntity $entity
     * @return type
     */
    public function update($id, \Fish\Bundle\Entity\AbstractEntity $entity)
    {
        /* @var $entity \Fish\Bundle\Entity\PerguntaEntity */
        $this->validate($entity);
        /* @var $databaseEntity \Fish\Bundle\Entity\PerguntaEntity */
        $databaseEntity = $this->read($id);
        $databaseEntity->setPergunta($entity->getPergunta());
        $databaseEntity->setRespostas($entity->getRespostas());
        return parent::update($id, $entity);
    }

    /**
     * 
     * @param \Fish\Bundle\Entity\PerguntaEntity $entity
     * @throws Exception
     */
    public function validate($entity)
    {
        /* @var $entity \Fish\Bundle\Entity\PerguntaEntity */
        $pergunta = $entity->getPergunta();
        if (empty($pergunta)) {
            throw new Exception();
        }
    }

}
