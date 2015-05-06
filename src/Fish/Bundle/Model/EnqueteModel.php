<?php

namespace Fish\Bundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Fish\Bundle\Entity\AbstractEntity;
use Fish\Bundle\Entity\EnqueteEntity;
use Fish\Bundle\Entity\PerguntaEntity;
use InvalidArgumentException;

/**
 * Description of EnqueteModel
 *
 * @author Mikhail Cavalcanti <mikhailcavalcanti@gmail.com>
 */
class EnqueteModel extends AbstractModel
{

    /**
     * 
     * @param int $id
     * @param AbstractEntity $entity
     * @return type
     */
    public function update($id, AbstractEntity $entity)
    {
        /* @var $entity EnqueteEntity */
        $this->validate($entity);
        /* @var $databaseEntity EnqueteEntity */
        $databaseEntity = $this->read($id);
        $databaseEntity->setTitulo($entity->getTitulo());
        $databaseEntity->setPerguntas($entity->getPerguntas());
        return parent::update($id, $databaseEntity);
    }

    /**
     * 
     * @param EnqueteEntity $entity
     */
    protected function validate(AbstractEntity $entity)
    {
        /* @var $entity EnqueteEntity */
        $titulo = $entity->getTitulo();
        if (empty($titulo)) {
            throw new InvalidArgumentException('Titulo da enquete não pode ser vazio');
        }
    }

    /**
     * 
     * @param array $params
     * @return EnqueteEntity
     */
    public function buildEntity(array $params)
    {
        /* @var $enquete EnqueteEntity */
        $enquete = isset($params['id']) ?
            $this->getContainer()->get('enquete_model')->read($params['id']) :
            $this->getContainer()->get('enquete_entity');

        $enquete->setTitulo($params['titulo']);
        $perguntas = new ArrayCollection();
        if (isset($params['perguntas'])) {
            foreach ($params['perguntas'] as $perguntaRequest) {
                /* @var $pergunta PerguntaEntity */
                $perguntaRequest['enquete'] = $enquete;
                $pergunta = $this->getContainer()->get('pergunta_model')->buildEntity($perguntaRequest);
                $perguntas->add($pergunta);
            }
        }
        $enquete->setPerguntas($perguntas);
        return $enquete;
    }

}
