<?php

namespace Fish\Bundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Fish\Bundle\Entity\AbstractEntity;
use Fish\Bundle\Entity\PerguntaEntity;
use Fish\Bundle\Entity\RespostaEntity;
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
        return parent::update($id, $databaseEntity);
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

    /**
     * 
     * @param array $params
     * @return PerguntaEntity
     */
    public function buildEntity(array $params)
    {
        /* @var $pergunta PerguntaEntity */
        $pergunta = isset($params['id']) ?
            $this->getContainer()->get('pergunta_model')->read($params['id']) :
            $this->getContainer()->get('pergunta_entity');
        $pergunta->setEnquete($params['enquete']);
        $pergunta->setPergunta($params['pergunta']);
        $respostas = new ArrayCollection();
        if (isset($params['respostas'])) {
            foreach ($params['respostas'] as $respostaParam) {
                /* @var $resposta RespostaEntity */
                $respostaParam['pergunta'] = $pergunta;
                $resposta = $this->getContainer()->get('resposta_model')->buildEntity($respostaParam);
                $respostas->add($resposta);
            }
        }
        $pergunta->setRespostas($respostas);
        return $pergunta;
    }

}
