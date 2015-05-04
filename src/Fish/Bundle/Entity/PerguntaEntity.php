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
    private $enquetePerguntaResposta;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->enquetePerguntaResposta = new ArrayCollection();
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
     * Add enquetePerguntaResposta
     *
     * @param EnquetePerguntaRespostaEntity $enquetePerguntaResposta
     * @return PerguntaEntity
     */
    public function addEnquetePerguntaResposta(EnquetePerguntaRespostaEntity $enquetePerguntaResposta)
    {
        $this->enquetePerguntaResposta[] = $enquetePerguntaResposta;
        return $this;
    }

    /**
     * Remove enquetePerguntaResposta
     *
     * @param EnquetePerguntaRespostaEntity $enquetePerguntaResposta
     */
    public function removeEnquetePerguntaRespostum(EnquetePerguntaRespostaEntity $enquetePerguntaResposta)
    {
        $this->enquetePerguntaResposta->removeElement($enquetePerguntaResposta);
    }

    /**
     * Get enquetePerguntaResposta
     *
     * @return Collection 
     */
    public function getEnquetePerguntaResposta()
    {
        return $this->enquetePerguntaResposta;
    }

}
