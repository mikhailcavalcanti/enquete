<?php

/**
 * 
 */

namespace Fish\Bundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * 
 */
class PerguntaEntity extends AbstractEntity
{

    /**
     *
     * @var int 
     */
    private $id;

    /**
     *
     * @var string 
     */
    private $pergunta;

    /**
     *
     * @var ArrayCollection 
     */
    private $respostas = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->respostas = new ArrayCollection();
    }

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
     * Set pergunta
     *
     * @param string $pergunta
     * @return PerguntaEntity
     */
    public function setPergunta($pergunta)
    {
        $this->pergunta = $pergunta;
        return $this;
    }

    /**
     * Get pergunta
     *
     * @return string 
     */
    public function getPergunta()
    {
        return $this->pergunta;
    }

    /**
     * Add respostas
     *
     * @param RespostaEntity $respostas
     * @return PerguntaEntity
     */
    public function addResposta(RespostaEntity $respostas)
    {
        $this->respostas[] = $respostas;
        return $this;
    }

    /**
     * Remove respostas
     *
     * @param RespostaEntity $respostas
     */
    public function removeResposta(RespostaEntity $respostas)
    {
        $this->respostas->removeElement($respostas);
    }

    /**
     * Get respostas
     *
     * @return Collection 
     */
    public function getRespostas()
    {
        return $this->respostas;
    }

    /**
     * Set respostas
     *
     * @return PerguntaEntity 
     */
    public function setRespostas(ArrayCollection $respostas)
    {
        $this->respostas = $respostas;
        return $this;
    }

}
