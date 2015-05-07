<?php

namespace Fish\Bundle\Model;

use Fish\Bundle\Entity\AbstractEntity;
use Fish\Bundle\Entity\RespostaEntity;
use InvalidArgumentException;
use Symfony\Component\Serializer\Exception\Exception;

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
     * @param AbstractEntity $entity
     * @return type
     */
    public function update($id, AbstractEntity $entity)
    {
        /* @var $entity RespostaEntity */
        $this->validate($entity);
        /* @var $databaseEntity RespostaEntity */
        $databaseEntity = $this->read($id);
        $databaseEntity->setResposta($entity->getResposta());
        return parent::update($id, $databaseEntity);
    }

    /**
     * 
     * @param RespostaEntity $entity
     * @throws Exception
     */
    public function validate(AbstractEntity $entity)
    {
        /* @var $entity RespostaEntity */
        $pergunta = $entity->getResposta();
        if (empty($pergunta)) {
            throw new InvalidArgumentException('Resposta não pode ser vazia');
        }
    }

    /**
     * 
     * @param array $params
     * @return RespostaEntity
     */
    public function buildEntity(array $params)
    {
        /* @var $resposta RespostaEntity */
        $resposta = isset($params['id']) ?
            $this->getContainer()->get('resposta_model')->read($params['id']) :
            $this->getContainer()->get('resposta_entity');
        $resposta
            ->setPergunta($params['pergunta'])
            ->setResposta($params['resposta'])
            ->setQuantidadeVotos($params['quantidade_votos']);
        return $resposta;
    }

    /**
     * 
     * @param int $id
     */
    public function votar($id)
    {
        /* @var $resposta RespostaEntity */
        $resposta = $this->read($id);
        $quantidadeDeVotos = $resposta->getQuantidadeVotos();
        $resposta->setQuantidadeVotos(++$quantidadeDeVotos);
        return parent::update($id, $resposta);
        
    }

}
