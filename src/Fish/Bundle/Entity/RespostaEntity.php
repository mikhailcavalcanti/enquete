<?php

use Fish\Bundle\Entity\AbstractEntity;
use Fish\Bundle\Entity\PerguntaEntity;
use Fish\Bundle\Entity\RespostaEntity;

/**
 * 
 */

namespace Fish\Bundle\Entity;

/**
 * 
 */
class RespostaEntity extends AbstractEntity
{

    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var PerguntaEntity
     */
    private $pergunta;

    /**
     *
     * @var string
     */
    private $resposta;

    /**
     *
     * @var integer
     */
    private $quantidadeVotos;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set resposta
     *
     * @param string $resposta
     * @return RespostaEntity
     */
    public function setResposta($resposta)
    {
        $this->resposta = $resposta;
        return $this;
    }

    /**
     * Get resposta
     *
     * @return string 
     */
    public function getResposta()
    {
        return $this->resposta;
    }

    /**
     * Set quantidadeVotos
     *
     * @param \integers $quantidadeVotos
     * @return RespostaEntity
     */
    public function setQuantidadeVotos($quantidadeVotos)
    {
        $this->quantidadeVotos = $quantidadeVotos;
        return $this;
    }

    /**
     * Get quantidadeVotos
     *
     * @return \integers 
     */
    public function getQuantidadeVotos()
    {
        return $this->quantidadeVotos;
    }

    /**
     * Set pergunta
     *
     * @param PerguntaEntity $pergunta
     * @return RespostaEntity
     */
    public function setPergunta(PerguntaEntity $pergunta = null)
    {
        $this->pergunta = $pergunta;
        return $this;
    }

    /**
     * Get pergunta
     *
     * @return PerguntaEntity 
     */
    public function getPergunta()
    {
        return $this->pergunta;
    }

}
