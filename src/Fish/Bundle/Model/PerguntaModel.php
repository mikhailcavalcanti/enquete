<?php

namespace Fish\Bundle\Model;

use Fish\Bundle\Entity\AbstractEntity;
use Fish\Bundle\Entity\PerguntaEntity;
use InvalidArgumentException;
use Symfony\Component\Serializer\Exception\Exception;

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
     * @param AbstractEntity $entity
     * @return type
     */
    public function update($id, AbstractEntity $entity)
    {
        /* @var $entity PerguntaEntity */
        $this->validate($entity);
        /* @var $databaseEntity PerguntaEntity */
        $databaseEntity = $this->read($id);
        $databaseEntity->setPergunta($entity->getPergunta());
        $databaseEntity->setRespostas($entity->getRespostas());
        return parent::update($id, $entity);
    }

    /**
     * 
     * @param PerguntaEntity $entity
     * @throws Exception
     */
    public function validate(AbstractEntity $entity)
    {
        /* @var $entity PerguntaEntity */
        $pergunta = $entity->getPergunta();
        if (empty($pergunta)) {
            throw new InvalidArgumentException('Pergunta não pode ser vazia');
        }
    }

}
