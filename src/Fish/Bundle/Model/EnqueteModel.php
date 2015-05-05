<?php

namespace Fish\Bundle\Model;

use Fish\Bundle\Entity\AbstractEntity;
use Fish\Bundle\Entity\EnqueteEntity;
use Fish\Bundle\Entity\EnquetePerguntaRespostaEntity;
use Fish\Bundle\Entity\PerguntaEntity;
use InvalidArgumentException;

/**
 * Description of EnqueteModel
 *
 * @author Mikhail Cavalcanti <mikhailcavalcanti@gmail.com>
 */
class EnqueteModel extends AbstractModel
{

    public function read($id = null)
    {
        /* @var $entity EnqueteEntity */
        /* @var $entity EnquetePerguntaRespostaEntity */
//        var_dump($asd);die;
        $entity = parent::read($id);
        return $entity;
//        exit(var_dump($entity->getPergunta()));
//        exit(var_dump(($entity->getEnquetePerguntaResposta()->count())));
    }

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
//        $databaseEntity->setPerguntas($entity->getPerguntas());
        $databaseEntity->setEnquetePerguntaResposta($entity->getEnquetePerguntaResposta());
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
        $enquete = $this->getContainer()->get('enquete_entity');
        $enquete->setTitulo($params['titulo']);
        if (isset($params['perguntas'])) {
            foreach ($params['perguntas'] as $perguntaRequest) {
                $enquetePerguntaRespostaEntity = new EnquetePerguntaRespostaEntity();
                /* @var $pergunta PerguntaEntity */
                $pergunta = $this->getContainer()->get('pergunta_model')->read($perguntaRequest['id']);
//                $pergunta->addEnquetePerguntaResposta($enquetePerguntaRespostaEntity);
                $enquetePerguntaRespostaEntity->setEnquete($enquete);
                $enquetePerguntaRespostaEntity->setPergunta($pergunta);
//                $respostas = new ArrayCollection();
                if (isset($perguntaRequest['respostas'])) {
                    foreach ($perguntaRequest['respostas'] as $respostaRequest) {
//                        $respostas->add($this->getContainer()->get('resposta_model')->read($respostaRequest['id']));
                        $resposta = $this->getContainer()->get('resposta_model')->read($respostaRequest['id']);
                        $enquetePerguntaRespostaEntity->setResposta($resposta);
                    }
                }
//                $pergunta->setRespostas($respostas);
//                $enquete->addPergunta($pergunta);
                $enquete->addEnquetePerguntaResposta($enquetePerguntaRespostaEntity);
            }
        }
        return $enquete;
    }

}
